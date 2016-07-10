<?php
/**
 * Markdown (CommonMark) syntax.
 *
 * @author Laurent Jouanneau
 * @copyright 2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */
namespace WikiRenderer\Markup\Markdown;

class Config extends \WikiRenderer\Config
{
    public $defaultTextLineContainer = '\WikiRenderer\Markup\Markdown\TextLine';

    public $textLineContainers = array(
        '\WikiRenderer\Markup\Markdown\TextLine' => array(
            /*'\WikiRenderer\Markup\Markdown\Strong',
            '\WikiRenderer\Markup\Markdown\Em',
            '\WikiRenderer\Markup\Markdown\Del',*/
        ),
    );

    public $blocktags = array(
        /*'\WikiRenderer\Markup\Markdown\Title',*/
        '\WikiRenderer\Markup\Markdown\OrderedWikiList',
        '\WikiRenderer\Markup\Markdown\UnorderedWikiList',
        /*'\WikiRenderer\Markup\Markdown\Blockquote',
        '\WikiRenderer\Markup\Markdown\Table',
        '\WikiRenderer\Markup\Markdown\SyntaxHighlight',
        '\WikiRenderer\Markup\Markdown\File',
        '\WikiRenderer\Markup\Markdown\Nowiki',
        '\WikiRenderer\Markup\Markdown\Html',
        '\WikiRenderer\Markup\Markdown\Macro',*/
        '\WikiRenderer\Markup\Markdown\Pre',
        '\WikiRenderer\Markup\Markdown\PreSpace',
        '\WikiRenderer\Markup\Markdown\Para'
    );

    public function __construct()
    {
        parent::__construct();
        //$this->simpleTags[] = new LineBreak();
    }



    /**
     * called after the parsing
     */
    public function onParse($finalText)
    {
        return $finalText;
    }
}

