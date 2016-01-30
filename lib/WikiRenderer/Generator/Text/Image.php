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

class Image extends AbstractInlineGenerator {

    protected $supportedAttributes = array('id', 'src', 'alt', 'align', 'longdesc',
                                           'width', 'height', 'title', 'class');

    public function generate() {
        $text = parent::generate();
        $text .=' (';
        $title = '';
        if (isset($this->attributes['alt'])) {
            $title = $this->attributes['alt'].': ';
        }
        else if (isset($this->attributes['title'])) {
            $title = $this->attributes['title'].': ';
        }

        $text .= $title.$this->getAttribute('src');
        $text .=')';
        return $text;
    }
}