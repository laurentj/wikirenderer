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

class Link extends AbstractInlineGenerator {
    
    protected $dbTagName = 'link';

    protected $supportedAttributes = array('id', 'href', 'hreflang', 'title');

    public function generate() {
        $text = '';
        foreach($this->content as $content) {
            $text .= $content->generate();
        }

        $attr = '';
        $href = '';
        foreach ($this->attributes as $name => $value) {
            if ($name == 'id') {
                $name = 'xml:id';
            }
            else if ($name == 'href') {
                if ($value[0] == '#') {
                    $name='linkend';
                    $value = $href = substr($value, 1);
                }
                else {
                    $name = 'xlink:href';
                    $href = $value;
                }
            }
            $attr .= ' '.$name.'="'.htmlspecialchars($value, ENT_XML1).'"';
        }

        if (!$href) {
            return $text;
        }
        return '<'.$this->dbTagName.$attr.'>'.$text.'</'.$this->dbTagName.'>';
    }
}