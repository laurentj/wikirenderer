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

namespace WikiRenderer\Markup\WRHtml;

/**
 * ???
 */
class Code extends \WikiRenderer\TagXhtml
{
    protected $name = 'code';
    public $beginTag = '@@';
    public $endTag = '@@';
}
