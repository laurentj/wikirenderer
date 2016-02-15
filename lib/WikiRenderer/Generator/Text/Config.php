<?php

/**
 * Configuration for an TEXT generator.
 *
 * @author Laurent Jouanneau
 * @copyright 2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */
namespace WikiRenderer\Generator\Text;

/**
 * Base class for the configuration.
 */
class Config extends \WikiRenderer\Generator\Config
{
    public $inlineGenerators = array(
        'textline' => '\WikiRenderer\Generator\Text\TextLine',
        'words' => '\WikiRenderer\Generator\Text\Words',
        'linebreak' => '\WikiRenderer\Generator\Text\LineBreak',
        'strong' => '\WikiRenderer\Generator\Text\UnTag',
        'em' => '\WikiRenderer\Generator\Text\UnTag',
        'del' => '\WikiRenderer\Generator\Text\BracketTag',
        'subscript' => '\WikiRenderer\Generator\Text\BracketTag',
        'superscript' => '\WikiRenderer\Generator\Text\BracketTag',
        'variable' => '\WikiRenderer\Generator\Text\UnTag',
        'key' => '\WikiRenderer\Generator\Text\UnTag',
        'insert' => '\WikiRenderer\Generator\Text\UnTag',
        'underline' => '\WikiRenderer\Generator\Text\UnTag',
        'code' => '\WikiRenderer\Generator\Text\Code',
        'quote' => '\WikiRenderer\Generator\Text\Quote',
        'cite' => '\WikiRenderer\Generator\Text\Cite',
        'acronym' => '\WikiRenderer\Generator\Text\Acronym',
        'link' => '\WikiRenderer\Generator\Text\Link',
        'image' => '\WikiRenderer\Generator\Text\Image',
        'video' => '\WikiRenderer\Generator\Text\Video',
        'audio' => '\WikiRenderer\Generator\Text\Audio',
        'flash' => '\WikiRenderer\Generator\Text\Flash',
        'anchor' => '\WikiRenderer\Generator\Text\Anchor',
        'tablecell' => '\WikiRenderer\Generator\Text\TableCell',
        'noformat' => '\WikiRenderer\Generator\Text\NoFormat',
    );

    public $blockGenerators = array(
        'title' => '\WikiRenderer\Generator\Text\Title',
        'list' => '\WikiRenderer\Generator\Text\ItemList',
        'noformat' => '\WikiRenderer\Generator\Text\NoFormatBlock',
        'pre' => '\WikiRenderer\Generator\Text\Preformated',
        'syntaxhighlight' => '\WikiRenderer\Generator\Text\SyntaxHighlighting',
        'blockquote' => '\WikiRenderer\Generator\Text\BlockQuote',
        'hr' => '\WikiRenderer\Generator\Text\Hr',
        'para' => '\WikiRenderer\Generator\Text\Paragraph',
        'definition' => '\WikiRenderer\Generator\Text\Definition',
        'table' => '\WikiRenderer\Generator\Text\Table',
        'html' => '\WikiRenderer\Generator\Text\Html',
    );
}
