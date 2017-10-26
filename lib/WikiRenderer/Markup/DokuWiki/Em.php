<?php

/**
 * DokuWiki syntax.
 *
 * @author Laurent Jouanneau
 * @copyright 2008-2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */
namespace WikiRenderer\Markup\DokuWiki;

/**
 * Parser for emphasys inline tag.
 */
class Em extends \WikiRenderer\InlineTag
{
    protected $name = 'em';
    protected $generatorName = 'em';
    public $beginTag = '//';
    public $endTag = '//';
}
