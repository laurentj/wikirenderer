<?php

/**
 * wikirenderer3 (wr3) syntax.
 *
 * @author Laurent Jouanneau
 * @copyright 2003-2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */
namespace WikiRenderer\Markup\WR3;

/**
 * Parser for a paragraph block.
 */
class P extends \WikiRenderer\Block
{
    public $type = 'para';

    public function isStarting($line)
    {
        return $this->isAccepting($line);
    }

    public function isAccepting($string)
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

    public function validateLine()
    {
        $this->generator->addLine($this->parseInlineContent($this->_detectMatch[1]));
    }
}
