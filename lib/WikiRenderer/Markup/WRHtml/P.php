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
class P extends \WikiRenderer\Block
{
    public $type = 'p';
    protected $_openTag = '<p>';
    protected $_closeTag = '</p>';

    public function detect($string, $inBlock = false)
    {
        //echo "~~~~~para\n";
        if ($string == '') {
            return false;
        }

        if (preg_match('/^={4,} *$/', $string)) {
            return false;
        }
        $c = $string[0];

        if (strpos("*#-!| \t>;", $c) === false) {
            //echo "   found\n";
            $this->_detectMatch = array($string, $string);

            return true;
        } else {
            return false;
        }
    }
}
