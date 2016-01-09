<?php

/**
 * classic wikirenderer syntax to Wikirenderer 3 syntax.
 *
 * @author Laurent Jouanneau
 * @copyright 2003-2014 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer\Markup\WRWR3;

class Em extends \WikiRenderer\Tag
{
    public $beginTag = '\'\'';
    public $endTag = '\'\'';
    public function getContent()
    {
        return '\'\''.$this->contents[0].'\'\'';
    }
}
