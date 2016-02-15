<?php

/**
 * @author Laurent Jouanneau
 * @copyright 2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */
namespace WikiRenderer\Generator\Text;

use WikiRenderer\Generator\BlockListInterface;

class ItemList implements BlockListInterface
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
        $text = '';
        foreach ($this->items as $k => $generators) {
            if ($k > 0) {
                $text .= "\n";
            }
            $text .= $this->indentation;

            if ($this->listType == $this::ORDERED_LIST) {
                $text .= ($k + 1).'. ';
            } else {
                $text .= '- ';
            }

            foreach ($generators as $j => $generator) {
                if ($generator instanceof \WikiRenderer\Generator\BlockGeneratorInterface) {
                    $generator->indentation = $this->indentation.'   ';
                    $text .= "\n".$generator->generate();
                } else {
                    if ($j > 0) {
                        $text .= "\n".$this->indentation.'  ';
                    }
                    $text .= $generator->generate();
                }
            }
        }

        return $text;
    }

    public $indentation = '';
}
