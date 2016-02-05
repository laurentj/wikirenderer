<?php

/**
 * Configuration for a Dockbook generator
 *
 * @author Laurent Jouanneau
 *
 * @copyright 2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer\Generator\Dockbook;

/**
 * Base class for the configuration.
 */
class Config extends \WikiRenderer\Generator\Config
{
    public $inlineGenerators = array(
        'textline' => '\WikiRenderer\Generator\Dockbook\TextLine',
        'words'    => '\WikiRenderer\Generator\Dockbook\Words',
        'strong'   => '\WikiRenderer\Generator\Dockbook\Strong',
        'em'       => '\WikiRenderer\Generator\Dockbook\Em',
        'del'      => '\WikiRenderer\Generator\Dockbook\Del',
        'sub'      => '\WikiRenderer\Generator\Dockbook\Sub',
        'sup'      => '\WikiRenderer\Generator\Dockbook\Sup',
        'variable' => '\WikiRenderer\Generator\Dockbook\Variable',
        'key'      => '\WikiRenderer\Generator\Dockbook\Key',
        'insert'   => '\WikiRenderer\Generator\Dockbook\Ins',
        'underline'=> '\WikiRenderer\Generator\Dockbook\Underline',
        'code'     => '\WikiRenderer\Generator\Dockbook\Code',
        'quote'    => '\WikiRenderer\Generator\Dockbook\Quote',
        'cite'     => '\WikiRenderer\Generator\Dockbook\Cite',
        'acronym'  => '\WikiRenderer\Generator\Dockbook\Acronym',
        'link'     => '\WikiRenderer\Generator\Dockbook\Link',
        'image'    => '\WikiRenderer\Generator\Dockbook\Image',
        'video'    => '\WikiRenderer\Generator\Dockbook\Video',
        'audio'    => '\WikiRenderer\Generator\Dockbook\Audio',
        'flash'    => '\WikiRenderer\Generator\Dockbook\Flash',
        'anchor'   => '\WikiRenderer\Generator\Dockbook\Anchor',
        'linebreak'=> '\WikiRenderer\Generator\Dockbook\LineBreak',
        'tablecell'  => '\WikiRenderer\Generator\Dockbook\TableCell',
        'noformat' => '\WikiRenderer\Generator\Dockbook\NoFormat',
    );

    public $blockGenerators = array(
        'title'      => '\WikiRenderer\Generator\Dockbook\Title',
        'list'       => '\WikiRenderer\Generator\Dockbook\HtmlList',
        'noformat'   => '\WikiRenderer\Generator\Dockbook\NoFormatBlock',
        'pre'        => '\WikiRenderer\Generator\Dockbook\Preformated',
        'syntaxhighlight' => '\WikiRenderer\Generator\Dockbook\SyntaxHighlighting',
        'blockquote' => '\WikiRenderer\Generator\Dockbook\BlockQuote',
        'hr'         => '\WikiRenderer\Generator\Dockbook\Hr',
        'definition' => '\WikiRenderer\Generator\Dockbook\Definition',
        'table'      => '\WikiRenderer\Generator\Dockbook\Table',
        'html'      => '\WikiRenderer\Generator\Dockbook\Html',
        'para'       => '\WikiRenderer\Generator\Dockbook\Paragraph',
    );
}