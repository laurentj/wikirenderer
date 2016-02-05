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

class Link extends AbstractInlineGenerator {
    
    protected $dbTagName = 'a';

    protected $supportedAttributes = array('id', 'href', 'hreflang', 'title');

}