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
            '\WikiRenderer\Markup\DokuWiki\NoWikiInline',
            //'\WikiRenderer\Markup\DokuWiki\Footnote',
        ),
        '\WikiRenderer\Markup\DokuWiki\TableRow' => array(
            '\WikiRenderer\Markup\DokuWiki\Strong',
            '\WikiRenderer\Markup\DokuWiki\Em',
            '\WikiRenderer\Markup\DokuWiki\Del',
            '\WikiRenderer\Markup\DokuWiki\Subscript',
            '\WikiRenderer\Markup\DokuWiki\Superscript',
            '\WikiRenderer\Markup\DokuWiki\Underline',
            '\WikiRenderer\Markup\DokuWiki\Code',
            '\WikiRenderer\Markup\DokuWiki\Link',
            '\WikiRenderer\Markup\DokuWiki\Image',
            '\WikiRenderer\Markup\DokuWiki\NoWikiInline',
            //'\WikiRenderer\Markup\DokuWiki\Footnote',
        ),
    );
    /** List of block parsers. */
    public $blocktags = array(
        '\WikiRenderer\Markup\DokuWiki\Title',
        '\WikiRenderer\Markup\DokuWiki\WikiList',
        '\WikiRenderer\Markup\DokuWiki\Blockquote',
        '\WikiRenderer\Markup\DokuWiki\Table',
        '\WikiRenderer\Markup\DokuWiki\CodeBlock',
        '\WikiRenderer\Markup\DokuWiki\File',
        '\WikiRenderer\Markup\DokuWiki\NoWiki',
        '\WikiRenderer\Markup\DokuWiki\Html',
        '\WikiRenderer\Markup\DokuWiki\Php',
        '\WikiRenderer\Markup\DokuWiki\Macro',
        '\WikiRenderer\Markup\DokuWiki\Pre',
        '\WikiRenderer\Markup\DokuWiki\P',
    );

    public $escapeChar = '';

    /**
     * the base root url from which resources other than
     * wiki page can be found
     */
    public $appBaseUrl = '/';

    /**
     * base url of wiki pages
     */
    public $wikiBaseUrl = '/wiki/%s';

    /**
     * top level header will be h1 if you set to 1, h2 if it is 2 etc..
     */
    public $startHeaderNumber = 1;

    /**
     * content all foot notes
     */
    public $footnotes = array();

    /**
     * prefix for footnotes id
     */
    public $footnotesId = '';

    public $interwikiLinks = array(
        'wp' => 'http://wikipedia.org/%s'
    );

    /**
     * list of functions implementing macros. Functions receive the macro name and
     * a string representing the arguments. It should return a string (empty or not)
     * to insert into the generated content. 
     * @var callable[]  keys are macro name in lower case
     */
    public $macros = array();

    /**
     * html content for footnotes
     * @deprecated
     */
    public $footnotesTemplate = '<div class="footnotes"><h4>Notes</h4>%s</div>';

    public function __construct($wikiBaseUrl='')
    {
        $this->wikiBaseUrl = $wikiBaseUrl ?: '/wiki/%s';
        $this->wordConverters[] = new \WikiRenderer\WordConverter\URLConverter(array($this, 'processLink'));
        $this->simpleTags[] = new LineBreak();
        $this->simpleTags[] = new \WikiRenderer\SimpleTag\Arrows();
        $this->simpleTags[] = new \WikiRenderer\SimpleTag\Trademark();
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

        if (preg_match('/^(\w+)>(.*)$/', $url, $m)) {
            // interwiki links
            $anchor = '';
            if (preg_match('/(#[\w\-_\.0-9]+)$/', $m[1], $m2)) {
                $anchor = $m2[1];
                $m[2] = substr($m[1], 0, -strlen($m2[1]));
            }

            $label = $m[2];
            if ($m[1] == 'this') {
                $url = $this->appBaseUrl.$m[2].$anchor;
            }
            else if (isset($this->interwikiLinks[$m[1]])) {
                $url = sprintf($this->interwikiLinks[$m[1]], $m[2]).$anchor;
            }
            else {
                $url = sprintf($this->wikiBaseUrl, $m[2]).$anchor;
            }
        }
        else if (!preg_match('!^[a-zA-Z]+\://!', $url)) {
            // wiki pages
            if (strpos($url, 'javascript:') !== false) { // for security reason
                $url = '#';
                $label = '#';
            }
            else if (preg_match('/(#[\w\-_\.0-9]+)$/', $url, $m)) {
                if ($url[0] == '#') {
                    $label = $url;
                }
                else {
                    $label = $url = substr($url, 0, -strlen($m[1]));
                    $url = sprintf($this->wikiBaseUrl, $url).$m[1];
                }
            }
            else {
                $url = sprintf($this->wikiBaseUrl, $url);
            }
        }

        if (strlen($label) > 40) {
            $label = substr($label, 0, 40).'(..)';
        }

        return array($url, $label);
    }
}
