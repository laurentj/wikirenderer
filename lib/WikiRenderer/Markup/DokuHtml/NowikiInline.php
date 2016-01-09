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

class NowikiInline extends \WikiRenderer\TagXhtml
{
    protected $name = 'nowiki';
    public $beginTag = '<nowiki>';
    public $endTag = '</nowiki>';
    public function getContent()
    {
        return '<div>'.htmlspecialchars($this->wikiContentArr[0]).'</div>';
    }
}
