<?php

/**
 * @author Laurent Jouanneau
 *
 * @copyright 2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public 2.1
 * License as published by the Free Software Foundation.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */

namespace WikiRenderer\Generator\Html;
use \WikiRenderer\Generator\BlockTableInterface;

class Table implements BlockTableInterface {

    protected $rows = array();

    protected $currentRowIndex = -1;

    public function createRow() {
        $this->currentRowIndex ++;
        $this->rows[$this->currentRowIndex] = array();
    }

    public function addCell(\WikiRenderer\Generator\GeneratorInterface $content) {
        $this->rows[$this->currentRowIndex][] = $content;
    }

    public function generate() {
        $text = '<table border="1">'."\n";
        foreach($this->rows as $k=>$row) {
            $text .= "<tr>\n";
            foreach($row as $generator) {
                $text .= "<td>";
                if ($generator instanceof \WikiRenderer\Generator\BlockGeneratorInterface) {
                    $text .= "\n".$generator->generate()."\n";
                }
                else {
                    $text .= $generator->generate();
                }
                $text .= "</td>\n";
            }
            $text .= "</tr>\n";
        }
        $text .= '</table>';
        return $text;
    }
}