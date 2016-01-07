<?php

/**
 * wikirenderer3 (wr3) syntax
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

namespace WikiRenderer\Markup\WR3;

/**
 * Parser that parse a definition line, and which discover the term and the
 * definition text.
 * 
 */
class DefinitionTextLine extends \WikiRenderer\TagNG
{
    protected $generatorName = 'textline';
    public $isTextLineTag = true;
    public $separators = array(':');
    protected $attribute = array('$$', '$$');

    protected $termGenerator;
    protected $definitionGenerator;

    public function __construct(\WikiRenderer\Config $config, \WikiRenderer\Generator\DocumentGeneratorInterface $generator) {
        parent::__construct($config, $generator);
        $this->termGenerator = $this->generator;
        $this->definitionGenerator = clone $this->generator;
    }

    public function addContent($wikiContent, \WikiRenderer\Generator\InlineGeneratorInterface $childGenerator = null)
    {
        $this->wikiContentArr[$this->separatorCount] .= $wikiContent;
        if ($childGenerator === null) {
            $parsedContent = $this->checkWikiWord($wikiContent);
            $this->generator->addRawContent($parsedContent);
        }
        else {
            $this->generator->addContent($childGenerator);
        }
    }

    public function addSeparator($token)
    {
        if ($this->separatorCount == 0) {
            $this->wikiContent .= $this->wikiContentArr[0]. $token;
            $this->separatorCount = 1;
            $this->contents[1] = '';
            $this->wikiContentArr[1] = '';
            $this->generator = $this->definitionGenerator;
        }
        else {
            $this->wikiContentArr[1] .= $token;
        }
    }

    public function getContent()
    {
        $generator = new \WikiRenderer\Generator\InlineBagGenerator();
        $generator->addGenerator($this->termGenerator);
        $generator->addGenerator($this->definitionGenerator);
        return $generator;
    }

    public function __clone() {
        $this->generator = clone $this->generator;
        $this->termGenerator = $this->generator;
        $this->definitionGenerator = clone $this->definitionGenerator;
    }
}
