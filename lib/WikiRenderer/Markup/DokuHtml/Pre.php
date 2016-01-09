<?php

/**
 * dokuwiki syntax to xhtml.
 *
 * @author Laurent Jouanneau
 * @copyright 2008-2012 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer\Markup\DokuHtml;

class Pre extends \WikiRenderer\Block
{
    public $type = 'pre';
    protected $_openTag = '<pre>';
    protected $_closeTag = '</pre>';

    public function detect($string, $inBlock = false)
    {
        if ($string == '') {
            return false;
        }
        if (preg_match("/^(\s{2,}[^\s\*\-\=\|\^>;<=~].*)/", $string)) {
            $this->_detectMatch = array($string, $string);

            return true;
        }

        return false;
    }
}
