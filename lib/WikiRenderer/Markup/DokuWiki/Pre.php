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
 * Parser for preformated content
 */
class Pre extends \WikiRenderer\BlockNG
{
    public $type = 'pre';
    protected $tagName = 'code';
    protected $closeTagDetected = false;

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
            if (preg_match('/(.*)<\/'.$this->tagName.'>\s*$/', $string, $m)) {
                $this->_detectMatch = $m[1];
                $this->closeTagDetected = true;
            } else {
                $this->_detectMatch = $string;
            }

            return true;
        } else {
            if (preg_match('/^\s*<'.$this->tagName.'>(.*)/', $string, $m)) {
                if (preg_match('/(.*)<\/'.$this->tagName.'>\s*$/', $m[1], $m2)) {
                    $this->_closeNow = true;
                    $this->_detectMatch = $m2[1];
                    $this->closeTagDetected = true;
                } else {
                    $this->_closeNow = false;
                    $this->_detectMatch = $m[1];
                }

                return true;
            } else {
                return false;
            }
        }
    }
}
