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

namespace WikiRenderer\Generator\Docbook;

class Acronym extends AbstractInlineGenerator implements \WikiRenderer\Generator\InlineAcronymInterface {
    
    protected $dbTagName = 'acronym';

    protected $supportedAttributes = array('id');

    public function setTitle($title) {
        $this->attributes['title'] = $title;
    }

}