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

class Cite extends AbstractInlineGenerator {

    protected $dbTagName = 'cite';

    protected $supportedAttributes = array('id', 'title');
}