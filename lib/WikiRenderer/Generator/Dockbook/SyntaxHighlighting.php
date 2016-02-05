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

namespace WikiRenderer\Generator\Dockbook;

class SyntaxHighlighting implements \WikiRenderer\Generator\BlockSyntaxHighlightingInterface {
    
    protected $dbTagName = 'pre';

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
        if ($this->id) {
            $text = '<pre xml:id="'.htmlspecialchars($this->id, ENT_XML1).'">';
        }
        else {
            $text = '<'.$this->dbTagName.'>';
        }
        if ($this->filename) {
            $text .= '<span class="code-filename">'.htmlspecialchars($this->filename, ENT_XML1)."</span><br/>\n";
        }
        $text .= '<code';
        if ($this->syntax) {
            $text .= ' class="syntax-'.$this->syntax.'"';
        }
        $text .='>';
        foreach($this->lines as $k=>$line) {
            if ($k>0) {
                $text .= "\n";
            }
            $text .= htmlspecialchars($line, ENT_XML1);
        }
        $text .= '</code></pre>';
        return $text;
    }
}
