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

class Audio extends AbstractInlineGenerator {

    protected $supportedAttributes = array('id', 'src', 'align', 'title', 'class');

    public function generate() {
        $text = parent::generate();
        $text .=' (';
        if (isset($this->attributes['title'])) {
            $text .= $this->attributes['title'].': ';
        }
        $text .= $this->getAttribute('src');
        $text .=')';
        return $text;
    }
}