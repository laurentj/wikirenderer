<?php

/**
 * wikirenderer3 (wr3) syntax to xhtml.
 *
 * @author Laurent Jouanneau
 * @copyright 2003-2006 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer\Markup\WR3Html;

/**
 * ???
 */
class P extends \WikiRenderer\Block
{
    public $type = 'p';
    protected $_openTag = '<p>';
    protected $_closeTag = '</p>';

    public function detect($string, $inBlock = false)
    {
        if ($string == '') {
            return false;
        }
        if (preg_match("/^\s*[\*#\-\!\| \t>;<=].*/", $string)) {
            return false;
        }
        $this->_detectMatch = array($string, $string);

        return true;
    }
}
