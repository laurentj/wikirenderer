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

class Html implements \WikiRenderer\Generator\BlockOfRawLinesInterface {
    
    protected $dbTagName = 'div';

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
            $text .= $line;
        }
        $text .= '</'.$this->dbTagName.">";
        return $text;
    }
}
