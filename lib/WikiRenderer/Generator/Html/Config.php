<?php

/**
 * Configuration for an HTML generator
 *
 * @author Laurent Jouanneau
 *
 * @copyright 2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer\Generator\Html;

/**
 * Base class for the configuration.
 */
class Config extends \WikiRenderer\Generator\Config
{
    public $inlineGenerators = array(
        'textline' => '\WikiRenderer\Generator\Html\TextLine',
        'words'    => '\WikiRenderer\Generator\Html\Words',
        'strong'   => '\WikiRenderer\Generator\Html\Strong',
        'em'       => '\WikiRenderer\Generator\Html\Em',
        'del'       => '\WikiRenderer\Generator\Html\Del',
        'sub'       => '\WikiRenderer\Generator\Html\Sub',
        'sup'       => '\WikiRenderer\Generator\Html\Sup',
        'underline'=> '\WikiRenderer\Generator\Html\Underline',
        'code'     => '\WikiRenderer\Generator\Html\Code',
        'quote'    => '\WikiRenderer\Generator\Html\Quote',
        'cite'     => '\WikiRenderer\Generator\Html\Cite',
        'acronym'  => '\WikiRenderer\Generator\Html\Acronym',
        'link'     => '\WikiRenderer\Generator\Html\Link',
        'image'    => '\WikiRenderer\Generator\Html\Image',
        'anchor'   => '\WikiRenderer\Generator\Html\Anchor',
        'linebreak'=> '\WikiRenderer\Generator\Html\LineBreak',
        'tablecell'  => '\WikiRenderer\Generator\Html\TableCell',
        'noformat' => '\WikiRenderer\Generator\Html\NoFormat',
    );

    public $blockGenerators = array(
        'title'      => '\WikiRenderer\Generator\Html\Title',
        'list'       => '\WikiRenderer\Generator\Html\HtmlList',
        'noformat'   => '\WikiRenderer\Generator\Html\NoFormatBlock',
        'pre'        => '\WikiRenderer\Generator\Html\Preformated',
        'syntaxhighlight' => '\WikiRenderer\Generator\Html\SyntaxHighlighting',
        'blockquote' => '\WikiRenderer\Generator\Html\BlockQuote',
        'hr'         => '\WikiRenderer\Generator\Html\Hr',
        'para'       => '\WikiRenderer\Generator\Html\Paragraph',
        'definition' => '\WikiRenderer\Generator\Html\Definition',
        'table'      => '\WikiRenderer\Generator\Html\Table'
    );
}