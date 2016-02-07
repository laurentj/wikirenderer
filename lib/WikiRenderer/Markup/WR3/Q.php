<?php

/**
 * wikirenderer3 (wr3) syntax
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
 * Parser for a quote inline tag
 */
class Q extends \WikiRenderer\Tag
{
    protected $name = 'q';
    protected $generatorName = 'quote';
    public $beginTag = '^^';
    public $endTag = '^^';
    protected $attribute = array('$$','lang','cite');
    public $separators = array('|');
}
