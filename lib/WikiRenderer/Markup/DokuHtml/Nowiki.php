<?php

/**
 * dokuwiki syntax to xhtml.
 *
 * @author Laurent Jouanneau
 * @copyright 2008-2012 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer\Markup\DokuHtml;

class Nowiki extends SyntaxHighlight
{
    public $type = 'nowikisyntaxhighlight';
    protected $_openTag = '<pre>';
    protected $_closeTag = '</pre>';
    protected $dktag = 'nowiki';
}
