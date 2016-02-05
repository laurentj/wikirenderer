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

class Paragraph implements \WikiRenderer\Generator\BlockParagraphInterface {
    
    protected $dbTagName = 'para';

    protected $lines = array();

    protected $id = '';

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
            $text = '<'.$this->dbTagName.' xml:id="'.htmlspecialchars($this->id, ENT_XML1).'">';
        }
        else {
            $text = '<'.$this->dbTagName.'>';
        }

        foreach($this->lines as $k=>$generator) {
            if ($k>0) {
                $text .= "\n";
            }
            $text .= $generator->generate();
        }
        $text .= '</'.$this->dbTagName.">";
        return $text;
    }
}