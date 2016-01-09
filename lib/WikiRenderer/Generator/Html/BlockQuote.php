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

class BlockQuote implements \WikiRenderer\Generator\BlockBlockQuoteInterface {

    protected $lines = array();

    public function addContent(\WikiRenderer\Generator\GeneratorInterface $content) {
        $this->lines[] = $content;
    }

    public function generate() {

        $text = '<blockquote>';
        $currentPara = null;
        foreach($this->lines as $generator) {
            if ($generator instanceof \WikiRenderer\Generator\BlockGeneratorInterface) {
                if ($currentPara) {
                    $text .= $currentPara->generate()."\n";
                    $currentPara = null;
                }
                $text .= $generator->generate()."\n";
            }
            else if ($currentPara) {
                $currentPara->addLine($generator);
            }
            else {
                $currentPara = new Paragraph();
                $currentPara->addLine($generator);
            }
        }
        if ($currentPara) {
            $text .= $currentPara->generate();
        }
        $text .= '</blockquote>';
        return $text;
    }
}