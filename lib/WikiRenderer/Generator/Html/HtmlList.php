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

    protected $startIndex = 1;

    public function __construct(\WikiRenderer\Generator\Config $config) {
    }

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
        $attr = '';
        if ($this->listType == $this::ORDERED_LIST) {
            $tag = 'ol';
            if ($this->startIndex != 1) {
                $attr = ' start="'.$this->startIndex.'"';
            }
        } else {
            $tag = 'ul';
        }
        if ($this->id) {
            $text = '<'.$tag.$attr.' id="'.htmlspecialchars($this->id).'">';
        } else {
            $text = '<'.$tag.$attr.'>';
        }

        foreach ($this->items as $k => $generators) {
            $text .= "\n<li>";
            $previousWasText = false;
            foreach ($generators as $j => $generator) {
                if ($generator instanceof \WikiRenderer\Generator\BlockGeneratorInterface &&
                    !($generator instanceof \WikiRenderer\Generator\SingleLineBlock)) {
                    if ($previousWasText || $j == 0) {
                        $text .= "\n";
                    }
                    $text .= $generator->generate()."\n";
                    $previousWasText = false;
                } else {
                    $words = $generator->generate();
                    if ($words) {
                        $text .= $words;
                        $previousWasText = true;
                    }
                }
            }
            $text .= '</li>';
        }
        $text .= "\n".'</'.$tag.'>';

        return $text;
    }

    public function setStartIndex($number) {
        $this->startIndex = $number;
    }
}
