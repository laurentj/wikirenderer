<?php

/**
 * @author Laurent Jouanneau
 * @copyright 2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */
namespace WikiRenderer\Markup\Trac;

/**
 * link processor that support Trac url.
 */
class LinkProcessor implements \WikiRenderer\LinkProcessor\LinkProcessorInterface
{
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

    public function processLink($url, $tagName = '')
    {
        if (!preg_match('/^([a-z]+)\:([^\s]+)|#(\d+)|{(\d+)}|\[(\d+)\]$/', $url, $m)) {
            if (preg_match("/^([A-Z]\p{Ll}+[A-Z0-9][\p{Ll}\p{Lu}0-9]*)$/u", $url)) {
                return array($this->linkBaseUrl['wiki'].$url, $url);
            }
            if ($tagName == 'image') {
                return array($url, '');
            }

            return array('', '');
        }

        if ($m[1]) {
            switch ($m[1]) {
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
                    return array($this->linkBaseUrl[$m[1]].$m[2], $m[2]);
                case 'javascript':
                    // javascript protocol is forbidden for security reasons
                    return array('#','');
                default:
                    if (isset($this->linkBaseUrl[$m[1]])) {
                        return array($this->linkBaseUrl[$m[1]].$m[2], $m[1].' '.$m[2]);
                    }

                    return array('', '');
            }
        }

        if ($m[3]) {
            return array($this->linkBaseUrl['ticket'].$m[3], $m[0]);
        }

        if ($m[4]) {
            return array($this->linkBaseUrl['report'].$m[4], $m[0]);
        }

        if ($m[5]) {
            return array($this->linkBaseUrl['changeset'].$m[5], $m[0]);
        }

        return array('', '');
    }
}
