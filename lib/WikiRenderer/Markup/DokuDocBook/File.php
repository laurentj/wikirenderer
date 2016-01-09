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

class File extends SyntaxHighlight
{
    public $type = 'file';
    protected $_openTag = '<literallayout>';
    protected $_closeTag = '</literallayout>';
    protected $dktag = 'file';
}
