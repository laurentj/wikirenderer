<?php
/**
 * Markdown (CommonMark) syntax.
 *
 * @author Laurent Jouanneau
 * @copyright 2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */
namespace WikiRenderer\Markup\Markdown;

/**
 * Parser for a strong emphasys inline tag.
 */
class Strong extends \WikiRenderer\Tag
{
    protected $name = 'strong';
    protected $generatorName = 'strong';
    public $beginTag = '**';
    public $endTag = '**';
}
