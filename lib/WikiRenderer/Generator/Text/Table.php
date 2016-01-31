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
use \WikiRenderer\Generator\BlockTableInterface;

class Table implements BlockTableInterface {

    /**
     * @var BlockTableCellInterface[][]
     */
    protected $rows = array();

    protected $currentRowIndex = -1;

    protected $id = '';

    public function setId($id) {
        $this->id = $id;
    }

    public function createRow() {
        $this->currentRowIndex ++;
        $this->rows[$this->currentRowIndex] = array();
    }

    public function addCell(\WikiRenderer\Generator\BlockTableCellInterface $content) {
        if ($content->getRowSpan() == -1) {
            $colIdx = count($this->rows[$this->currentRowIndex]);

            for ($i = $this->currentRowIndex-1; $i>=0; --$i) {
                if (!isset($this->rows[$i][$colIdx])) {
                    break;
                }
                if (($r = $this->rows[$i][$colIdx]->getRowSpan()) > 0) {
                    $this->rows[$i][$colIdx]->setRowSpan($r+1);
                    break;
                }
            }
        }
        $this->rows[$this->currentRowIndex][] = $content;
    }

    public function isEmpty() {
        return count($this->rows) == 0;
    }

    public function generate() {
        $text = '';

        foreach($this->rows as $k=>$row) {
            if ($k > 0) {
                $text .= "\n";
            }
            $text .= $this->indentation."|";
            foreach($row as $cell) {
                if ($cell->getRowSpan() < 1) {
                    $text.= '  | ';
                    continue;
                }
                $text .= $cell->generate().' | ';
            }
        }
        return $text;
    }

    public $indentation = '';
}