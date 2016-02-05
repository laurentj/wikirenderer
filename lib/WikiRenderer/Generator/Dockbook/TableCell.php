<?php

/**
 * @author Laurent Jouanneau
 *
 * @copyright 2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer\Generator\Dockbook;

class TableCell implements \WikiRenderer\Generator\BlockTableCellInterface,
                           \WikiRenderer\Generator\InlineGeneratorInterface
{

    protected $dbTagName = 'td';

    protected $id = '';

    protected $_colspan = 1;

    protected $_rowspan = 1;

    protected $_isHeader = false;

    protected $content = array();

    protected $align = '';

    public function setId($id) {
        $this->id = $id;
    }

    public function setIsHeader($isHeader) {
        $this->_isHeader = !! $isHeader;
    }

    public function setColSpan($colspan) {
        $this->_colspan = intval($colspan);
    }

    public function getColSpan() {
        return $this->_colspan;
    }

    public function setRowSpan($rowspan) {
        $this->_rowspan = intval($rowspan);
    }

    public function getRowSpan() {
        return $this->_rowspan;
    }

    public function setAlign($align) {
        if (!in_array($align, array('left','center','right'))) {
            return;
        }
        $this->align = $align;
    }

    public function getAlign() {
        return $this->align;
    }

    public function addContent(\WikiRenderer\Generator\GeneratorInterface $content) {
        $this->content[] = $content;
    }

    public function isEmpty() {
        return count($this->content) == 0;
    }

    /**
     * @return string
     */
    public function generate() {
        $tag = $this->dbTagName;
        if ($this->_isHeader) {
            $tag = 'th';
        }

        $attr = '';
        if ($this->id) {
            $attr .= ' xml:id="'.htmlspecialchars($this->id, ENT_XML1).'"';
        }

        if ($this->_colspan > 1) {
            $attr .= ' colspan="'.$this->_colspan.'"';
        }

        if ($this->_rowspan > 1) {
            $attr .= ' rowspan="'.$this->_rowspan.'"';
        }

        if ($this->align) {
            $attr .= ' align="'.$this->align.'"';
        }

        $html = '';
        foreach($this->content as $generator) {
            if ($generator instanceof \WikiRenderer\Generator\BlockGeneratorInterface) {
                $html .= "\n".$generator->generate()."\n";
            }
            else {
                $html .= $generator->generate();
            }
        }

        return '<'.$tag.$attr.'>'.$html.'</'.$tag.'>';
    }
}
