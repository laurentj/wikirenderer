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

class Q extends \WikiRenderer\Tag
{
    public $beginTag = '^^';
    public $endTag = '^^';
    protected $attribute = array('$$','lang','cite');
    public $separators = array('|');
    public function getContent()
    {
        if ($this->separatorCount == 0) {
            return '^^'.$this->contents[0].'^^';
        } elseif ($this->separatorCount == 1) {
            return '^^'.$this->contents[0].'|'.$this->wikiContentArr[1].'^^';
        } else {
            return '^^'.$this->contents[0].'|'.$this->wikiContentArr[1].'|'.$this->wikiContentArr[2].'^^';
        }
    }
}
