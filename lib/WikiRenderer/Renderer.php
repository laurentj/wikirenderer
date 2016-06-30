<?php

/**
 * Wikirenderer is a wiki text parser. It can transform a wiki text into xhtml or other formats.
 *
 * @author Laurent Jouanneau
 * @contributor  Amaury Bouchard
 *
 * @copyright 2003-2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer;

/**
 * Main class of WikiRenderer.
 */
class Renderer
{
    /** @var \WikiRenderer\Block[]  List of all possible blocks. */
    protected $_blockList = array();

    /** @var \WikiRenderer\InlineParser   The parser for inline content. */
    public $inlineParser = null;

    /**
     * List of lines which contain an error. Keys are line numbers, values are line
     * content.
     *
     * @var string[]
     */
    public $errors = array();

    /** @var \WikiRenderer\Config  Current configuration object. */
    protected $config = null;

    /**
     * @var \WikiRenderer\Generator\DocumentGeneratorInterface
     */
    protected $documentGenerator;

    /**
     * Constructor. Prepare the engine.
     *
     * @param \WikiRenderer\Config $config A configuration object. If it is not present, it uses wr3_to_xhtml rules.
     */
    public function __construct(\WikiRenderer\Generator\DocumentGeneratorInterface $generator, Config $config)
    {
        $this->documentGenerator = $generator;

        $this->config = $config;
        $this->inlineParser = new InlineParser($this->config, $generator);

        foreach ($this->config->blocktags as $name) {
            $this->_blockList[] = new $name($this, $generator);
        }
    }

    /**
     * Main method to call to convert a wiki text into an other format, according to the
     * rules given to the constructor.
     *
     * @param string $text The wiki text to convert.
     *
     * @return string The converted text.
     */
    public function render($text)
    {
        $text = $this->config->onStart($text);

        $linesIterator = new \ArrayIterator(preg_split("/\015\012|\015|\012/", $text)); // we split the text at all line feeds
        $this->documentGenerator->clear();
        $this->errors = array();

        while ($linesIterator->valid()) {
            $line = $linesIterator->current();
            $blockGen = $this->parseBlock($linesIterator, '');
            if (is_object($blockGen)) {
                $this->documentGenerator->addBlock($blockGen);
            }
            else {
                // it should not happen
                throw new \UnexpectedValueException("Block not recognised");
            }
        }

        $result = $this->documentGenerator->generate();

        if ($this->documentGenerator->getConfig()->generateHeaderFooter) {
            $result = $this->documentGenerator->generateHeader()
                     .$result
                     .$this->documentGenerator->generateFooter();
        }

        return $this->config->onParse($result);
    }

    const NO_LINE_PREFIXED = 1;
    const NO_CHILD_BLOCK = 2;

    protected function parseBlock($linesIterator, $linePrefix)
    {
        $line = $linesIterator->current();
        if ($linePrefix) {
            if (strpos($line, $linePrefix) === 0) {
                $line = substr($line, mb_strlen($linePrefix));
            }
            else {
                return self::NO_LINE_PREFIXED;
            }
        }

        $found = false;
        // let's check if the line is part of a type of block
        foreach ($this->_blockList as $block) {
            if ($block->mustClone()) {
                // block must be cloned so it can be change its internal values
                $block = clone $block;
            }

            if ($block->isStarting($line)) {
                $found = true;
                // we open the new block
                if ($block->closeNow()) {
                    // if we have to close now the block, we close.
                    $block->open();
                    $block->validateLine();
                    $this->nextLine($linesIterator);
                    return $block->close();
                }
                $block->open();
                break;
            }
        }
        if ($found) {
            if ($block->allowsChildBlocks()) {
                // we loop over all lines, and try to found child block
                while ($linesIterator->valid()) {
                    $subblock = $this->parseBlock($linesIterator, $linePrefix.$block->getLinePrefix());
                    if (is_object($subblock)) {
                        $block->addChildBlock($res);
                    }
                    else if ($subblock === self::NO_LINE_PREFIXED) {
                        return $block->close();
                    }
                    else {
                        // it should not happen
                        throw new \UnexpectedValueException("Block has bizarre line");
                    }
                }
            }
            else {
                $block->validateLine();
                $this->nextLine($linesIterator);
                // we loop over all lines
                while ($linesIterator->valid()) {
                    $line = $linesIterator->current();
                    if ($block->isAccepting($line)) {
                        // the line is part of the block
                        $block->validateLine();
                        $this->nextLine($linesIterator);
                    } else {
                        // the line is not part of the block, we close it.
                        break;
                    }
                }
            }

            return $block->close();
        } else {
            // no block found, we use a default block
            if (trim($line) == '') {
                $blockGenerator = new Generator\SingleLineBlock();
            } elseif ($defaultBlock = $this->documentGenerator->getDefaultBlock()) {
                $defaultBlock->isStarting($line);
                $defaultBlock->open();
                $defaultBlock->validateLine();
                $blockGenerator = $defaultBlock->close();
            } else {
                $blockGenerator = new Generator\SingleLineBlock($this->inlineParser->parse($line));
            }
            $this->nextLine($linesIterator);

            return $blockGenerator;
        }
    }

    protected function nextLine($linesIterator)
    {
        if ($this->inlineParser->error) {
            $this->errors[$linesIterator->key() + 1] = $linesIterator->current();
        }
        $linesIterator->next();
    }

    /**
     * Returns the current configuration object.
     *
     * @return \WikiRenderer\Config The current configuration object.
     */
    public function getConfig()
    {
        return $this->config;
    }
}
