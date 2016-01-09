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
class WikiList extends \WikiRenderer\Block
{
    public $type = 'list';
    protected $_previousTag;
    protected $_firstItem;
    protected $_firstTagLen;
    protected $regexp = "/^\s*([\*#-]+)(.*)/";

    public function open()
    {
        $this->_previousTag = $this->_detectMatch[1];
        $this->_firstTagLen = strlen($this->_previousTag);
        $this->_firstItem = true;

        if (substr($this->_previousTag, -1, 1) == '#') {
            $this->_openTag = "<orderedlist>\n";
        } else {
            $this->_openTag = "<itemizedlist>\n";
        }
    }

    public function close()
    {
        $t = $this->_previousTag;
        $this->_closeTag = '';
        for ($i = strlen($t); $i >= $this->_firstTagLen; --$i) {
            $this->_closeTag .=($t[$i - 1] == '#') ? "</listitem></orderedlist>\n" : "</listitem></itemizedlist>\n";
        }

        return parent::close();
    }

    public function validateDetectedLine()
    {
        $t = $this->_previousTag;
        $d = strlen($t) - strlen($this->_detectMatch[1]);
        $str = '';

        if ($d > 0) { // on remonte d'un ou plusieurs cran dans la hierarchie...
            $l = strlen($this->_detectMatch[1]);
            for ($i = strlen($t); $i > $l; --$i) {
                $str .= ($t[$i - 1] == '#') ? "</listitem></orderedlist>\n" : "</listitem></itemizedlist>\n";
            }
            $str .= "</listitem>\n<listitem>";
            $this->_previousTag = substr($this->_previousTag, 0, -$d); // pour etre sur...
        } elseif ($d < 0) { // un niveau de plus
            $c = substr($this->_detectMatch[1], -1, 1);
            $this->_previousTag .= $c;
            $str = ($c == '#') ? '<orderedlist><listitem>' : '<itemizedlist><listitem>';
        } else {
            $str = ($this->_firstItem ? '<listitem>' : "</listitem>\n<listitem>");
        }
        $this->_firstItem = false;

        $this->text[] = $str.'<para>'.$this->_renderInlineTag($this->_detectMatch[2]).'</para>';
    }
}
