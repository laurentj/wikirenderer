<?php

/**
 * wikirenderer3 (wr3) syntax to docbook 5.0.
 *
 * @author Laurent Jouanneau
 * @contributor  Amaury Bouchard
 *
 * @copyright 2003-2013 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer\Markup\WR3DocBook;

/**
 * ???
 */
class Blockquote extends \WikiRenderer\Block
{
    public $type = 'bq';
    protected $regexp = "/^\s*(\>+)(.*)/";

    public function open()
    {
        $this->_previousTag = $this->_detectMatch[1];
        $this->_firstTagLen = strlen($this->_previousTag);
        $this->_firstLine = true;

        $this->_openTag = str_repeat('<blockquote>', $this->_firstTagLen).'<para>';
    }

    public function close()
    {
        $this->_closeTag = '</para>'.str_repeat('</blockquote>', strlen($this->_previousTag));
        return parent::close();
    }

    public function validateDetectedLine()
    {
        $d = strlen($this->_previousTag) - strlen($this->_detectMatch[1]);
        $str = '';

        if ($d > 0) { // on remonte d'un cran dans la hierarchie...
            $str = '</para>'.str_repeat('</blockquote>', $d).'<para>';
            $this->_previousTag = $this->_detectMatch[1];
        } elseif ($d < 0) { // un niveau de plus
            $this->_previousTag = $this->_detectMatch[1];
            $str = '</para>'.str_repeat('<blockquote>', -$d).'<para>';
        } else {
            if ($this->_firstLine) {
                $this->_firstLine = false;
            }
        }

        $this->text[] = $str.$this->_renderInlineTag($this->_detectMatch[2]);
    }
}
