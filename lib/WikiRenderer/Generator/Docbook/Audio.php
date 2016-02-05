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

class Audio extends AbstractInlineGenerator {

    protected $dbTagName = 'audio';

    protected $supportedAttributes = array('id', 'src', 'align', 'title', 'class');

    public function generate() {
        $attrs = ' src="'.htmlspecialchars($this->getAttribute('src'), ENT_XML1).'"';

        foreach(array('id', 'title', 'class') as $attr) {
            $val = $this->getAttribute($attr);
            if ($val) {
                $attrs .= ' '.$attr.'="'.htmlspecialchars($val, ENT_XML1).'"';
            }
        }

        $align = $this->getAttribute('align');
        if ($align) {
            $attrs .= ' style="float:'.htmlspecialchars($align, ENT_XML1).';"';
        }

        return '<'.$this->dbTagName.$attrs.' controls="true"/>';
    }
}