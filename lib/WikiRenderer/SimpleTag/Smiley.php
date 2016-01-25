<?php

/**
 * abstract class processing a simple tag
 *
 * @author Laurent Jouanneau
 * @copyright 2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer\SimpleTag;


class Smiley extends AbstractSimpleTag {

    protected $tag = ":-)";
    
    protected $url = 'laugh.png';

    public function getContent(\WikiRenderer\Generator\DocumentGeneratorInterface $documentGenerator) {
        $img = $documentGenerator->getInlineGenerator('image');
        $img->setAttribute('src', $this->url);
        $img->setAttribute('alt', $this->tag);
        return $img;
    }
}