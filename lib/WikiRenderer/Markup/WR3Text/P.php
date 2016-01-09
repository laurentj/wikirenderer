<?php

/**
 * wikirenderer3 syntax to plain text.
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

namespace WikiRenderer\Markup\WR3Text;

/**
 * ???
 */
class P extends \WikiRenderer\Block
{
    public $type = 'p';

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
