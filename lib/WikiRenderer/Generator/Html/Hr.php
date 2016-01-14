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

namespace WikiRenderer\Generator\Html;

class Hr implements \WikiRenderer\Generator\BlockGeneratorInterface {

    protected $id = '';

    public function setId($id) {
        $this->id = $id;
    }

    public function generate() {
        if ($this->id) {
            return '<hr id="'.htmlspecialchars($this->id).'"/>';
        }
        else {
            return '<hr/>';
        }
    }
}