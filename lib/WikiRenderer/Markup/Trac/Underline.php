<?php

/**
 * Trac syntax
 *
 * @author Laurent Jouanneau
 * @copyright 2006-2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer\Markup\Trac;

/**
 * Parser for emphasys inline tag
 */
class Underline extends \WikiRenderer\TagNG
{
    protected $name = 'u';
    protected $generatorName = 'underline';
    public $beginTag = "__";
    public $endTag = "__";
}
