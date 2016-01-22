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

namespace WikiRenderer\Generator\Html;

class NoFormat implements \WikiRenderer\Generator\InlineRawWordsInterface {

    protected $content = array();

    public function __construct($words = '') {
        if ($words == '') {
            return;
        }
        $this->content[] = htmlspecialchars($words);
    }

    public function addRawContent($string) {
        $this->content[] = htmlspecialchars($string);
    }

    public function isEmpty() {
        return count($this->content) == 0;
    }

    /**
     * @return string
     */
    public function generate() {
        return "<span>".implode("", $this->content)."</span>";
    }
}
