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

namespace WikiRenderer\Generator\Text;

class TableCell implements \WikiRenderer\Generator\BlockTableCellInterface,
                           \WikiRenderer\Generator\InlineGeneratorInterface
{

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
        // FIXME: cells of a same column should have same size
        $text = '';
        foreach($this->content as $generator) {
            if ($generator instanceof \WikiRenderer\Generator\BlockGeneratorInterface) {
                $text .= $generator->generate().' | ';
            }
            else {
                $text .= $generator->generate().' | ';
            }
        }

        return $text;
    }
}
