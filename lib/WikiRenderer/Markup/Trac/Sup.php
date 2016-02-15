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
 * Parser for sup inline tag.
 */
class Sup extends \WikiRenderer\Tag
{
    protected $name = 'sup';
    protected $generatorName = 'superscript';
    public $beginTag = '^';
    public $endTag = '^';
}
