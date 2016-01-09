<?php

/**
 * dokuwiki syntax to xhtml.
 *
 * @author Laurent Jouanneau
 * @copyright 2008-2012 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer\Markup\DokuHtml;

/**
 * parse html but it does not output it
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
                $this->closeTagDetected = true;
                $this->isOpen = false;
            }

            return true;
        }
        if (preg_match('/^\s*<'.$this->dktag.'>(.*)/', $string, $m)) {
            return true;
        }

        return false;
    }
}
