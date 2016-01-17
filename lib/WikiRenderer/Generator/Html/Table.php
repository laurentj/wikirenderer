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

namespace WikiRenderer\Generator\Html;
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
        $this->rows[$this->currentRowIndex][] = $content;
    }

    public function isEmpty() {
        return count($this->rows) == 0;
    }

    public function generate() {
        if ($this->id) {
            $text = '<table border="1" id="'.htmlspecialchars($this->id).'">'."\n";
        }
        else {
            $text = '<table border="1">'."\n";
        }

        foreach($this->rows as $k=>$row) {
            $text .= "<tr>\n";
            foreach($row as $cell) {
                $text .= $cell->generate()."\n";
            }
            $text .= "</tr>\n";
        }
        $text .= '</table>';
        return $text;
    }
}