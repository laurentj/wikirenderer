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

class Acronym extends \WikiRenderer\Tag
{
    public $beginTag = '??';
    public $endTag = '??';
    protected $attribute = array('$$','title');
    public $separators = array('|');
    public function getContent()
    {
        if ($this->separatorCount == 0) {
            return '??'.$this->contents[0].'??';
        } else {
            return '??'.$this->contents[0].'|'.$this->wikiContentArr[1].'??';
        }
    }
}
