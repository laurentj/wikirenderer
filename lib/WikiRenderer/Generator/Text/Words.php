<?php

/**
 * Configuration for an HTML generator
 *
 * @author Laurent Jouanneau
 *
 * @copyright 2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer\Generator\Text;

class Words implements \WikiRenderer\Generator\InlineWordsInterface {

    protected $content = '';

    public function __construct($words = '') {
        $this->content = $words;
    }
    
    public function addRawContent($string) {
        $this->content .= $string;
    }

    public function addGeneratedContent($string) {
        $this->content .= $string;
    }

    /**
     * @return string
     */
    public function generate() {
        return $this->content;
    }
}
