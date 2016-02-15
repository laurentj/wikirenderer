<?php

/**
 * @author Laurent Jouanneau
 * @copyright 2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */
namespace WikiRenderer\Markup\DokuWiki;

/**
 * link processor that support Trac url.
 */
class LinkProcessor implements \WikiRenderer\LinkProcessor\LinkProcessorInterface
{
    /**
     * the base root url from which resources other than
     * wiki page can be found.
     */
    public $appBaseUrl = '/';

    /**
     * base url of wiki pages.
     */
    public $wikiBaseUrl = '/wiki/%s';

    public $interwikiLinks = array(
        'wp' => 'http://wikipedia.org/%s',
    );

    public function __construct($wikiBaseUrl = '', $appBaseUrl = '/')
    {
        $this->wikiBaseUrl = $wikiBaseUrl ?: '/wiki/%s';
        $this->appBaseUrl = $appBaseUrl;
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
            } elseif (isset($this->interwikiLinks[$m[1]])) {
                $url = sprintf($this->interwikiLinks[$m[1]], $m[2]).$anchor;
            } else {
                $url = sprintf($this->wikiBaseUrl, $m[2]).$anchor;
            }
        } elseif (!preg_match('!^[a-zA-Z]+\://!', $url)) {
            // wiki pages
            if (strpos($url, 'javascript:') !== false) { // for security reason
                $url = '#';
                $label = '#';
            } elseif (preg_match('/(#[\w\-_\.0-9]+)$/', $url, $m)) {
                if ($url[0] == '#') {
                    $label = $url;
                } else {
                    $label = $url = substr($url, 0, -strlen($m[1]));
                    $url = sprintf($this->wikiBaseUrl, $url).$m[1];
                }
            } else {
                $url = sprintf($this->wikiBaseUrl, $url);
            }
        }

        if (strlen($label) > 40) {
            $label = substr($label, 0, 40).'(..)';
        }

        return array($url, $label);
    }
}
