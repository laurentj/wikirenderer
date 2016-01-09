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

class Strong extends \WikiRenderer\Tag
{
    public $beginTag = '__';
    public $endTag = '__';
    public function getContent()
    {
        return '__'.$this->contents[0].'__';
    }
}
