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
class Q extends \WikiRenderer\TagXhtml
{
    protected $name = 'q';
    public $beginTag = '^^';
    public $endTag = '^^';
    protected $attribute = array('$$','lang','cite');
    public $separators = array('|');
}
