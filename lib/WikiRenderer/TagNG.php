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
 * Base class for wiki inline tag, to generate XHTML element.
 */
abstract class TagNG extends Tag
{

    protected $generatorName = '';

    protected $generator = null;

    public function __construct(Config $config, \WikiRenderer\Generator\GlobalGeneratorInterface $generator) {
        parent::__construct($config);
        $this->generator = $generator->getInlineGenerator($this->generatorName);
    }

    public function addContent($wikiContent, Generator\InlineGeneratorInterface $childGenerator = null)
    {
        $isMainContent = isset($this->attribute[$this->separatorCount]) &&
                            $this->attribute[$this->separatorCount] == '$$';
        $this->wikiContentArr[$this->separatorCount] .= $wikiContent;
        if ($isMainContent) {
            if ($childGenerator === null) {
                $parsedContent = $wikiContent;
                if (count($this->checkWikiWordIn)
                    && isset($this->attribute[$this->separatorCount])
                    && in_array($this->attribute[$this->separatorCount], $this->checkWikiWordIn)) {
    // FIXME il faudrait découper le parsedContent en wikiword et faire des addRawContent..
                    $parsedContent = $this->_findWikiWord($parsedContent);
                }
                $this->generator->addRawContent($parsedContent);
            }
            else {
                $this->generator->addContent($childGenerator);
            }
        }
        else {
            $this->contents[$this->separatorCount] .= $parsedContent;
        }
    }

    /**
     * ???
     *
     * @return ??? ???
     */
    public function getContent()
    {
        $attr = '';
        $cntattr = count($this->attribute);
        $count = ($this->separatorCount >= $cntattr) ? ($cntattr - 1) : $this->separatorCount;
        $content = '';

        for ($i = 0; $i <= $count; ++$i) {
            if ($this->attribute[$i] != '$$') {
                $this->generator->setAttribute($this->attribute[$i], $this->wikiContentArr[$i]);
            }
        }

        return $this->generator;
    }

    public function getAttributeValue($name) {
        $cntattr = count($this->attribute);
        $count = ($this->separatorCount >= $cntattr) ? ($cntattr - 1) : $this->separatorCount;

        for ($i = 0; $i <= $count; ++$i) {
            if ($this->attribute[$i] == $name) {
                return $this->wikiContentArr[$i];
            }
        }
        return null;
    }

    public function __clone() {
        $this->generator = clone $this->generator;
    }
}
