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

class Link extends AbstractInlineGenerator {
    
    protected $htmlTagName = 'a';

    protected $supportedAttributes = array('id', 'href', 'hreflang', 'title');

}