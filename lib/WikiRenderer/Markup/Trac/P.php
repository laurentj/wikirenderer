<?php

/**
 * Trac syntax.
 *
 * @author Laurent Jouanneau
 * @copyright 2006-2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */
namespace WikiRenderer\Markup\Trac;

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
        if (preg_match("/^([^\s\*\1\=\-\|\^\{\>].*)/", $string, $m)) {
            $this->_detectMatch = array($m[1],$m[1]);

            return true;
        }

        return false;
    }

    public function validateLine()
    {
        $this->generator->addLine($this->parseInlineContent($this->_detectMatch[1]));
    }
}
