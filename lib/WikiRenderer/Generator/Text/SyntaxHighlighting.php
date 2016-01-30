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

class SyntaxHighlighting implements \WikiRenderer\Generator\BlockSyntaxHighlightingInterface {

    protected $lines = array();

    protected $id = '';

    public function setId($id) {
        $this->id = $id;
    }

    protected $syntax = '';

    protected $filename = '';

    public function addLine($content) {
        $this->lines[] = $content;
    }

    public function setSyntaxType($type) {
        $this->syntax = $type;
    }

    public function getSyntaxType() {
        return $this->syntax;
    }

    public function setFileName($filename) {
        $this->filename = $filename;
    }

    public function getFileName() {
        return $this->filename;
    }

    public function isEmpty() {
        return count($this->lines) == 0;
    }

    public function generate() {
        $text = '';
        if ($this->filename) {
            $text .= $this->indentation.$this->filename.":\n";
        }
        foreach($this->lines as $k=>$line) {
            if ($k>0) {
                $text .= "\n";
            }
            $text .= $this->indentation.'   '.$line;
        }
        return $text;
    }

    public $indentation = '';
}
