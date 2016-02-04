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

class Code extends AbstractInlineGenerator {

    protected $supportedAttributes = array('id', 'class');

    protected $htmlTagName = 'code';
}