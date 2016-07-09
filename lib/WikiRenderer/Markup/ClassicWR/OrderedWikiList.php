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
 * Parse a list block.
 */
class OrderedWikiList extends \WikiRenderer\Markup\WR3\OrderedWikiList
{
    protected $regexp = "/^(#)\\s?(.*)/";
}
