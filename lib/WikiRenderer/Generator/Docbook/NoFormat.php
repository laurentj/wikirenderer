<?php

/**
 *
 * @author Laurent Jouanneau
 *
 * @copyright 2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer\Generator\Docbook;

class NoFormat implements \WikiRenderer\Generator\InlineRawWordsInterface {

    protected $content = array();

    public function __construct($words = '') {
        if ($words == '') {
            return;
        }
        $this->content[] = htmlspecialchars($words, ENT_XML1);
    }

    public function addRawContent($string) {
        $this->content[] = htmlspecialchars($string, ENT_XML1);
    }

    function addContent(\WikiRenderer\Generator\InlineWordsInterface $words) {
        $this->content[] = $words->generate();
    }

    public function isEmpty() {
        return count($this->content) == 0;
    }

    /**
     * @return string
     */
    public function generate() {
        return "<phrase>".implode("", $this->content)."</phrase>";
    }
}
