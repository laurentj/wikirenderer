<?php

/**
 * wikirenderer3 (wr3) syntax to docbook 5.
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

namespace WikiRenderer\Markup\WR3DocBook;

/**
 * ???
 */
class Config extends \WikiRenderer\Config
{
    public $defaultTextLineContainer = '\WikiRenderer\HtmlTextLine';
    public $textLineContainers = array(
        '\WikiRenderer\HtmlTextLine' => array(
            '\WikiRenderer\Markup\WR3DocBook\Strong',
            '\WikiRenderer\Markup\WR3DocBook\Em',
            '\WikiRenderer\Markup\WR3DocBook\Code',
            '\WikiRenderer\Markup\WR3DocBook\Q',
            '\WikiRenderer\Markup\WR3DocBook\Cite',
            '\WikiRenderer\Markup\WR3DocBook\Acronym',
            '\WikiRenderer\Markup\WR3DocBook\Link',
            '\WikiRenderer\Markup\WR3DocBook\Image',
            '\WikiRenderer\Markup\WR3DocBook\Anchor',
            '\WikiRenderer\Markup\WR3DocBook\Footnote',
        ),
    );
    /** Liste des balises de type bloc reconnus par WikiRenderer. */
    public $blocktags = array(
        '\WikiRenderer\Markup\WR3DocBook\Title',
        '\WikiRenderer\Markup\WR3DocBook\WikiList',
        '\WikiRenderer\Markup\WR3DocBook\Pre',
        '\WikiRenderer\Markup\WR3DocBook\Hr',
        '\WikiRenderer\Markup\WR3DocBook\Blockquote',
        '\WikiRenderer\Markup\WR3DocBook\Definition',
        '\WikiRenderer\Markup\WR3DocBook\Table',
        '\WikiRenderer\Markup\WR3DocBook\P',
    );
    public $simpletags = array('%%%' => '<br />');
    public $defaultBlock = '\WikiRenderer\Markup\WR3DocBook\DefaultBlock';
    public $sectionLevel = array();

    /**
     * Called before the parsing.
     *
     * @param string $text ???
     *
     * @return string ???
     */
    public function onStart($text)
    {
        $this->sectionLevel = array();

        return $text;
    }

    /**
     * Called after the parsing.
     *
     * @param string $finalText ???
     *
     * @return string ???
     */
    public function onParse($finalText)
    {
        $finalText .= str_repeat('</section>', count($this->sectionLevel));

        return $finalText;
    }
}
