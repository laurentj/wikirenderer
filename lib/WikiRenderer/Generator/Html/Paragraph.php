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

class Paragraph implements \WikiRenderer\Generator\BlockParagraphInterface {
    
    protected $htmlTagName = 'p';

    protected $lines = array();

    public function addLine(\WikiRenderer\Generator\InlineGeneratorInterface $content) {
        $this->lines[] = $content;
    }

    public function generate() {
        $text = '<'.$this->htmlTagName.'>';
        foreach($this->lines as $k=>$generator) {
            if ($k>0) {
                $text .= "\n";
            }
            $text .= $generator->generate();
        }
        $text .= '</'.$this->htmlTagName.">";
        return $text;
    }
}