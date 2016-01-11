<?php

/**
 * Trac syntax
 *
 * @author Laurent Jouanneau
 * @copyright 2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer\Markup\Trac;

/**
 * Parser for emphasys inline tag
 */
class Del extends \WikiRenderer\TagNG
{
    protected $name = 'del';
    protected $generatorName = 'del';
    public $beginTag = "~~";
    public $endTag = "~~";
}
