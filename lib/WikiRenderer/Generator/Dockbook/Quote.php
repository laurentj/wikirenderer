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

namespace WikiRenderer\Generator\Dockbook;

class Quote extends AbstractInlineGenerator {

    protected $dbTagName = 'q';

    protected $supportedAttributes = array('id', 'lang', 'cite');

}