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
 * Parser for preformated content.
 */
class Pre extends \WikiRenderer\Block
{
    public $type = 'pre';
    protected $closeTagDetected = false;

    public function isStarting($string)
    {
        if (preg_match('/^\s*<code>(.*)/', $string, $m)) {
            if (preg_match('/(.*)<\/code>\s*$/', $m[1], $m2)) {
                $this->_closeNow = true;
                $this->_detectMatch = $m2[1];
                $this->closeTagDetected = true;
            } else {
                $this->_closeNow = false;
                $this->_detectMatch = $m[1];
                $this->closeTagDetected = false;
            }
            return true;
        } else {
            return false;
        }
    }

    public function isAccepting($string)
    {
        if ($this->closeTagDetected) {
            return false;
        }
        if (preg_match('/(.*)<\/code>\s*$/', $string, $m)) {
            $this->_detectMatch = $m[1];
            $this->closeTagDetected = true;
        } else {
            $this->_detectMatch = $string;
        }

        return true;
    }

    public function validateLine()
    {
        if (!$this->closeTagDetected || $this->_detectMatch != '') {
            $this->generator->addLine($this->_detectMatch);
        }
    }
}
