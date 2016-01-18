<?php

/**
 * DokuWiki syntax
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
 * Parser for sub inline tag
 */
class Subscript extends \WikiRenderer\TagNG
{
    protected $name = 'sub';
    protected $generatorName = 'sub';
    public $beginTag = "<sub>";
    public $endTag = "</sub>";
}
