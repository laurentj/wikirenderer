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

use WikiRenderer\Generator\BlockListInterface;

class DocbookList implements BlockListInterface
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
            $tag = 'orderedlist';
            if ($this->startIndex != 1) {
                $attr = ' startingnumber="'.$this->startIndex.'"';
            }
        } else {
            $tag = 'itemizedlist';
        }
        if ($this->id) {
            $text = '<'.$tag.$attr.' xml:id="'.htmlspecialchars($this->id, ENT_XML1).'">';
        } else {
            $text = '<'.$tag.$attr.'>';
        }

        foreach ($this->items as $k => $generators) {
            $text .= "\n<listitem>";
            $para = false;
            foreach ($generators as $generator) {
                if ($generator instanceof \WikiRenderer\Generator\BlockGeneratorInterface) {
                    if ($para) {
                        $text .= '</para>';
                        $para = false;
                    }
                    $text .= "\n".$generator->generate()."\n";
                } else {
                    if (!$para) {
                        $text .= '<para>';
                        $para = true;
                    }
                    $text .= $generator->generate();
                }
            }
            if ($para) {
                $text .= '</para>';
            }
            $text .= '</listitem>';
        }
        $text .= '</'.$tag.'>';

        return $text;
    }

    public function setStartIndex($number) {
        $this->startIndex = $number;
    }
}
