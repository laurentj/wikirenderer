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
 * traite les signes de type blockquote.
 */
class Blockquote extends \WikiRenderer\Block
{
    public $type = 'blockquote';
    protected $regexp = "/^\s*(\>+)(.*)/";

    public function open()
    {
        $this->_previousTag = $this->_detectMatch[1];
        $this->_firstTagLen = strlen($this->_previousTag);
        $this->_firstLine = true;

        $this->_openTag = str_repeat('<blockquote>', $this->_firstTagLen).'<p>';
    }

    public function close()
    {
        $this->_closeTag = '</p>'.str_repeat('</blockquote>', strlen($this->_previousTag));
        return parent::close();
    }

    public function validateDetectedLine()
    {
        $d = strlen($this->_previousTag) - strlen($this->_detectMatch[1]);
        $str = '';

        if ($d > 0) { // on remonte d'un cran dans la hierarchie...
            $str = '</p>'.str_repeat('</blockquote>', $d).'<p>';
            $this->_previousTag = $this->_detectMatch[1];
        } elseif ($d < 0) { // un niveau de plus
            $this->_previousTag = $this->_detectMatch[1];
            $str = '</p>'.str_repeat('<blockquote>', -$d).'<p>';
        } else {
            if ($this->_firstLine) {
                $this->_firstLine = false;
            }
        }

        $this->text[] = $str.$this->_renderInlineTag($this->_detectMatch[2]);
    }
}
