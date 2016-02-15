<?php

/**
 * Configuration for a Docbook generator.
 *
 * @author Laurent Jouanneau
 * @copyright 2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */
namespace WikiRenderer\Generator\Docbook;

/**
 * Base class for the configuration.
 */
class Config extends \WikiRenderer\Generator\Config
{
    public $inlineGenerators = array(
        'textline' => '\WikiRenderer\Generator\Docbook\TextLine',
        'words' => '\WikiRenderer\Generator\Docbook\Words',
        'strong' => '\WikiRenderer\Generator\Docbook\Strong',
        'em' => '\WikiRenderer\Generator\Docbook\Em',
        'del' => '\WikiRenderer\Generator\Docbook\Del',
        'subscript' => '\WikiRenderer\Generator\Docbook\Sub',
        'superscript' => '\WikiRenderer\Generator\Docbook\Sup',
        'variable' => '\WikiRenderer\Generator\Docbook\Variable',
        'key' => '\WikiRenderer\Generator\Docbook\Key',
        'insert' => '\WikiRenderer\Generator\Docbook\Ins',
        'underline' => '\WikiRenderer\Generator\Docbook\Underline',
        'code' => '\WikiRenderer\Generator\Docbook\Code',
        'quote' => '\WikiRenderer\Generator\Docbook\Quote',
        'cite' => '\WikiRenderer\Generator\Docbook\Cite',
        'acronym' => '\WikiRenderer\Generator\Docbook\Acronym',
        'link' => '\WikiRenderer\Generator\Docbook\Link',
        'image' => '\WikiRenderer\Generator\Docbook\Image',
        'video' => '\WikiRenderer\Generator\Docbook\Video',
        'audio' => '\WikiRenderer\Generator\Docbook\Audio',
        'flash' => '\WikiRenderer\Generator\Docbook\Flash',
        'anchor' => '\WikiRenderer\Generator\Docbook\Anchor',
        'linebreak' => '\WikiRenderer\Generator\Docbook\LineBreak',
        'tablecell' => '\WikiRenderer\Generator\Docbook\TableCell',
        'noformat' => '\WikiRenderer\Generator\Docbook\NoFormat',
    );

    public $blockGenerators = array(
        'title' => '\WikiRenderer\Generator\Docbook\Title',
        'list' => '\WikiRenderer\Generator\Docbook\DocbookList',
        'noformat' => '\WikiRenderer\Generator\Docbook\NoFormatBlock',
        'pre' => '\WikiRenderer\Generator\Docbook\Preformated',
        'syntaxhighlight' => '\WikiRenderer\Generator\Docbook\SyntaxHighlighting',
        'blockquote' => '\WikiRenderer\Generator\Docbook\BlockQuote',
        'hr' => '\WikiRenderer\Generator\Docbook\Hr',
        'definition' => '\WikiRenderer\Generator\Docbook\Definition',
        'table' => '\WikiRenderer\Generator\Docbook\Table',
        'html' => '\WikiRenderer\Generator\Docbook\Html',
        'para' => '\WikiRenderer\Generator\Docbook\Paragraph',
    );
}
