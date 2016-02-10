<?php

/**
 * 
 *
 * @author Laurent Jouanneau
 * @copyright 2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer\LinkProcessor;


class SimpleLinkProcessor implements LinkProcessorInterface {

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