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

class SyntaxHighlight extends \WikiRenderer\Block
{
    public $type = 'syntaxhighlight';
    protected $_openTag = '<pre><code>';
    protected $_closeTag = '</code></pre>';
    protected $isOpen = false;
    protected $closeTagDetected = false;
    protected $dktag = 'code';

    public function open()
    {
        $this->isOpen = true;
        $this->closeTagDetected = false;

        parent::open();
    }

    public function close()
    {
        $this->isOpen = false;

        return parent::close();
    }

    public function validateDetectedLine()
    {
        $this->text[] = htmlspecialchars($this->_detectMatch);
    }

    public function detect($string, $inBlock = false)
    {
        if ($this->closeTagDetected) {
            return false;
        }
        if ($this->isOpen) {
            if (preg_match('/(.*)<\/'.$this->dktag.'>\s*$/', $string, $m)) {
                $this->_detectMatch = $m[1];
                $this->isOpen = false;
                $this->closeTagDetected = true;
            } else {
                $this->_detectMatch = $string;
            }

            return true;
        } else {
            if (preg_match('/^\s*<'.$this->dktag.'( \w+)?>(.*)/', $string, $m)) {
                if (preg_match('/(.*)<\/'.$this->dktag.'>\s*$/', $m[2], $m2)) {
                    $this->_closeNow = true;
                    $this->_detectMatch = $m2[1];
                    $this->closeTagDetected = true;
                } else {
                    $this->_closeNow = false;
                    $this->_detectMatch = $m[2];
                }
                if (isset($m[1]) && $m[1] != '') {
                    $this->_openTag = '<pre><code class="language-'.trim($m[1]).'">';
                } else {
                    $this->_openTag = '<pre><code>';
                }

                return true;
            }

            return false;
        }
    }
}
