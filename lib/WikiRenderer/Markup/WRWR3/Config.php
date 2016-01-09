<?php

/**
 * classic wikirenderer syntax to Wikirenderer 3 syntax.
 *
 * @author Laurent Jouanneau
 * @copyright 2003-2014 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer\Markup\WRWR3;

class Config extends \WikiRenderer\Config
{
    public $defaultTextLineContainer = '\WikiRenderer\TextLine';

    public $textLineContainers = array(
            '\WikiRenderer\TextLine' => array(
                '\WikiRenderer\Markup\WRWR3\Strong',
                '\WikiRenderer\Markup\WRWR3\Em',
                '\WikiRenderer\Markup\WRWR3\Code',
                '\WikiRenderer\Markup\WRWR3\Q',
                '\WikiRenderer\Markup\WRWR3\Cite',
                '\WikiRenderer\Markup\WRWR3\Acronym',
                '\WikiRenderer\Markup\WRWR3\Link',
                '\WikiRenderer\Markup\WRWR3\Image',
                '\WikiRenderer\Markup\WRWR3\Anchor',
            ),
        );

    /**
     * liste des balises de type bloc reconnus par WikiRenderer.
     */
    public $blocktags = array(
        '\WikiRenderer\Markup\WRWR3\Title',
        '\WikiRenderer\Markup\WRWR3\WikiList',
        '\WikiRenderer\Markup\WRWR3\Pre',
        '\WikiRenderer\Markup\WRWR3\Hr',
        '\WikiRenderer\Markup\WRWR3\Blockquote',
        '\WikiRenderer\Markup\WRWR3\Definition',
        '\WikiRenderer\Markup\WRWR3\Table',
        '\WikiRenderer\Markup\WRWR3\P', );

    public $simpletags = array('%%%' => "\n");

    public $outputEscapeChar = true;
}
