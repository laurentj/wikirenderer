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

class Definition extends \WikiRenderer\Block
{
    public $type = 'dfn';
    protected $regexp = '/^;(.*) : (.*)/i';
    public function validateDetectedLine()
    {
        $this->text[] = ';'.$this->_renderInlineTag($this->_detectMatch[1]).' : '.$this->_renderInlineTag($this->_detectMatch[2]);
    }
}
