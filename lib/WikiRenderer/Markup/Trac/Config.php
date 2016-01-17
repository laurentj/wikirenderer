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
            /*
            '\WikiRenderer\Markup\Trac\Image',
            */
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
        /*'\WikiRenderer\Markup\Trac\Pre',
        */
        '\WikiRenderer\Markup\Trac\P',
    );
    public $simpletags = array('%%%' => '<br />');

    public $sectionLevel = array();

    /**
     * top level header will be <h1> if you set to 1, <h2> if it is 2 etc..
     * @var integer
     */
    public $startHeaderNumber = 1; 

    public $wikiWordBaseUrl = '/wiki/%s';
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

    public $macros = array();

    public function __construct()
    {
        $this->wordConverters[] = new URLConverter(array($this, 'processLink'));
        $this->wordConverters[] = new TicketConverter(array($this, 'processLink'));
        $this->wordConverters[] = new ReportConverter(array($this, 'processLink'));
        $this->wordConverters[] = new \WikiRenderer\WordConverter\WikiWordConverter($this->wikiWordBaseUrl, '!');
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
        if (!preg_match('/^([a-z]+)\:([^\s]+)|#(\d+)|{(\d+)}|\[(\d+)\]$/', $url, $m)) {
            if (preg_match("/^([A-Z]\p{Ll}+[A-Z0-9][\p{Ll}\p{Lu}0-9]*)$/u", $url)) {
                return array ($this->linkBaseUrl['wiki'].$url, $url);
            }
            return array('', '');
        }

        if ($m[1]) {
            switch($m[1]) {
                case 'http':
                case 'https':
                case 'ftp':
                case 'irc':
                case 'mailto':
                    $label = $url;
                    if (strlen($label) > 40) {
                        $label = substr($label, 0, 40).'(..)';
                    }
                    return array(trim($url),$label);
                case 'wiki':
                case 'source':
                    return array ($this->linkBaseUrl[$m[1]].$m[2], $m[2]);
                case 'javascript':
                    // javascript protocol is forbidden for security reasons
                    return array('#','');
                default:
                    if (isset($this->linkBaseUrl[$m[1]])) {
                        return array ($this->linkBaseUrl[$m[1]].$m[2], $m[1].' '.$m[2]);
                    }
                    return array('', '');
            }
        }

        if ($m[3]) {
            return array ($this->linkBaseUrl['ticket'].$m[3], $m[0]);
        }

        if ($m[4]) {
            return array ($this->linkBaseUrl['report'].$m[4], $m[0]);
        }

        if ($m[5]) {
            return array ($this->linkBaseUrl['changeset'].$m[5], $m[0]);
        }

        return array('', '');
    }
}
