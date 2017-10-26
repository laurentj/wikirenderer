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
 * Parse a line of text.
 */
class TextLine extends \WikiRenderer\InlineTag
{
    protected $generatorName = 'textline';
    public $isTextLineTag = true;
}
