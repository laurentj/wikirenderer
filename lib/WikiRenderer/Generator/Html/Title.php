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

class Title implements \WikiRenderer\Generator\BlockTitleInterface {

    protected $htmlTagName = 'h';

    protected $lines = array();

    protected $level = 1;

    protected $id = '';

    public function setLevel($level) {
        $this->level = $level;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function addLine(\WikiRenderer\Generator\InlineGeneratorInterface $content) {
        $this->lines[] = $content;
    }

    public function isEmpty() {
        return count($this->lines) == 0;
    }

    public function generate() {
        if ($this->id) {
            $text = '<h'.$this->level.' id="'.htmlspecialchars($this->id).'">';
        }
        else {
            $text = '<h'.$this->level.'>';
        }

        foreach($this->lines as $k=>$generator) {
            if ($k>0) {
                $text .= "\n";
            }
            $text .= $generator->generate();
        }
        $text .= '</h'.$this->level.">";
        return $text;
    }
}