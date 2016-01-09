<?php

/**
 * dokuwiki syntax to xhtml.
 *
 * @author Laurent Jouanneau
 * @copyright 2008-2012 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer\Markup\DokuHtml;

class Strong extends Tag
{
    protected $name = 'strong';
    public $beginTag = '**';
    public $endTag = '**';
    protected $additionnalAttributes = array();
}
