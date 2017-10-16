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
     * list of blocks/sub-blocks used on the current line
     */
    protected $blockStacks = array();

    /**
     * Constructor. Prepare the engine.
     *
     * @param Generator\DocumentGeneratorInterface $generator
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
            if ($line != '') {
                $blockGen = $this->parseBlock($linesIterator, $line, null);
                if (is_object($blockGen)) {
                    $this->documentGenerator->addBlock($blockGen);
                    continue;
                }
            }
            // no block found, we use a default block
            if (trim($line) == '') {
                $blockGenerator = new Generator\SingleLineBlock();
            } else {
                $inline = $this->inlineParser->parse($line);
                $blockGenerator = $this->documentGenerator->getDefaultBlock($inline);
                if (!$blockGenerator) {
                    $blockGenerator = new Generator\SingleLineBlock($inline);
                }
            }
            $this->documentGenerator->addBlock($blockGenerator);
            $this->nextLine($linesIterator);
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
     * @param \ArrayIterator $linesIterator
     * @param string $firstLine
     * @param Block|null $parentBlock
     * @return null|Generator\BlockGeneratorInterface
     */
    protected function parseBlock(\ArrayIterator $linesIterator,
                                  $firstLine = '',
                                  \WikiRenderer\Block $parentBlock = null)
    {
        $authorizedBlocks = ($parentBlock? $parentBlock->getAuthorizedChildBlocks():null);
        $found = false;
        // let's check if the line is part of a type of block
        foreach ($this->_blockList as $block) {
            if ($authorizedBlocks && !in_array($block->type, $authorizedBlocks)) {
                continue;
            }
            if ($block->mustClone()) {
                // block must be cloned so it can change its internal values
                $block = clone $block;
            }

            if ($block->isStarting($firstLine)) {
                $found = true;
                // we open the new block
                if ($block->closeNow()) {
                    // if we have to close now the block, we close.
                    $block->open();
                    $block->validateLine();
                    $this->nextLine($linesIterator);
                    return $block->close($block::CLOSE_REASON_IMMEDIATELY);
                }
                $block->open();
                break;
            }
        }
        if (!$found) {
            return null;
        }
        if ($block->allowsChildBlocks()) {
            $this->blockStacks[] = $block;
            $line = $block->getLineContentForSubBlocks();
            // we loop over all lines, and try to found child block
            while ($linesIterator->valid()) {
                $subblock = $this->parseBlock($linesIterator,
                                              $line,
                                              $block);
                if (is_object($subblock)) {
                    $block->addChildBlock($subblock);
                    // get the line for the possible next sub block
                    $line = $this->currentLine($linesIterator);
                    if ($line !== null) {
                        // let's parse the next sub block
                        continue;
                    }

                    // perhaps a new kind of item is starting for the block
                    // like a new item of a list
                    array_pop($this->blockStacks);
                    $line = $this->currentLine($linesIterator);
                    if ($line === null) {
                        return $block->close($block::CLOSE_REASON_PARENT_CLOSED);
                    }
                    if (!$block->isAccepting($line)) {
                        return $block->close($block::CLOSE_REASON_LINE_NOT_MATCH);
                    }
                    $this->blockStacks[] = $block;
                    $line = $block->getLineContentForSubBlocks();
                }
                else {
                    // no sub blocks was found, this is probably just
                    // a line of text, or a new line that starts a sub section of the block
                    array_pop($this->blockStacks);
                    $line = $this->currentLine($linesIterator);
                    if ($line === null) {
                        return $block->close($block::CLOSE_REASON_PARENT_CLOSED);
                    }
                    if (!$block->isAccepting($line)) {
                        return $block->close($block::CLOSE_REASON_LINE_NOT_MATCH);
                    }
                    $this->blockStacks[] = $block;
                    $block->validateLine();
                    $this->nextLine($linesIterator);
                    $line = $this->currentLine($linesIterator);
                    if ($line === null) {
                        array_pop($this->blockStacks);
                        return $block->close($block::CLOSE_REASON_PARENT_CLOSED);
                    }
                }
            }
            array_pop($this->blockStacks);
        }
        else {
            $block->validateLine();
            $this->nextLine($linesIterator);
            // we loop over all lines
            while ($linesIterator->valid()) {
                $line = $this->currentLine($linesIterator);
                if ($line === null) {
                    return $block->close($block::CLOSE_REASON_PARENT_CLOSED);
                }
                if (!$block->isAccepting($line)) {
                    return $block->close($block::CLOSE_REASON_LINE_NOT_MATCH);
                }
                // the line is part of the block
                $block->validateLine();
                $this->nextLine($linesIterator);
            }
        }
        return $block->close($block::CLOSE_REASON_EOF);
    }

    protected function nextLine(\ArrayIterator $linesIterator)
    {
        if ($this->inlineParser->error) {
            $this->errors[$linesIterator->key() + 1] = $linesIterator->current();
        }
        $linesIterator->next();
    }

    protected function currentLine(\ArrayIterator $linesIterator) {
        $line = $linesIterator->current();
        //for line inside blocks, we should ask to parent block
        // if the line is still ok for them
        foreach($this->blockStacks as $block) {
            if ($block->isAcceptingForSubBlocks($line)) {
                $line = $block->getLineContentForSubBlocks();
            }
            else {
                return null;
            }
        }
        return $line;
    }

    public function inASubBlock()
    {
        return count($this->blockStacks) > 0;
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
