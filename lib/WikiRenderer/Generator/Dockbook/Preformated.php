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

class Preformated implements \WikiRenderer\Generator\BlockOfRawLinesInterface {
    
    protected $dbTagName = 'pre';

    protected $lines = array();

    protected $id = '';

    public function setId($id) {
        $this->id = $id;
    }

    /**
     * @param string $content
     */
    public function addLine($content) {
        $this->lines[] = $content;
    }

    public function isEmpty() {
        return count($this->lines) == 0;
    }

    public function generate() {
        if ($this->id) {
            $text = '<'.$this->dbTagName.' xml:id="'.htmlspecialchars($this->id, ENT_XML1).'">';
        }
        else {
            $text = '<'.$this->dbTagName.'>';
        }

        foreach($this->lines as $k=>$line) {
            if ($k>0) {
                $text .= "\n";
            }
            $text .= htmlspecialchars($line, ENT_XML1);
        }
        $text .= '</'.$this->dbTagName.">";
        return $text;
    }
}