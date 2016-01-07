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

    /**
     * @var \WikiRenderer\Generator\DocumentGeneratorInterface
     */
    protected $documentGenerator = null;

    protected $generator = null;

    public function __construct(Config $config, \WikiRenderer\Generator\DocumentGeneratorInterface $generator) {
        parent::__construct($config);
        $this->documentGenerator = $generator;
        $this->generator = $generator->getInlineGenerator($this->generatorName);
    }

    public function addContent($wikiContent, Generator\InlineGeneratorInterface $childGenerator = null)
    {
        $isMainContent = isset($this->attribute[$this->separatorCount]) &&
                            $this->attribute[$this->separatorCount] == '$$';
        $this->wikiContentArr[$this->separatorCount] .= $wikiContent;
        if ($isMainContent) {
            if ($childGenerator === null) {
                $parsedContent = $this->checkWikiWord($wikiContent);
                $this->generator->addRawContent($parsedContent);
            }
            else {
                $this->generator->addContent($childGenerator);
            }
        }
        else {
            $this->contents[$this->separatorCount] .= $wikiContent;
        }
    }

    /**
     * Return generators that will generate final content
     *
     * @return \WikiRenderer\Generator\InlineGeneratorInterface
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

    /**
     * Returns the generated content of the tag.
     *
     * @return string the content
     */
    public function getBogusContent()
    {
        $generator = $this->documentGenerator->getInlineGenerator('textline');
        $generator->addRawContent($this->beginTag);
        $m = count($this->contents) - 1;
        $s = count($this->separators);
        foreach ($this->contents as $k => $v) {
            if ($this->attribute[$k] == '$$') {
                foreach($this->generator->getChildGenerators() as $child) {
                    $generator->addContent($child);
                }
            }
            else {
                $generator->addRawContent($v);
            }
            if ($k < $m) {
                if ($k < $s) {
                    $generator->addRawContent( $this->separators[$k]);
                } else {
                    $generator->addRawContent(end($this->separators));
                }
            }
        }

        return $generator;
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
