<?php

/**
 * Trac syntax.
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
 * Parser for sub inline tag.
 */
class Sub extends \WikiRenderer\Tag
{
    protected $name = 'sub';
    protected $generatorName = 'subscript';
    public $beginTag = ',,';
    public $endTag = ',,';
}
