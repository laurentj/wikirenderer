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
 * Base class to generate output from inline wiki tag.
 * These objects are driven by the wiki inline parser.
 *
 * @see \WikiRenderer\InlineParser
 */
abstract class Tag
{
    /** @var string a name for the tag. Can be used to generate the output content */
    protected $name = '';

    /**  @var string characters that defines the start of the tag */
    public $beginTag = '';

    /**  @var string characters that defines the end of the tag */
    public $endTag = '';

    /**
     * indicates if the tag object represent an entire line or not.
     * if true, beginTag and endTag are ignored.
     * @var boolean
     */
    public $isTextLineTag = false;

    /**
     * List of possible separators
     * @var string[]
     */
    public $separators = array();

    /**
     * list of names corresponding to each parts separated by the separator in the tag.
     * Each parts of the tag string are then called "attributes".
     * If the name is '$$', the content is not an attribute and may content
     * nested tag. However this behavior can be changed by the isOtherTagAllowed()
     * method in child classes.
     * @var string[]
     */
    protected $attribute = array('$$');

    /**
     * list of attributes in which wiki words should be searched.
     * @var string[]
     */
    protected $checkWikiWordIn = array('$$');

    /**
     * values of each parts. Values are wiki content that has
     * been processed by _doEscape and _findWikiWord
     * @var string[]
     */
    protected $contents = array('');

    /** Wiki content of each part of the tag. */
    protected $wikiContentArr = array('');

    /** Wiki content of the full tag. */
    protected $wikiContent = '';

    /** number of separators found into the tag
     * @var int
     */
    protected $separatorCount = 0;

    /**
     * current separator during the parsing of the tag. False means no
     * separator found yet.
     * @var string|false
     */
    protected $currentSeparator = false;

    /**
     * name of the function that must return the generated content corresponding
     * to a wiki word.
     * @var array|string
     */
    protected $checkWikiWordFunction = false;

    /** @var \WikiRenderer\Config */
    protected $config = null;

    /**
     * Constructor.
     *
     * @param \WikiRenderer\Config $config Configuration object.
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
        $this->checkWikiWordFunction = $config->checkWikiWordFunction;
        if ($config->checkWikiWordFunction === null) {
            $this->checkWikiWordIn = array();
        }
        if (count($this->separators)) {
            $this->currentSeparator = $this->separators[0];
        }
    }

    /**
     * Called by the inline parser, when it found a new content.
     *
     * @param string $wikiContent   The original content in wiki syntax if $parsedContent is given, or a simple string if not.
     * @param string $parsedContent The content already parsed (by an other wikitag object), when this wikitag contains other wikitags.
     */
    public function addContent($wikiContent, $parsedContent = false)
    {
        if ($parsedContent === false) {
            $parsedContent = $this->_doEscape($wikiContent);
            if (count($this->checkWikiWordIn)
                && isset($this->attribute[$this->separatorCount])
                && in_array($this->attribute[$this->separatorCount], $this->checkWikiWordIn)) {
                $parsedContent = $this->_findWikiWord($parsedContent);
            }
        }
        $this->contents[$this->separatorCount] .= $parsedContent;
        $this->wikiContentArr[$this->separatorCount] .= $wikiContent;
    }

    /**
     * Called by the inline parser, when it found a separator.
     *
     * @param string $token  The token found as a separator
     */
    public function addSeparator($token)
    {
        $this->wikiContent .= $this->wikiContentArr[$this->separatorCount];
        ++$this->separatorCount;
        if ($this->separatorCount > count($this->separators)) {
            $this->currentSeparator = end($this->separators);
        } else {
            $this->currentSeparator = $this->separators[$this->separatorCount - 1];
        }
        $this->wikiContent .= $this->currentSeparator;
        $this->contents[$this->separatorCount] = '';
        $this->wikiContentArr[$this->separatorCount] = '';
    }

    /**
     * Says if the given token is the current separator of the tag.
     * The tag can support many separator.
     *
     * @return string The separator.
     */
    public function isCurrentSeparator($token)
    {
        return ($this->currentSeparator === $token);
    }

    /**
     * Returns the wiki content of the tag.
     *
     * @return string The content.
     */
    public function getWikiContent()
    {
        return $this->beginTag.$this->wikiContent.$this->wikiContentArr[$this->separatorCount].$this->endTag;
    }

    /**
     * Returns the generated content of the tag.
     *
     * @return string the content
     */
    public function getContent()
    {
        return $this->contents[0];
    }

    /**
     * indicates if the tag can contains other tags
     *
     * @return boolean  true if the tag can contain other tags
     */
    public function isOtherTagAllowed()
    {
        if (isset($this->attribute[$this->separatorCount])) {
            return ($this->attribute[$this->separatorCount] == '$$');
        } else {
            return false;
        }
    }

    /**
     * Returns the generated content of the tag.
     *
     * @return string the content
     */
    public function getBogusContent()
    {
        $c = $this->beginTag;
        $m = count($this->contents) - 1;
        $s = count($this->separators);
        foreach ($this->contents as $k => $v) {
            $c .= $v;
            if ($k < $m) {
                if ($k < $s) {
                    $c .= $this->separators[$k];
                } else {
                    $c .= end($this->separators);
                }
            }
        }

        return $c;
    }

    /**
     * Escapes a simple string.
     *
     * @param string $string The string to escape.
     *
     * @return string The escaped string.
     */
    protected function _doEscape($string)
    {
        return $string;
    }

    /**
     * Search for wikiword into the given string, and call the function whose
     * name is in checkWikiWordFunction, to replace all occurence by an other
     * string
     *
     * @param string $string the string where to replace Wiki words
     *
     * @return string the string with wiki words replaced
     */
    protected function _findWikiWord($string)
    {
        if ($this->checkWikiWordFunction !== null && preg_match_all("/(?:(?<=\b)|!)[A-Z]\p{Ll}+[A-Z0-9][\p{Ll}\p{Lu}0-9]*/u", $string, $matches)) {
            $match = array_unique($matches[0]); // we must have a list without duplicated values, because of str_replace.
            if (is_array($this->checkWikiWordFunction)) {
                $o = $this->checkWikiWordFunction[0];
                $m = $this->checkWikiWordFunction[1];
                $result = $o->$m($match);
            } else {
                $fct = $this->checkWikiWordFunction;
                $result = $fct($match);
            }
            $string = str_replace($match, $result, $string);
        }

        return $string;
    }
}
