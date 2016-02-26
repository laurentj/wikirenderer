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

namespace WikiRenderer\Generator\Text;

class Footnotes implements \WikiRenderer\Generator\BlockFootnoteInterface {

    protected $footnotes = array();

    public function __construct($prefixId) {
    }

    public function addFootnote(\WikiRenderer\Generator\InlineFootnotelinkInterface $footnote) {
        $this->footnotes[] = $footnote;
        return count($this->footnotes);
    }

    public function getLinkId($number) {
        return array($number, $number);
    }

    public function setId($id) {
    }

    public function isEmpty() {
        return count($this->footnotes) == 0;
    }

    public function generate() {
        $text = "\n\n";
        foreach($this->footnotes as $k=>$generator) {
            $number = $k + 1;
            $text .= "[$number] ".$generator->generateFootnote()."\n";
        }
        return $text;
    }
}
