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
 * Parser for a strong emphasys inline tag
 */
class Strong extends \WikiRenderer\TagNG
{
    protected $name = 'strong';
    protected $generatorName = 'strong';
    public $beginTag = '__';
    public $endTag = '__';
}
