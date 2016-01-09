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

class File extends SyntaxHighlight
{
    public $type = 'filesyntaxhighlight';
    protected $_openTag = '<pre class="file-content">';
    protected $_closeTag = '</pre>';
    protected $dktag = 'file';
}
