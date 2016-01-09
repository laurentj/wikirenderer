<?php

/**
 * wikirenderer3 (wr3) syntax to xhtml.
 *
 * @author Laurent Jouanneau
 * @copyright 2003-2006 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer\Markup\WR3Html;

/**
 * ???
 */
class Table extends \WikiRenderer\Block
{
    public $type = 'table';
    protected $regexp = "/^\s*\| ?(.*)/";
    protected $_openTag = '<table border="1">';
    protected $_closeTag = '</table>';
    protected $_colcount = 0;

    public function open()
    {
        $this->_colcount = 0;

        parent::open();
    }

    public function validateDetectedLine()
    {
        $result = explode(' | ', trim($this->_detectMatch[1]));
        $str = '';
        $t = '';

        if ((count($result) != $this->_colcount) && ($this->_colcount != 0)) {
            $t = '</table><table border="1">';
        }
        $this->_colcount = count($result);

        for ($i = 0; $i < $this->_colcount; ++$i) {
            $str .= '<td>'.$this->_renderInlineTag($result[$i]).'</td>';
        }
        $str = $t.'<tr>'.$str.'</tr>';

        $this->text[] = $str;
    }
}
