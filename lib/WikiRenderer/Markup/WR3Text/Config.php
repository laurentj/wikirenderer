<?php

/**
 * wikirenderer3 syntax to plain text.
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

namespace WikiRenderer\Markup\WR3Text;

/**
 * ???
 */
class Config extends \WikiRenderer\Config
{
    public $defaultTextLineContainer = '\WikiRenderer\TextLine';
    public $textLineContainers = array(
        '\WikiRenderer\TextLine' => array(
            '\WikiRenderer\Markup\WR3Text\Strong',
            '\WikiRenderer\Markup\WR3Text\Em',
            '\WikiRenderer\Markup\WR3Text\Code',
            '\WikiRenderer\Markup\WR3Text\Q',
            '\WikiRenderer\Markup\WR3Text\Cite',
            '\WikiRenderer\Markup\WR3Text\Acronym',
            '\WikiRenderer\Markup\WR3Text\Link',
            '\WikiRenderer\Markup\WR3Text\Image',
            '\WikiRenderer\Markup\WR3Text\Anchor',
            '\WikiRenderer\Markup\WR3Text\Footnote',
        ),
    );
    /** Liste des balises de type bloc reconnus par WikiRenderer. */
    public $blocktags = array(
        '\WikiRenderer\Markup\WR3Text\Title',
        '\WikiRenderer\Markup\WR3Text\List',
        '\WikiRenderer\Markup\WR3Text\Pre',
        '\WikiRenderer\Markup\WR3Text\Hr',
        '\WikiRenderer\Markup\WR3Text\Blockquote',
        '\WikiRenderer\Markup\WR3Text\Definition',
        '\WikiRenderer\Markup\WR3Text\Table',
        '\WikiRenderer\Markup\WR3Text\P',
    );
    public $simpletags = array('%%%' => "\n");
}
