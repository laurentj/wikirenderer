<?php

/**
 * @author Laurent Jouanneau
 *
 * @copyright 2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public 2.1
 * License as published by the Free Software Foundation.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */

namespace WikiRenderer;

/**
 * Base class to parse block elements.
 */
class RendererNG extends Renderer
{
    /**
     * @var \WikiRenderer\Generator\GlobalGeneratorInterface
     */
    protected $globalGenerator;

    public function __construct(\WikiRenderer\Generator\GlobalGeneratorInterface $generator, Config $config = null)
    {
        $this->globalGenerator = $generator;

        if (isset($config)) {
            if (is_subclass_of($config, '\WikiRenderer\Config')) {
                $this->config = $config;
            } else {
                throw new \Exception('WikiRenderer: Bad configuration.');
            }
        } else {
            $this->config = new \WikiRenderer\Markup\WR3\Config();
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

        $lignes = preg_split("/\015\012|\015|\012/", $text); // we split the text at all line feeds

        $this->_newtext = array();
        $this->errors = array();
        $this->_currentBlock = null;
        $this->_previousBloc = null;

        // we loop over all lines
        foreach ($lignes as $num => $ligne) {
            if ($this->_currentBlock) {
                // a block is already opened
                if ($this->_currentBlock->detect($ligne, true)) {
                    // the line is part of the block
                    $this->_currentBlock->validateDetectedLine();
                } else {
                    // the line is not part of the block, we close it.
                    $this->_newtext[] = $this->_currentBlock->close();
                    $this->detectNewBlock($ligne);
                }
            } else {
                // no opened block, we see if the line correspond to a block
                $this->detectNewBlock($ligne);
            }
            if ($this->inlineParser->error) {
                $this->errors[$num + 1] = $ligne;
            }
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

        if ($this->globalGenerator->getConfig()->generateHeaderFooter) {
            $result = $this->globalGenerator->generateHeader()
                     .$result
                     .$this->globalGenerator->generateFooter();
        }

        return $this->config->onParse($result);
    }
}
