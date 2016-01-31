<?php

/**
 * @author Laurent Jouanneau
 *
 * @copyright 2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer\Generator\Text;

class Acronym extends AbstractInlineGenerator implements \WikiRenderer\Generator\InlineAcronymInterface {
    
    protected $htmlTagName = 'acronym';

    protected $supportedAttributes = array('id');

    protected $attributesInsideBrackets = array('title');

    public function setTitle($title) {
        $this->attributes['title'] = $title;
    }
}