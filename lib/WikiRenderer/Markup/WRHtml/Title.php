<?php

/**
 * classic wikirenderer syntax to xhtml.
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
class Title extends \WikiRenderer\Markup\WR3Html\Title
{
    protected $regexp = "/^(\!{1,3})(.*)/";
}
