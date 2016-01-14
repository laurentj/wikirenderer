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

    protected $supportedAttributes = array('id', 'src', 'alt', 'align', 'longdesc');

    public function generate() {
        $attr = ' src="'.htmlspecialchars($this->getAttribute('src')).'"';
        $attr .= ' alt="'.htmlspecialchars($this->getAttribute('alt')).'"';

        $id = $this->getAttribute('id');
        if ($id) {
            $attr .= ' id="'.htmlspecialchars($id).'"';
        }

        $desc = $this->getAttribute('longdesc');
        if ($desc) {
            $attr .= ' longdesc="'.htmlspecialchars($desc).'"';
        }

        $align = $this->getAttribute('align');
        if ($align) {
            $attr .= ' style="float:'.htmlspecialchars($align).';"';
        }

        return '<'.$this->htmlTagName.$attr.'/>';
    }
}