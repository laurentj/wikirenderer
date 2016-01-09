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
 * Base class for the configuration.
 */
abstract class Config
{
    /** ??? */
    public $defaultTextLineContainer = '\WikiRenderer\TextLine';
    /** ??? */
    public $textLineContainers = array(
        '\WikiRenderer\TextLine' => array(),
    );
    /** List of block-type markups known by WikiRenderer. */
    public $blocktags = array();
    /** ??? */
    public $simpletags = array();
    /**
     * @var string name of the class used to parse unrecognized line
     */
    public $defaultBlock = null;
    /** ??? */
    public $checkWikiWordFunction = null;
    /** Character used to escape wiki syntax. */
    public $escapeChar = '\\';

    /** escape char is taken account to escape tags but it is kept into the output */
    public $outputEscapeChar = false;

    /**
     * Called before the wiki text parsing.
     *
     * @param string $text The wiki text.
     *
     * @return string The wiki text to parse.
     */
    public function onStart($text)
    {
        return $text;
    }

    /**
     * Called after the parsing. You can add additionnal data to
     * the result of the parsing.
     */
    public function onParse($finalText)
    {
        return $finalText;
    }

    /**
     * In some wiki system, some links are specials. You should override this method
     * to transform this specific links to real URL.
     *
     * @return array First item is the url, second item is an alternate label.
     */
    public function processLink($url, $tagName = '')
    {
        return array($url, $url);
    }
}
