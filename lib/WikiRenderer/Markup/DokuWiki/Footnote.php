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
 * Parser for footnote inline tag.
 */
class Footnote extends \WikiRenderer\Tag
{
    protected $name = 'footnote';
    protected $generatorName = 'footnotelink';
    public $beginTag = '((';
    public $endTag = '))';
}
