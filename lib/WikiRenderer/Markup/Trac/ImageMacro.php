<?php

/**
 * Trac syntax
 *
 * @author Laurent Jouanneau
 * @copyright 2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer\Markup\Trac;

/**
 * Image() macro
 * 
 */
class ImageMacro implements MacroInterface {

    /**
     * @return boolean true if the given wiki content is the macro
     */
    function match($wikiContent) {
        return preg_match('/^Image\([^\)]+\)$/', $wikiContent);
    }

    /**
     * returns the generator corresponding to the macro
     * @return \WikiRenderer\Generator\InlineGeneratorInterface
     */
    function getContent(\WikiRenderer\Markup\Trac\Config $config,
                        \WikiRenderer\Generator\DocumentGeneratorInterface $documentGenerator,
                        $wikiContent) {
        preg_match('/^Image\(([^\)]+)\)$/', $wikiContent, $attributes);
        $image = $documentGenerator->getInlineGenerator('image');

        $params = preg_split('/\s*,\s*/', $attributes[1]);
        $file = $config->getLinkProcessor()->processLink(trim(array_shift($params)), 'image');
        $image->setAttribute('src', $file[0]);

        $width = null;
        $nolink = false;
        $hasAlt = false;

        foreach ($params as $p) {
            $p = trim($p);
            if (in_array($p, array('right', 'left', 'top', 'bottom'))) {
                $image->setAttribute('align', $p); 
            } elseif ($p == 'nolink') {
                $nolink = true;
            } elseif (preg_match('/^(\d+)(px|em|\%)?$/', $p)) {
                if ($width === null) {
                    $width = $p;
                    $image->setAttribute('width', $p);
                } else {
                    $image->setAttribute('height', $p);
                }
            } elseif (preg_match('/^(align|width|height|alt|title|longdesc|class|id)=(.*)$/', $p, $m)) {
                $image->setAttribute($m[1], $m[2]);
            }
        }

        if ($nolink) {
            return $image;
        } else {
            $link = $documentGenerator->getInlineGenerator('link');
            $link->addContent($image);
            $link->setAttribute('href', $file[0]);
            return $link;
        }
    }
}