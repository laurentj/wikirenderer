<?php

/**
 * @author Laurent Jouanneau
 * @copyright 2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */
namespace WikiRenderer\Generator\Docbook;

use WikiRenderer\Generator\BlockTableInterface;
use WikiRenderer\Generator\BlockTableCellInterface;

class Table implements BlockTableInterface
{
    /**
     * @var BlockTableCellInterface[][]
     */
    protected $rows = array();

    protected $currentRowIndex = -1;

    protected $id = '';

    public function __construct(\WikiRenderer\Generator\Config $config) {

    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function createRow()
    {
        ++$this->currentRowIndex;
        $this->rows[$this->currentRowIndex] = array();
    }

    public function addCell(\WikiRenderer\Generator\BlockTableCellInterface $content)
    {
        if ($content->getRowSpan() == -1) {
            $colIdx = count($this->rows[$this->currentRowIndex]);

            for ($i = $this->currentRowIndex - 1; $i >= 0; --$i) {
                if (!isset($this->rows[$i][$colIdx])) {
                    break;
                }
                if (($r = $this->rows[$i][$colIdx]->getRowSpan()) > 0) {
                    $this->rows[$i][$colIdx]->setRowSpan($r + 1);
                    break;
                }
            }
        }
        $this->rows[$this->currentRowIndex][] = $content;
    }

    public function isEmpty()
    {
        return count($this->rows) == 0;
    }

    public function generate()
    {
        if ($this->id) {
            $text = '<table xml:id="'.htmlspecialchars($this->id, ENT_XML1).'"><caption></caption>'."\n";
        } else {
            $text = '<table><caption></caption>'."\n";
        }

        foreach ($this->rows as $k => $row) {
            $text .= "<tr>\n";
            foreach ($row as $cell) {
                if ($cell->getRowSpan() < 1) {
                    continue;
                }
                $text .= $cell->generate()."\n";
            }
            $text .= "</tr>\n";
        }
        $text .= '</table>';

        return $text;
    }
}
