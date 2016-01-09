<?php

/**
 *
 * @author Laurent Jouanneau
 *
 * @copyright 2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer\Generator\Html;

class LineBreak implements \WikiRenderer\Generator\InlineGeneratorInterface {

    /**
     * @return string
     */
    public function generate() {
        return "<br />";
    }
}
