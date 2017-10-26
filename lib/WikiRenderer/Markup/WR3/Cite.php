<?php

/**
 * wikirenderer3 (wr3) syntax.
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
 * Parse cite inline tag.
 */
class Cite extends \WikiRenderer\InlineTag
{
    protected $name = 'cite';
    protected $generatorName = 'cite';
    public $beginTag = '{{';
    public $endTag = '}}';
    protected $attribute = array('$$','title');
    public $separators = array('|');
}
