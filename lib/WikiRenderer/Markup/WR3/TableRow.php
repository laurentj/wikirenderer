<?php

/**
 * wikirenderer3 (wr3) syntax
 * 
 * @author Laurent Jouanneau
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
 * Parse a line of a table
 */
class TableRow extends \WikiRenderer\TagNG
{
    protected $generatorName = 'textline';
    public $isTextLineTag = true;
    protected $attribute = array('$$');
    protected $checkWikiWordIn = array('$$');
    public $separators = array(' | ');

    /**
     * @var \WikiRenderer\Generator\InlineBagGenerator
     */
    protected $row;

    public function __construct(\WikiRenderer\Config $config, \WikiRenderer\Generator\DocumentGeneratorInterface $generator) {
        parent::__construct($config, $generator);
        $this->row = new \WikiRenderer\Generator\InlineBagGenerator();
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

    /**
     * called by the inline parser, when it found a separator.
     */
    public function addSeparator($token)
    {
        $this->row->addGenerator($this->generator);
        $this->generator = $this->documentGenerator->getInlineGenerator($this->generatorName);

        $this->wikiContent .= $this->wikiContentArr[$this->separatorCount];
        ++$this->separatorCount;
        $this->currentSeparator = $token;
        $this->wikiContent .= $token;
        $this->contents[$this->separatorCount] = '';
        $this->wikiContentArr[$this->separatorCount] = '';
    }

    public function getContent()
    {
        $this->row->addGenerator($this->generator);
        return $this->row;
    }

    public function isOtherTagAllowed()
    {
        return true;
    }

    public function __clone() {
        $this->generator = clone $this->generator;
        $this->row = clone $this->row;
    }
}
