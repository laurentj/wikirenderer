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

class Del extends Tag
{
    protected $name = 'del';
    public $beginTag = '<del>';
    public $endTag = '</del>';
    public function getContent()
    {
        return '';
    }
}
