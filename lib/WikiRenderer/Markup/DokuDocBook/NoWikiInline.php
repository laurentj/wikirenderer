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

class NoWikiInline extends \WikiRenderer\TagXml
{
    protected $name = 'nowiki';
    public $beginTag = '<nowiki>';
    public $endTag = '</nowiki>';

    public function getContent()
    {
        return '<phrase>'.htmlspecialchars($this->wikiContentArr[0], ENT_NOQUOTES).'</phrase>';
    }
}
