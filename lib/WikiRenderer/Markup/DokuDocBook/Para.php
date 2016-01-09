<?php

/**
 * dokuwiki syntax to docbook 5.0.
 *
 * @author Laurent Jouanneau
 * @copyright 2008 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer\Markup\DokuDocBook;

/**
 * traite les signes de type paragraphe.
 */
class Para extends \WikiRenderer\Block
{
    public $type = 'para';
    protected $_openTag = '<para>';
    protected $_closeTag = '</para>';

    public function detect($string, $inBlock = false)
    {
        if (trim($string) == '') {
            return false;
        }
        if (preg_match("/^\s+[\*\-\=\|\^>;<=~]/", $string)) {
            return false;
        }
        if (preg_match("/^\s*(\*\*.*)/", $string, $m)) {
            $this->_detectMatch = array($m[1],$m[1]);

            return true;
        }
        if (preg_match("/^\s*([^\*\-\=\|\^>;<=~].*)/", $string, $m)) {
            $this->_detectMatch = array($m[1], $m[1]);

            return true;
        }

        return false;
    }
}
