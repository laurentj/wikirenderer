<?php

/**
 * wikirenderer3 (wr3) syntax to xhtml.
 *
 * @author Laurent Jouanneau
 * @copyright 2003-2006 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer\Markup\WR3Html;

/**
 * ???
 */
class Acronym extends \WikiRenderer\TagXhtml
{
    protected $name = 'acronym';
    public $beginTag = '??';
    public $endTag = '??';
    protected $attribute = array('$$','title');
    public $separators = array('|');
}
