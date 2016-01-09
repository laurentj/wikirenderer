<?php

/**
 * wikirenderer3 syntax to plain text.
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

namespace WikiRenderer\Markup\WR3Text;

/**
 * ???
 */
class Table extends \WikiRenderer\Block
{
    public $type = 'table';
    protected $regexp = "/^\s*\| ?(.*)/";
    protected $_openTag = '--------------------------------------------';
    protected $_closeTag = "--------------------------------------------\n";
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
            $t = "--------------------------------------------\n";
        }
        $this->_colcount = count($result);

        for ($i = 0; $i < $this->_colcount; ++$i) {
            $str .= $this->_renderInlineTag($result[$i])."\t| ";
        }
        $this->text[] = $t.'| '.$str;
    }
}
