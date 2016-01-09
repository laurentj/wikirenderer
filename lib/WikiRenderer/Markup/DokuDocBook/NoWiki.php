<?php

/**
 * dokuwiki syntax to docbook 5.0.
 *
 * @author Laurent Jouanneau
 * @copyright 2008 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer\Markup\DokuDocBook;

class NoWiki extends SyntaxHighlight
{
    public $type = 'nowiki';
    protected $_openTag = '<para>';
    protected $_closeTag = '</para>';
    protected $dktag = 'nowiki';
}
