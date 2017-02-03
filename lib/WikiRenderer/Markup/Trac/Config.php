<?php

/**
 * Trac syntax.
 *
 * @author Laurent Jouanneau
 * @copyright 2006-2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */
namespace WikiRenderer\Markup\Trac;

/**
 * Configuration for the WikiRenderer parser for Trac markup.
 */
class Config extends \WikiRenderer\Config
{
    public $defaultTextLineContainer = '\WikiRenderer\Markup\Trac\TextLine';
    public $textLineContainers = array(
        '\WikiRenderer\Markup\Trac\TextLine' => array(
            '\WikiRenderer\Markup\Trac\StrongEm',
            '\WikiRenderer\Markup\Trac\Strong',
            '\WikiRenderer\Markup\Trac\Em',
            '\WikiRenderer\Markup\Trac\Underline',
            '\WikiRenderer\Markup\Trac\Del',
            '\WikiRenderer\Markup\Trac\Sub',
            '\WikiRenderer\Markup\Trac\Sup',
            '\WikiRenderer\Markup\Trac\Code',
            '\WikiRenderer\Markup\Trac\Code2',
            '\WikiRenderer\Markup\Trac\LinkCreole',
            '\WikiRenderer\Markup\Trac\Link',
        ),
        '\WikiRenderer\Markup\Trac\TableRow' => array(
            '\WikiRenderer\Markup\Trac\StrongEm',
            '\WikiRenderer\Markup\Trac\Strong',
            '\WikiRenderer\Markup\Trac\Em',
            '\WikiRenderer\Markup\Trac\Underline',
            '\WikiRenderer\Markup\Trac\Del',
            '\WikiRenderer\Markup\Trac\Sub',
            '\WikiRenderer\Markup\Trac\Sup',
            '\WikiRenderer\Markup\Trac\Code',
            '\WikiRenderer\Markup\Trac\Code2',
            '\WikiRenderer\Markup\Trac\LinkCreole',
            '\WikiRenderer\Markup\Trac\Link',
        ),
    );
    /** List of block parsers. */
    public $blocktags = array(
        '\WikiRenderer\Markup\Trac\Title',
        '\WikiRenderer\Markup\Trac\Hr',
        '\WikiRenderer\Markup\Trac\WikiList',
        '\WikiRenderer\Markup\Trac\Definition',
        '\WikiRenderer\Markup\Trac\Blockquote',
        '\WikiRenderer\Markup\Trac\Blockquote2',
        '\WikiRenderer\Markup\Trac\Table',
        '\WikiRenderer\Markup\Trac\Pre',
        '\WikiRenderer\Markup\Trac\P',
    );

    public $sectionLevel = array();

    /**
     * top level header will be <h1> if you set to 1, <h2> if it is 2 etc..
     *
     * @var int
     */
    public $startHeaderNumber = 1;

    public $wikiWordBaseUrl = '/wiki/%s';

    /**
     * @var MacroInterface[]
     */
    public $macros = array();

    public function __construct()
    {
        $this->linkProcessor = new LinkProcessor();
        $this->wordConverters[] = new URLConverter($this->linkProcessor);
        $this->wordConverters[] = new TicketConverter($this->linkProcessor);
        $this->wordConverters[] = new ReportConverter($this->linkProcessor);
        $this->wordConverters[] = new \WikiRenderer\WordConverter\WikiWordConverter($this->wikiWordBaseUrl, '!');
        $this->macros[] = new ImageMacro();
        $this->simpleTags[] = new LineBreak();
    }

    /**
     * Called before parsing.
     *
     * It should returns the given text. It may modify the text.
     *
     * @param string $text the wiki text
     *
     * @return string the wiki text
     */
    public function onStart($text)
    {
        $this->sectionLevel = array();

        return $text;
    }

    /**
     * Called after parsing.
     *
     * @param string $finalText the generated text in the target format (html...)
     *
     * @return string the final text, which may contains new modifications
     *                (content added at the begining or at the end for example)
     */
    public function onParse($finalText)
    {
        return $finalText;
    }
}
