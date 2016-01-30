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

/**
 * @FIXME: generate footnotes for links
 */
class Link extends AbstractInlineGenerator {

    protected $supportedAttributes = array('id', 'href', 'hreflang', 'title');

}