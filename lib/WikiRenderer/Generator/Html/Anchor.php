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

class Anchor extends AbstractInlineGenerator {

    protected $supportedAttributes = array('anchor');

    public function generate() {
        $html = '';
        foreach($this->content as $content) {
            $html .= $content->generate();
        }
        $anchor = htmlspecialchars($this->attributes['anchor']);
        return '<span id="'.$anchor.'" class="wikianchor">'.$html.'<a href="#'.$anchor.'" class="anchor">¶</a></span>';
    }    

}