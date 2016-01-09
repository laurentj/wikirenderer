<?php

/**
 * wikirenderer3 (wr3) syntax to docbook 5.0.
 *
 * @author Laurent Jouanneau
 * @contributor  Amaury Bouchard
 *
 * @copyright 2003-2013 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer\Markup\WR3DocBook;

/**
 * ???
 */
class P extends \WikiRenderer\Block
{
    public $type = 'para';
    protected $_openTag = '<para>';
    protected $_closeTag = '</para>';

    public function detect($string, $inBlock = false)
    {
        if (trim($string) == '') {
            return false;
        }
        if (preg_match("/^\s*(\*\*.*)/", $string, $m)) {
            $this->_detectMatch = array($string, $string);

            return true;
        }
        if (preg_match("/^\s*[\*#\-\!\| \t>;<=].*/", $string)) {
            return false;
        }
        $this->_detectMatch = array($string, $string);

        return true;
    }
}
