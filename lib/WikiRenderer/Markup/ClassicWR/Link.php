<?php

/**
 * Original wikirenderer (wr) syntax.
 *
 * @author Laurent Jouanneau
 * @copyright 2003-2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */
namespace WikiRenderer\Markup\ClassicWR;

/**
 * Parser for a link.
 */
class Link extends \WikiRenderer\Markup\WR3\Link
{
    protected $beginTag = '[';
    protected $endTag = ']';
}
