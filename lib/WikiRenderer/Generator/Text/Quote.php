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

class Quote extends AbstractInlineGenerator {

    protected $supportedAttributes = array('id', 'lang', 'cite');

    protected $attributesInsideBrackets = array('cite');

}