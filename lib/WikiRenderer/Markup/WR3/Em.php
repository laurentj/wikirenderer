<?php

/**
 * wikirenderer3 (wr3) syntax.
 *
 * @author Laurent Jouanneau
 * @copyright 2003-2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */
namespace WikiRenderer\Markup\WR3;

/**
 * Parser for emphasys inline tag.
 */
class Em extends \WikiRenderer\InlineTag
{
    protected $name = 'em';
    protected $generatorName = 'em';
    public $beginTag = '\'\'';
    public $endTag = '\'\'';
}
