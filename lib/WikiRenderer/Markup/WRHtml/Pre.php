<?php

/**
 * classic wikirenderer syntax to xhtml.
 *
 * @author Laurent Jouanneau
 * @copyright 2003-2006 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer\Markup\WRHtml;

/**
 * ???
 */
class Pre extends \WikiRenderer\Block
{
    public $type = 'pre';
    protected $regexp = "/^\s(.*)/";
    protected $_openTag = '<pre>';
    protected $_closeTag = '</pre>';

    public function validateDetectedLine()
    {
        $this->text[] = htmlspecialchars($this->_detectMatch[1]);
    }
}
