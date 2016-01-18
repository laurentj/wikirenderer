<?php

/**
 * DokuWiki syntax
 *
 * @author Laurent Jouanneau
 * @copyright 2008-2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer\Markup\DokuWiki;

/**
 * Configuration for the WikiRenderer parser for Dokuwiki markup
 */
class Config extends \WikiRenderer\Config
{
    public $defaultTextLineContainer = '\WikiRenderer\Markup\DokuWiki\TextLine';
    public $textLineContainers = array(
        '\WikiRenderer\Markup\DokuWiki\TextLine' => array(
            '\WikiRenderer\Markup\DokuWiki\Strong',
            '\WikiRenderer\Markup\DokuWiki\Em',
            '\WikiRenderer\Markup\DokuWiki\Del',
            '\WikiRenderer\Markup\DokuWiki\Subscript',
            '\WikiRenderer\Markup\DokuWiki\Superscript',
            '\WikiRenderer\Markup\DokuWiki\Underline',
            '\WikiRenderer\Markup\DokuWiki\Code',
            '\WikiRenderer\Markup\DokuWiki\Image',
            '\WikiRenderer\Markup\DokuWiki\Link',
            //'\WikiRenderer\Markup\DokuWiki\Anchor',
            //'\WikiRenderer\Markup\DokuWiki\Footnote',
        ),
        /*'\WikiRenderer\Markup\DokuWiki\DefinitionTextLine' => array(
            '\WikiRenderer\Markup\DokuWiki\Strong',
            '\WikiRenderer\Markup\DokuWiki\Em',
            '\WikiRenderer\Markup\DokuWiki\Del',
            '\WikiRenderer\Markup\DokuWiki\Subscript',
            '\WikiRenderer\Markup\DokuWiki\Superscript',
            '\WikiRenderer\Markup\DokuWiki\Underline',
            '\WikiRenderer\Markup\DokuWiki\Code',
            '\WikiRenderer\Markup\DokuWiki\Link',
            '\WikiRenderer\Markup\DokuWiki\Image',
            '\WikiRenderer\Markup\DokuWiki\Anchor',
            //'\WikiRenderer\Markup\DokuWiki\Footnote',
        ),*/
        /*'\WikiRenderer\Markup\DokuWiki\TableRow' => array(
            '\WikiRenderer\Markup\DokuWiki\Strong',
            '\WikiRenderer\Markup\DokuWiki\Em',
            '\WikiRenderer\Markup\DokuWiki\Del',
            '\WikiRenderer\Markup\DokuWiki\Subscript',
            '\WikiRenderer\Markup\DokuWiki\Superscript',
            '\WikiRenderer\Markup\DokuWiki\Underline',
            '\WikiRenderer\Markup\DokuWiki\Code',
            '\WikiRenderer\Markup\DokuWiki\Link',
            '\WikiRenderer\Markup\DokuWiki\Image',
            '\WikiRenderer\Markup\DokuWiki\Anchor',
            //'\WikiRenderer\Markup\DokuWiki\Footnote',
        ),*/
    );
    /** List of block parsers. */
    public $blocktags = array(
        //'\WikiRenderer\Markup\DokuWiki\Title',
        //'\WikiRenderer\Markup\DokuWiki\WikiList',
        //'\WikiRenderer\Markup\DokuWiki\Pre',
        //'\WikiRenderer\Markup\DokuWiki\Hr',
        '\WikiRenderer\Markup\DokuWiki\Blockquote',
        //'\WikiRenderer\Markup\DokuWiki\Definition',
        //'\WikiRenderer\Markup\DokuWiki\Table',
        '\WikiRenderer\Markup\DokuWiki\P',
    );
    public $simpletags = array('\\\\' => '');

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
        $this->wordConverters[] = new \WikiRenderer\WordConverter\URLConverter(array($this, 'processLink'));
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

    public function processLink($url, $tagName = '')
    {
        $label = $url;
        if (strlen($label) > 40) {
            $label = substr($label, 0, 40).'(..)';
        }

        if (strpos($url, 'javascript:') !== false) { // for security reason
            $url = '#';
        }

        return array($url, $label);
    }
}
