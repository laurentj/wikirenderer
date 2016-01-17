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

class Image extends AbstractInlineGenerator {

    protected $htmlTagName = 'img';

    protected $supportedAttributes = array('id', 'src', 'alt', 'align', 'longdesc',
                                           'width', 'height', 'title', 'class');

    public function generate() {
        $attrs = ' src="'.htmlspecialchars($this->getAttribute('src')).'"';
        if ($this->getAttribute('alt')) {
            $attrs .= ' alt="'.htmlspecialchars($this->getAttribute('alt')).'"';
        }
        else {
            $attrs .= ' alt=""';
        }

        foreach(array('id', 'longdesc', 'width', 'height', 'title', 'class') as $attr) {
            $val = $this->getAttribute($attr);
            if ($val) {
                $attrs .= ' '.$attr.'="'.htmlspecialchars($val).'"';
            }
        }

        $align = $this->getAttribute('align');
        if ($align) {
            $attrs .= ' style="float:'.htmlspecialchars($align).';"';
        }

        return '<'.$this->htmlTagName.$attrs.'/>';
    }
}