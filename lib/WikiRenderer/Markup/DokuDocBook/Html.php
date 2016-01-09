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
 * parse html blocks, but do not generate content for docbook
 */
class Html extends \WikiRenderer\Block
{
    public $type = 'html';
    protected $isOpen = false;
    protected $dktag = 'html';
    protected $closeTagDetected = false;

    public function open()
    {
        $this->isOpen = true;
        $this->closeTagDetected = false;
        $this->text = array();
    }

    public function close()
    {
        $this->isOpen = false;
        return '';
    }

    public function validateDetectedLine()
    {
    }

    public function detect($string, $inBlock = false)
    {
        if ($this->closeTagDetected) {
            return false;
        }
        if ($this->isOpen) {
            if (preg_match('/(.*)<\/'.$this->dktag.'>\s*$/', $string, $m)) {
                $this->isOpen = false;
                $this->closeTagDetected = true;
            }

            return true;
        } else {
            if (preg_match('/^\s*<'.$this->dktag.'>(.*)/', $string, $m)) {
                if (preg_match('/(.*)<\/'.$this->dktag.'>\s*$/', $string, $m)) {
                    $this->closeTagDetected = true;
                    $this->_closeNow = true;
                } else {
                    $this->_closeNow = false;
                }

                return true;
            } else {
                return false;
            }
        }
    }
}
