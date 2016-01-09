<?php

/**
 * Original wikirenderer (wr) syntax
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
 * Parse a list block
 */
class WikiList extends \WikiRenderer\Markup\WR3\WikiList
{
    protected $regexp = "/^([\*#-]+)\s?(.*)/";
}
