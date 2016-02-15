<?php

/**
 * @author Laurent Jouanneau
 * @copyright 2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */
namespace WikiRenderer\LinkProcessor;

/**
 * link processor that supports link on wiki word.
 */
class WikiLinkProcessor implements LinkProcessorInterface
{
    protected $wikiBaseUrl = '';

    /**
     * @param string $wikiBaseUrl base url with %s that will be replaced by
     *                            wiki word
     */
    public function __construct($wikiBaseUrl)
    {
        $this->wikiBaseUrl = $wikiBaseUrl;
    }

    public function processLink($url, $tagName = '')
    {
        $label = $url;

        if (!preg_match('!^[a-zA-Z]+\://!', $url)
            && $url[0] != '/') {
            if (strpos($url, 'javascript:') !== false) { // for security reason
                $url = '#';
                $label = '#';
            } elseif (preg_match('/(#[\w\-_0-9]+)$/', $url, $m)) {
                $label = $url = substr($url, 0, -strlen($m[1]));
                $url = sprintf($this->wikiBaseUrl, $url).$m[1];
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
