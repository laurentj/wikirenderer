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

    /** 
     * list of SimpleTag objects.
     */
    public $simpleTags = array();

    /** Character used to escape wiki syntax. */
    public $escapeChar = '\\';

    /** @var boolean if true escape char is kept into the output for anything except for tags*/
    public $outputEscapeChar = true;

    /** @var boolean if true escape char is kept into the output for tags */
    public $outputEscapeCharForTags = false;

    /** @var boolean if true escape char is kept when escaping the escape char */
    public $outputDoubleEscapeChar = false;

    /** @var bool if true escape char is kept when it is at the end of line */
    public $outputEscapeCharAtEOL = false;

    /**
     * @var \WikiRenderer\WordConverter\WordConverterInterface[]
     */
    public $wordConverters = array();

    /**
     * @var \WikiRenderer\LinkProcessor\LinkProcessorInterface
     */
    protected $linkProcessor = null;

    public function __construct()
    {
        $this->linkProcessor = new \WikiRenderer\LinkProcessor\SimpleLinkProcessor();
    }

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
     * @param string $finalText
     * @return string
     */
    public function onParse($finalText)
    {
        return $finalText;
    }

    /**
     * @return \WikiRenderer\LinkProcessor\LinkProcessorInterface
     */
    public function getLinkProcessor()
    {
        return $this->linkProcessor;
    }
}
