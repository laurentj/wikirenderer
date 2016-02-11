<?php

/**
 * Original wikirenderer (wr) syntax
 *
 * @author Laurent Jouanneau
 * @copyright 2003-2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer\Markup\ClassicWR;

/**
 * Configuration for the WikiRenderer parser for WR markup
 */
class Config extends \WikiRenderer\Config
{
    public $defaultTextLineContainer = '\WikiRenderer\Markup\WR3\TextLine';
    public $textLineContainers = array(
        '\WikiRenderer\Markup\WR3\TextLine' => array(
            '\WikiRenderer\Markup\WR3\Strong',
            '\WikiRenderer\Markup\WR3\Em',
            '\WikiRenderer\Markup\ClassicWR\Code',
            '\WikiRenderer\Markup\WR3\Q',
            '\WikiRenderer\Markup\WR3\Cite',
            '\WikiRenderer\Markup\WR3\Acronym',
            '\WikiRenderer\Markup\ClassicWR\Link',
            '\WikiRenderer\Markup\WR3\Image',
            '\WikiRenderer\Markup\WR3\Anchor'
        ),
        '\WikiRenderer\Markup\WR3\DefinitionTextLine' => array(
            '\WikiRenderer\Markup\WR3\Strong',
            '\WikiRenderer\Markup\WR3\Em',
            '\WikiRenderer\Markup\ClassicWR\Code',
            '\WikiRenderer\Markup\WR3\Q',
            '\WikiRenderer\Markup\WR3\Cite',
            '\WikiRenderer\Markup\WR3\Acronym',
            '\WikiRenderer\Markup\ClassicWR\Link',
            '\WikiRenderer\Markup\WR3\Image',
            '\WikiRenderer\Markup\WR3\Anchor'
        ),
        '\WikiRenderer\Markup\WR3\TableRow' => array(
            '\WikiRenderer\Markup\WR3\Strong',
            '\WikiRenderer\Markup\WR3\Em',
            '\WikiRenderer\Markup\ClassicWR\Code',
            '\WikiRenderer\Markup\WR3\Q',
            '\WikiRenderer\Markup\WR3\Cite',
            '\WikiRenderer\Markup\WR3\Acronym',
            '\WikiRenderer\Markup\ClassicWR\Link',
            '\WikiRenderer\Markup\WR3\Image',
            '\WikiRenderer\Markup\WR3\Anchor'
        ),
    );

    /** List of block parsers. */
    public $blocktags = array(
        '\WikiRenderer\Markup\ClassicWR\Title',
        '\WikiRenderer\Markup\ClassicWR\WikiList',
        '\WikiRenderer\Markup\ClassicWR\Pre',
        '\WikiRenderer\Markup\ClassicWR\Hr',
        '\WikiRenderer\Markup\ClassicWR\Blockquote',
        '\WikiRenderer\Markup\ClassicWR\Definition',
        '\WikiRenderer\Markup\ClassicWR\Table',
        '\WikiRenderer\Markup\ClassicWR\P',
    );

    public function __construct()
    {
        parent::__construct();
        $this->simpleTags[] = new \WikiRenderer\Markup\WR3\LineBreak();
        $this->simpleTags[] = new \WikiRenderer\SimpleTag\Smiley();
    }
}
