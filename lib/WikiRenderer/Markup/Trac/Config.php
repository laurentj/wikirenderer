<?php

/**
 * Trac syntax
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
 * Configuration for the WikiRenderer parser for Trac markup
 */
class Config extends \WikiRenderer\Config
{
    public $defaultTextLineContainer = '\WikiRenderer\Markup\Trac\TextLine';
    public $textLineContainers = array(
        '\WikiRenderer\Markup\Trac\TextLine' => array(
            '\WikiRenderer\Markup\Trac\Strong',
            /*'\WikiRenderer\Markup\Trac\Em',
            '\WikiRenderer\Markup\Trac\Code',
            '\WikiRenderer\Markup\Trac\Q',
            '\WikiRenderer\Markup\Trac\Cite',
            '\WikiRenderer\Markup\Trac\Acronym',
            '\WikiRenderer\Markup\Trac\Link',
            '\WikiRenderer\Markup\Trac\Image',
            '\WikiRenderer\Markup\Trac\Anchor',*/
            //'\WikiRenderer\Markup\Trac\Footnote',
        ),
        '\WikiRenderer\Markup\Trac\DefinitionTextLine' => array(
            /*'\WikiRenderer\Markup\Trac\Strong',
            '\WikiRenderer\Markup\Trac\Em',
            '\WikiRenderer\Markup\Trac\Code',
            '\WikiRenderer\Markup\Trac\Q',
            '\WikiRenderer\Markup\Trac\Cite',
            '\WikiRenderer\Markup\Trac\Acronym',
            '\WikiRenderer\Markup\Trac\Link',
            '\WikiRenderer\Markup\Trac\Image',
            '\WikiRenderer\Markup\Trac\Anchor',*/
            //'\WikiRenderer\Markup\Trac\Footnote',
        ),
        '\WikiRenderer\Markup\Trac\TableRow' => array(
            /*'\WikiRenderer\Markup\Trac\Strong',
            '\WikiRenderer\Markup\Trac\Em',
            '\WikiRenderer\Markup\Trac\Code',
            '\WikiRenderer\Markup\Trac\Q',
            '\WikiRenderer\Markup\Trac\Cite',
            '\WikiRenderer\Markup\Trac\Acronym',
            '\WikiRenderer\Markup\Trac\Link',
            '\WikiRenderer\Markup\Trac\Image',
            '\WikiRenderer\Markup\Trac\Anchor',*/
            //'\WikiRenderer\Markup\Trac\Footnote',
        ),
    );
    /** List of block parsers. */
    public $blocktags = array(
        /*'\WikiRenderer\Markup\Trac\Title',
        '\WikiRenderer\Markup\Trac\WikiList',
        '\WikiRenderer\Markup\Trac\Pre',
        '\WikiRenderer\Markup\Trac\Hr',
        '\WikiRenderer\Markup\Trac\Blockquote',
        '\WikiRenderer\Markup\Trac\Definition',
        '\WikiRenderer\Markup\Trac\Table',
        '\WikiRenderer\Markup\Trac\P',*/
    );
    public $simpletags = array('%%%' => '<br />');

    public $sectionLevel = array();

    /**
     * top level header will be <h1> if you set to 1, <h2> if it is 2 etc..
     * @var integer
     */
    public $startHeaderNumber = 1; 

    public $wikiWordBaseUrl = '/';
    public $linkBaseUrl = array(
        'ticket' => '/ticket/',
        'report' => '/report/',
        'changeset' => '/changeset/',
        'log' => '/log/',
        'wiki' => '/wiki/',
        'milestone' => '/milestone/',
        'source' => '/browser/',
        'attachement' => '/attachment/',
    );

    public function __construct()
    {
        $this->checkWikiWordFunction = array($this, 'transformWikiWord');
    }

    public function transformWikiWord($ww)
    {
        if (!is_array($ww)) {
            return '<a href="'.$this->wikiWordBaseUrl.$ww.'/">'.$ww.'</a>';
        }

        $result = array();
        foreach ($ww as $w) {
            $result[] = '<a href="'.$this->wikiWordBaseUrl.$w.'">'.$w.'</a>';
        }

        return $result;
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
        $this->sectionLevel = array();
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
        return $finalText;
    }

    public function processLink($url, $tagName = '')
    {
        if (preg_match('/^([a-z]+):(.+)/', $href, $m)) {
            return array('', '');
        }

        $label = $url;
        if (strlen($label) > 40) {
            $label = substr($label, 0, 40).'(..)';
        }


        if ($m[1] == 'http' || $m[1] == 'https' || $m[1] == 'ftp' || $m[1] == 'irc' || $m[1] == 'mailto') {
            return array(trim($href),$label);
        }
        if (isset($this->config->linkBaseUrl[$m[1]])) {
            if ($m[1] == 'wiki' || $m[1] == 'source') {
                return array ($this->config->linkBaseUrl[$m[1]].$m[2], $m[2]);
            } else {
                return array ($this->config->linkBaseUrl[$m[1]].$m[2], $m[1].' '.$m[2]);
            }
        }

        // all other protocols are forbidden for security reasons, (especially javascript:)
        return array('', '');
    }
}
