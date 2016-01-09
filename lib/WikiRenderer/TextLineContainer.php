<?php

/**
 * Wikirenderer is a wiki text parser. It can transform a wiki text into xhtml or other formats.
 *
 * @author Laurent Jouanneau
 * @copyright 2003-2008 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer;

/**
 * ???
 */
class TextLineContainer
{
    /** ??? */
    public $tag = null;
    /** ??? */
    public $allowedTags = array();
    /** ??? */
    public $pattern = '';
}
