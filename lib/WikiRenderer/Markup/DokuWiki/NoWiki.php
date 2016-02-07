<?php

/**
 * DokuWiki syntax
 *
 * @author Laurent Jouanneau
 * @copyright 2008-2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer\Markup\DokuWiki;

/**
 * Parser for nowiki content
 */
class NoWiki extends \WikiRenderer\Block
{
    public $type = 'noformat';
    protected $tagName = 'nowiki';

    protected $closeTagDetected = false;

    protected $_args = null;

    public function open()
    {
        $this->closeTagDetected = false;
        parent::open();
    }

    public function validateDetectedLine()
    {
        $this->generator->addLine($this->_detectMatch);
    }

    public function detect($string, $inBlock = false)
    {
        if ($this->closeTagDetected) {
            return false;
        }
        if ($inBlock) {
            $this->_args = null;
            if (preg_match('/(.*)<\/'.$this->tagName.'>\s*$/i', $string, $m)) {
                $this->_detectMatch = $m[1];
                $this->closeTagDetected = true;
            } else {
                $this->_detectMatch = $string;
            }

            return true;
        } else {
            if (preg_match('/^\s*<'.$this->tagName.'(?:\s([^>]+))?>(.*)/i', $string, $m)) {
                $this->_args = $m;
                if (preg_match('/(.*)<\/'.$this->tagName.'>\s*$/i', $m[2], $m2)) {
                    $this->_closeNow = true;
                    $this->_detectMatch = $m2[1];
                    $this->closeTagDetected = true;
                } else {
                    $this->_closeNow = false;
                    $this->_detectMatch = $m[2];
                }
                return true;
            } else {
                return false;
            }
        }
    }
}
