<?php

/**
 * Wikirenderer is a wiki text parser. It can transform a wiki text into xhtml or other formats.
 *
 * @author Laurent Jouanneau
 * @copyright 2003-2015 Laurent Jouanneau
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
 * The parser used to find all inline tag in a single line of text.
 */
class InlineParser
{
    /** @var boolean indicate if an error has been found during the parsing */
    public $error = false;

    /** list of simple tags (copy of ccongi */
    protected $simpletags = array();

    /**
    * the current parsed line, splited into chuncked and tokens
    * @var string[]
    */
    protected $str = array();
    
    /**
     * count of parts into the string 
     * @var int
     */
    protected $end = 0;

    /** @var \WikiRenderer\Config  */
    protected $config;

    /** @var  TextLineContainer[]   key is class name of the TextLine */
    protected $textLineContainers = array();

    /** @var TextLineContainer */
    protected $currentTextLineContainer = null;

    /** @var string escape character */
    protected $escapeChar = '';

    /**
     * constructor.
     *
     * @param \WikiRenderer\Config $config A configuration object.
     */
    public function __construct(Config $config)
    {
        $this->escapeChar = $config->escapeChar;
        $this->config = $config;

        // let's construct the regexp that will find all tokens on the line

        // first all basic tags
        $simpletagPattern = '';
        foreach ($config->simpletags as $tag => $html) {
            $simpletagPattern .= '|('.preg_quote($tag, '/').')';
        }

        // the pattern that matches the escape character
        $escapePattern = '';
        if ($this->escapeChar != '') {
            $escapePattern = '|('.preg_quote($this->escapeChar, '/').')';
        }

        // now let's construct patterns corresponding to all different
        // kind of lines
        foreach ($config->textLineContainers as $class => $tags) {
            $c = new TextLineContainer();
            $c->tag = new $class($config);
            $separators = $c->tag->separators;

            $tagList = array();
            foreach ($tags as $tag) {
                $t = new $tag($config);
                $c->allowedTags[$t->beginTag] = $t;
                $c->pattern .= '|('.preg_quote($t->beginTag, '/').')';
                if ($t->beginTag != $t->endTag) {
                    $c->pattern .= '|('.preg_quote($t->endTag, '/').')';
                }
                $separators = array_merge($separators, $t->separators);
            }
            $separators = array_unique($separators);
            foreach ($separators as $sep) {
                $c->pattern .= '|('.preg_quote($sep, '/').')';
            }
            $c->pattern .= $simpletagPattern.$escapePattern;
            $c->pattern = '/'.substr($c->pattern, 1).'/';

            $this->textLineContainers[$class] = $c;
        }
        $this->simpletags = $config->simpletags;
    }

    /**
     * Main function which parses a line of wiki content.
     *
     * @param string $line a string containing wiki content, but without line feeds
     *
     * @return string the line transformed to the target content
     */
    public function parse($line)
    {
        $this->error = false;
        $this->currentTextLineContainer = $this->textLineContainers[$this->config->defaultTextLineContainer];
        $firsttag = clone ($this->currentTextLineContainer->tag);

        $this->str = preg_split($this->currentTextLineContainer->pattern, $line, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
        $this->end = count($this->str);

        if ($this->end > 1) {
            $pos = -1;
            $this->_parse($firsttag, $pos);

            return $firsttag->getContent();
        } else {
            $firsttag->addContent($line);

            return $firsttag->getContent();
        }
    }

    /**
     * Parser's core function.
     *
     * @param ??? $tag      ???
     * @param ??? $posstart ???
     *
     * @return int new position
     */
    protected function _parse($tag, $posstart)
    {
        $checkNextTag = true;

        // we analyse each part of the string,
        for ($i = $posstart + 1; $i < $this->end; ++$i) {
            $t = &$this->str[$i];

            // is it the escape char ?
            if ($this->escapeChar != '' && $t === $this->escapeChar) {
                if ($checkNextTag) {
                    $t = ''; // yes -> let's ignore the tag
                    $checkNextTag = false;
                } else {
                    // if we are here, this is because the previous part was the escape char
                    $tag->addContent($this->escapeChar);
                    if ($this->config->outputEscapeChar) {
                        $tag->addContent($this->escapeChar);
                    }
                    $checkNextTag = true;
                }

            // is this a separator ?
            } elseif ($tag->isCurrentSeparator($t)) {
                $tag->addSeparator($t);
            // no separator, no escape char, and previous token allowed us to
            // take care of the current token, so let's processing it
            } elseif ($checkNextTag) {
                // is there a ended tag
                if ($tag->endTag == $t && !$tag->isTextLineTag) {
                    return $i;
                } elseif (!$tag->isOtherTagAllowed()) {
                    $tag->addContent($t);
                }
                // is there a tag which begin something ?
                elseif (isset($this->currentTextLineContainer->allowedTags[$t])) {
                    $newtag = clone $this->currentTextLineContainer->allowedTags[$t];
                    $i = $this->_parse($newtag, $i);
                    if ($i !== false) {
                        $tag->addContent($newtag->getWikiContent(), $newtag->getContent());
                    } else {
                        $i = $this->end;
                        $tag->addContent($newtag->getWikiContent(), $newtag->getBogusContent());
                    }
                }
                // is there a simple tag ?
                elseif (isset($this->simpletags[$t])) {
                    $tag->addContent($t, $this->simpletags[$t]);
                } else {
                    $tag->addContent($t);
                }
            // previous token prevents us to process the current token, and
            // indicated to ignore it, so let's ignore it.
            } else {
                if (!$this->config->outputEscapeChar &&
                    (isset($this->currentTextLineContainer->allowedTags[$t]) ||
                    isset($this->simpletags[$t]) ||
                    $tag->endTag == $t)) {
                    $tag->addContent($t);
                } else {
                    $tag->addContent($this->escapeChar.$t);
                }
                $checkNextTag = true;
            }
        }
        if (!$tag->isTextLineTag) {
            //we didn't find the ended tag, error
            $this->error = true;

            return false;
        } else {
            return $this->end;
        }
    }
}
