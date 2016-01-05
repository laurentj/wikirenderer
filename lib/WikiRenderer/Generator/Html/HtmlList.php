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
use \WikiRenderer\Generator\BlockListInterface;

class HtmlList implements BlockListInterface {

    protected $items = array();

    protected $listType = 0;

    protected $currentIndex = -1;
    
    public function setListType($type) {
        $this->listType = $type;
    }

    public function createItem() {
        $this->currentIndex ++;
    }

    public function addContentToItem(\WikiRenderer\Generator\GeneratorInterface $content, $itemIndex = -1) {
        if ($itemIndex == -1) {
            $itemIndex = $this->currentIndex;
        }
        if (!isset($this->items[$itemIndex])) {
            $this->items[$itemIndex] = array();
        }
        $this->items[$itemIndex][] = $content;
    }

    public function generate() {
        if ($this->listType == $this::ORDERED_LIST) {
            $tag = 'ol';
        }
        else {
            $tag = 'ul';
        }

        $text = '<'.$tag.'>';
        foreach($this->items as $k=>$generators) {
            if ($k>0) {
                $text .= "\n";
            }
            $text .= "<li>";
            foreach($generators as $generator) {
                if ($generator instanceof \WikiRenderer\Generator\BlockGeneratorInterface) {
                    $text .= "\n".$generator->generate()."\n";
                }
                else {
                    $text .= $generator->generate();
                }
            }
            $text .= "</li>";
        }
        $text .= '</'.$tag.">";
        return $text;
    }
}