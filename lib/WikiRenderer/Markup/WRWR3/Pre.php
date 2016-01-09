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

class Pre extends \WikiRenderer\Block
{
    public $type = 'pre';
    protected $regexp = "/^(\s.*)/";
    protected $_openTag = "<code>\n";
    protected $_closeTag = "\n</code>";
    public function validateDetectedLine()
    {
        $this->text[] = $this->_detectMatch[1];
    }
}
