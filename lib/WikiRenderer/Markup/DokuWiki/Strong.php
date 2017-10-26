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
 * Parser for a strong emphasys inline tag.
 */
class Strong extends \WikiRenderer\InlineTag
{
    protected $name = 'strong';
    protected $generatorName = 'strong';
    public $beginTag = '**';
    public $endTag = '**';
}
