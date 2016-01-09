<?php

/**
 * Original wikirenderer (wr) syntax
 *
 * @author Laurent Jouanneau
 * @copyright 2003-2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer\Markup\ClassicWR;

/**
 * Parser for a paragraph block
 */
class P extends \WikiRenderer\BlockNG
{
    public $type = 'para';

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
            $this->_detectMatch = array($string, $string);
            return true;
        }

        return false;
    }

    public function validateDetectedLine()
    {
        $this->generator->addLine($this->_renderInlineTag($this->_detectMatch[1]));
    }
}
