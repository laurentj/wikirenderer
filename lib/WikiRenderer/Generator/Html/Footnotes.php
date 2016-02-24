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

class Footnotes implements \WikiRenderer\Generator\BlockFootnoteInterface {

    protected $footnotes = array();

    protected $prefixId;

    public function __construct($prefixId) {
        $this->prefixId = $prefixId;
    }

    public function addFootnote(\WikiRenderer\Generator\InlineFootnotelinkInterface $footnote) {
        $this->footnotes[] = $footnote;
        return count($this->footnotes);
    }

    public function getLinkId($number) {
        $id = $this->prefixId.'-'.$number;
        $revid = 'rev-'.$id;
        return array($id, $revid);
    }

    public function setId($id) {
        
    }

    public function isEmpty() {
        return count($this->footnotes) == 0;
    }

    public function generate() {
        $text = '<div class="footnotes"><h4>Notes</h4>'."\n<ul>\n";
        foreach($this->footnotes as $k=>$generator) {
            $number = $k + 1;
            list($id, $revid) = $this->getLinkId($number);
            $text .= "<li><span>[<a href=\"#$revid\" name=\"$id\" id=\"$id\">$number</a>]</span> ";
            $text .= $generator->generateFootnote();
            $text .= "</li>\n";
        }
        $text .= "</ul>\n</div>\n";
        return $text;
    }
}