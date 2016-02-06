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

class Anchor extends AbstractInlineGenerator {

    protected $supportedAttributes = array('anchor');

    public function generate() {
        $text = '';
        foreach($this->content as $content) {
            $text .= $content->generate();
        }
        $anchor = htmlspecialchars($this->attributes['anchor'], ENT_XML1);
        return '<anchor xml:id="'.$anchor.'"/>'.$text;
    }    

}