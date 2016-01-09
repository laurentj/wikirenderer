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

class Title extends \WikiRenderer\Block
{
    public $type = 'title';
    protected $regexp = "/^(\!{1,3})(.*)/";
    protected $_closeNow = true;
    public function validateDetectedLine()
    {
        $this->text[] = $this->_detectMatch[1].$this->_renderInlineTag($this->_detectMatch[2]);
    }
}
