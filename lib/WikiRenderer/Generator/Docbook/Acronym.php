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

class Acronym extends AbstractInlineGenerator implements \WikiRenderer\Generator\InlineAcronymInterface {
    
    protected $dbTagName = 'acronym';

    protected $supportedAttributes = array('id');

    protected $alt = '';

    public function setTitle($title) {
        $this->alt = $title;
    }

    public function generate() {
        $text = '';
        if ($this->alt) {
            $text .= '<alt>'.htmlspecialchars($this->alt, ENT_XML1).'</alt>';
        }
        foreach($this->content as $content) {
            $text .= $content->generate();
        }

        $attr = '';
        foreach ($this->attributes as $name => $value) {
            if ($name == 'id') {
                $name = 'xml:id';
            }
            $attr .= ' '.$name.'="'.htmlspecialchars($value, ENT_XML1).'"';
        }

        return '<'.$this->dbTagName.$attr.'>'.$text.'</'.$this->dbTagName.'>';
    }
}