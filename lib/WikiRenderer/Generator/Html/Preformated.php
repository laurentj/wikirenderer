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

class Preformated implements \WikiRenderer\Generator\BlockPreformatedInterface {
    
    protected $htmlTagName = 'pre';

    protected $lines = array();

    public function addLine($content) {
        $this->lines[] = $content;
    }

    public function generate() {
        $text = '<'.$this->htmlTagName.'>';
        foreach($this->lines as $k=>$line) {
            if ($k>0) {
                $text .= "\n";
            }
            $text .= htmlspecialchars($line);
        }
        $text .= '</'.$this->htmlTagName.">";
        return $text;
    }
}