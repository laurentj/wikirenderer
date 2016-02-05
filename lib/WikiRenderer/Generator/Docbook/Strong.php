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

class Strong extends AbstractInlineGenerator {
    
    protected $dbTagName = 'emphasis';
    
    public function generate() {
        $this->attributes['role'] = 'strong';
        return parent::generate();
    }
}
