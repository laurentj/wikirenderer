<?php

/**
 * @author Laurent Jouanneau
 * @copyright 2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */
namespace WikiRenderer\Generator\Html;

use WikiRenderer\Generator\BlockListInterface;

class HtmlList implements BlockListInterface
{
    protected $items = array();

    protected $listType = 0;

    protected $currentIndex = -1;

    protected $id = '';

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setListType($type)
    {
        $this->listType = $type;
    }

    public function createItem()
    {
        ++$this->currentIndex;
    }

    public function isEmpty()
    {
        return count($this->items) == 0;
    }

    public function addContentToItem(\WikiRenderer\Generator\GeneratorInterface $content, $itemIndex = -1)
    {
        if ($itemIndex == -1) {
            $itemIndex = $this->currentIndex;
        }
        if (!isset($this->items[$itemIndex])) {
            $this->items[$itemIndex] = array();
        }
        $this->items[$itemIndex][] = $content;
    }

    public function generate()
    {
        if ($this->listType == $this::ORDERED_LIST) {
            $tag = 'ol';
        } else {
            $tag = 'ul';
        }
        if ($this->id) {
            $text = '<'.$tag.' id="'.htmlspecialchars($this->id).'">';
        } else {
            $text = '<'.$tag.'>';
        }

        foreach ($this->items as $k => $generators) {
            $text .= "\n<li>";
            foreach ($generators as $generator) {
                if ($generator instanceof \WikiRenderer\Generator\BlockGeneratorInterface) {
                    $text .= "\n".$generator->generate()."\n";
                } else {
                    $text .= $generator->generate();
                }
            }
            $text .= '</li>';
        }
        $text .= '</'.$tag.'>';

        return $text;
    }
}
