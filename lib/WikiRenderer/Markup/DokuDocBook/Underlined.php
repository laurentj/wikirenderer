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

class Underlined extends \WikiRenderer\TagXml
{
    protected $name = 'underlined';
    public $beginTag = '__';
    public $endTag = '__';

    public function getContent()
    {
        return $this->contents[0];
    }
}
