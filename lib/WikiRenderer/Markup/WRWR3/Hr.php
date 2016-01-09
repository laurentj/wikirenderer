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

class Hr extends \WikiRenderer\Block
{
    public $type = 'hr';
    protected $regexp = '/^(={4,}) *$/';
    protected $_closeNow = true;
    public function validateDetectedLine()
    {
        $this->text[] = $this->_detectMatch[1];
    }
}
