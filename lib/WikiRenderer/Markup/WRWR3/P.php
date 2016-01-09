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

class P extends \WikiRenderer\Block
{
    public $type = 'p';

    public function detect($string, $inBlock = false)
    {
        if ($string == '') {
            return false;
        }
        if (preg_match('/^={4,} *$/', $string)) {
            return false;
        }
        $c = $string[0];

        if (strpos("*#-!| \t>;", $c) === false) {
            $this->_detectMatch = array($string,$string);

            return true;
        } else {
            return false;
        }
    }

    public function validateDetectedLine()
    {
        $this->text[] = $this->_renderInlineTag($this->_detectMatch[1]);
    }
}
