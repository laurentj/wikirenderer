<?php

/**
 * Wikirenderer is a wiki text parser. It can transform a wiki text into xhtml or other formats.
 *
 * @author Laurent Jouanneau
 * @contributor  Amaury Bouchard
 *
 * @copyright 2003-2013 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */
namespace WikiRenderer;

/**
 * Main class of WikiRenderenr.
 */
class Renderer
{
    /** @var \WikiRenderer\Block The currently opened block element. */
    protected $_currentBlock = null;

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
        $this->_currentBlock = null;

        // we loop over all lines
        while ($linesIterator->valid()) {
            $line = $linesIterator->current();
            if ($this->_currentBlock) {
                // a block is already opened
                if ($this->_currentBlock->detect($line, true)) {
                    // the line is part of the block
                    $this->_currentBlock->validateDetectedLine();
                } else {
                    // the line is not part of the block, we close it.
                    $this->documentGenerator->addBlock($this->_currentBlock->close());
                    $this->detectNewBlock($line);
                }
            } else {
                // no opened block, we see if the line correspond to a block
                $this->detectNewBlock($line);
            }
            if ($this->inlineParser->error) {
                $this->errors[$linesIterator->key() + 1] = $line;
            }
            $linesIterator->next();
        }

        if ($this->_currentBlock) {
            $this->documentGenerator->addBlock($this->_currentBlock->close());
        }

        $result = $this->documentGenerator->generate();

        if ($this->documentGenerator->getConfig()->generateHeaderFooter) {
            $result = $this->documentGenerator->generateHeader()
                     .$result
                     .$this->documentGenerator->generateFooter();
        }

        return $this->config->onParse($result);
    }

    /**
     * detect the block corresponding to the given line.
     *
     * @var string
     */
    protected function detectNewBlock($line)
    {
        $found = false;
        // let's check if the line is part of a type of block
        foreach ($this->_blockList as $block) {
            if ($block->mustClone()) {
                // block must be cloned so it can be change its internal values
                $block = clone $block;
            }
            if ($block->detect($line, false)) {
                $found = true;
                // we open the new block
                if ($block->closeNow()) {
                    // if we have to close now the block, we close.
                    $block->open();
                    $block->validateDetectedLine();
                    $this->documentGenerator->addBlock($block->close());
                    $this->_currentBlock = null;
                } else {
                    $this->_currentBlock = $block;
                    $this->_currentBlock->open();
                    $this->_currentBlock->validateDetectedLine();
                }
                break;
            }
        }
        if (!$found) {
            if (trim($line) == '') {
                $this->documentGenerator->addBlock(new Generator\SingleLineBlock());
            } elseif ($defaultBlock = $this->documentGenerator->getDefaultBlock()) {
                $defaultBlock->detect($line);
                $defaultBlock->open();
                $defaultBlock->validateDetectedLine();
                $this->documentGenerator->addBlock($defaultBlock->close());
            } else {
                $blockLine = new Generator\SingleLineBlock($this->inlineParser->parse($line));
                $this->documentGenerator->addBlock($blockLine);
            }
            $this->_currentBlock = null;
        }
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
