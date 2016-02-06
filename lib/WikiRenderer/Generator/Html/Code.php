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

class Code extends AbstractInlineGenerator {

    protected $supportedAttributes = array('id', 'type');

    protected $htmlTagName = 'code';

    public function generate() {
        $html = '';
        foreach($this->content as $content) {
            $html .= $content->generate();
        }

        $attr = '';
        foreach ($this->attributes as $name => $value) {
            if ($name == 'type') {
                $attr .= ' class="code-'.htmlspecialchars($value).'"';
            }
            else {
                $attr .= ' '.$name.'="'.htmlspecialchars($value).'"';
            }
        }

        return '<'.$this->htmlTagName.$attr.'>'.$html.'</'.$this->htmlTagName.'>';
    }

}