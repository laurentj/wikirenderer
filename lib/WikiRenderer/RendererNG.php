<?php

/**
 * @author Laurent Jouanneau
 *
 * @copyright 2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer;

/**
 * Base class to parse block elements.
 */
class RendererNG extends Renderer
{
    /**
     * @var \WikiRenderer\Generator\DocumentGeneratorInterface
     */
    protected $documentGenerator;

    public function __construct(\WikiRenderer\Generator\DocumentGeneratorInterface $generator, Config $config)
    {
        $this->documentGenerator = $generator;

        if (is_subclass_of($config, '\WikiRenderer\Config')) {
            $this->config = $config;
        } else {
            throw new \InvalidArgumentException('WikiRenderer: Bad configuration.');
        }

        $this->inlineParser = new InlineParserNG($this->config, $generator);

        foreach ($this->config->blocktags as $name) {
            $this->_blockList[] = new $name($this, $generator);
        }
        if ($this->config->defaultBlock) {
            $name = $this->config->defaultBlock;
            $this->_defaultBlock = new $name($this);
        }
    }

    public function render($text)
    {
        $text = $this->config->onStart($text);

        $linesIterator = new \ArrayIterator(preg_split("/\015\012|\015|\012/", $text)); // we split the text at all line feeds

        $this->_newtext = array();
        $this->errors = array();
        $this->_currentBlock = null;
        $this->_previousBloc = null;

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
                    $this->_newtext[] = $this->_currentBlock->close();
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
            $this->_newtext[] = $this->_currentBlock->close();
        }

        $result = '';
        foreach($this->_newtext as $k => $blockGenerator) {
            if ($k > 0) {
                $result .= "\n";
            }
            if (is_string($blockGenerator)) {
                $result .= $blockGenerator;
            }
            else {
                $result .= $blockGenerator->generate();
            }
        }

        if ($this->documentGenerator->getConfig()->generateHeaderFooter) {
            $result = $this->documentGenerator->generateHeader()
                     .$result
                     .$this->documentGenerator->generateFooter();
        }

        return $this->config->onParse($result);
    }
}
