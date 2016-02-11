<?php

/**
 * wikirenderer3 (wr3) syntax
 *
 * @author Laurent Jouanneau
 * @copyright 2003-2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer\Markup\WR3;

/**
 * Configuration for the WikiRenderer parser for WR3 markup
 */
class Config extends \WikiRenderer\Config
{
    public $defaultTextLineContainer = '\WikiRenderer\Markup\WR3\TextLine';
    public $textLineContainers = array(
        '\WikiRenderer\Markup\WR3\TextLine' => array(
            '\WikiRenderer\Markup\WR3\Strong',
            '\WikiRenderer\Markup\WR3\Em',
            '\WikiRenderer\Markup\WR3\Code',
            '\WikiRenderer\Markup\WR3\Q',
            '\WikiRenderer\Markup\WR3\Cite',
            '\WikiRenderer\Markup\WR3\Acronym',
            '\WikiRenderer\Markup\WR3\Link',
            '\WikiRenderer\Markup\WR3\Image',
            '\WikiRenderer\Markup\WR3\Anchor',
            //'\WikiRenderer\Markup\WR3\Footnote',
        ),
        '\WikiRenderer\Markup\WR3\DefinitionTextLine' => array(
            '\WikiRenderer\Markup\WR3\Strong',
            '\WikiRenderer\Markup\WR3\Em',
            '\WikiRenderer\Markup\WR3\Code',
            '\WikiRenderer\Markup\WR3\Q',
            '\WikiRenderer\Markup\WR3\Cite',
            '\WikiRenderer\Markup\WR3\Acronym',
            '\WikiRenderer\Markup\WR3\Link',
            '\WikiRenderer\Markup\WR3\Image',
            '\WikiRenderer\Markup\WR3\Anchor',
            //'\WikiRenderer\Markup\WR3\Footnote',
        ),
        '\WikiRenderer\Markup\WR3\TableRow' => array(
            '\WikiRenderer\Markup\WR3\Strong',
            '\WikiRenderer\Markup\WR3\Em',
            '\WikiRenderer\Markup\WR3\Code',
            '\WikiRenderer\Markup\WR3\Q',
            '\WikiRenderer\Markup\WR3\Cite',
            '\WikiRenderer\Markup\WR3\Acronym',
            '\WikiRenderer\Markup\WR3\Link',
            '\WikiRenderer\Markup\WR3\Image',
            '\WikiRenderer\Markup\WR3\Anchor',
            //'\WikiRenderer\Markup\WR3\Footnote',
        ),
    );
    /** List of block parsers. */
    public $blocktags = array(
        '\WikiRenderer\Markup\WR3\Title',
        '\WikiRenderer\Markup\WR3\WikiList',
        '\WikiRenderer\Markup\WR3\Pre',
        '\WikiRenderer\Markup\WR3\Hr',
        '\WikiRenderer\Markup\WR3\Blockquote',
        '\WikiRenderer\Markup\WR3\Definition',
        '\WikiRenderer\Markup\WR3\Table',
        '\WikiRenderer\Markup\WR3\P',
    );

    /**
     * content all foot notes
     */
    public $footnotes = array();

    /**
     * prefix for footnotes id
     */
    public $footnotesId = '';

    /**
     * html content for footnotes
     * @deprecated
     */
    public $footnotesTemplate = '<div class="footnotes"><h4>Notes</h4>%s</div>';

    public function __construct()
    {
        parent::__construct();
        $this->simpleTags[] = new LineBreak();
    }

    /**
     * Called before parsing.
     *
     * It should returns the given text. It may modify the text.
     *
     * @param string $text the wiki text
     * @return string the wiki text
     */
    public function onStart($text)
    {
        $this->footnotesId = rand(0, 30000);
        $this->footnotes = array(); // erase footnotes
        return $text;
    }

    /**
     * Called after parsing.
     *
     * @param string $finalText the generated text in the target format (html...)
     *
     * @return string the final text, which may contains new modifications
     *    (content added at the begining or at the end for example)
     */
    public function onParse($finalText)
    {
        // let's add footnotes
        if (count($this->footnotes)) {
            $footnotes = implode("\n", $this->footnotes);
            $finalText .= str_replace('%s', $footnotes, $this->footnotesTemplate);
        }

        return $finalText;
    }
}
