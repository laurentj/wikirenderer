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

namespace WikiRenderer\Generator\Docbook;

class Footnotes implements \WikiRenderer\Generator\BlockFootnoteInterface {

    protected $footnotes = array();

    protected $prefixId;

    public function __construct(\WikiRenderer\Generator\Config $config) {
        $prefixId = $config->footnotesIdPrefix;
        $this->prefixId = $prefixId.rand(100, 999);
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
        return '';
    }
}