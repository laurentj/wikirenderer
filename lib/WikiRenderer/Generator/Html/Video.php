<?php

/**
 * @author Laurent Jouanneau
 * @copyright 2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */
namespace WikiRenderer\Generator\Html;

class Video extends AbstractInlineGenerator
{
    protected $htmlTagName = 'video';

    protected $supportedAttributes = array('id', 'src', 'align', 'width',
                                           'height', 'title', 'class', );

    public function generate()
    {
        $attrs = ' src="'.htmlspecialchars($this->getAttribute('src'), ENT_COMPAT | ENT_HTML5 | ENT_SUBSTITUTE).'"';

        foreach (array('id', 'width', 'height', 'title', 'class') as $attr) {
            $val = $this->getAttribute($attr);
            if ($val) {
                $attrs .= ' '.$attr.'="'.htmlspecialchars($val, ENT_COMPAT | ENT_HTML5 | ENT_SUBSTITUTE).'"';
            }
        }

        $align = $this->getAttribute('align');
        if ($align) {
            $attrs .= ' style="float:'.htmlspecialchars($align, ENT_COMPAT | ENT_HTML5 | ENT_SUBSTITUTE).';"';
        }

        return '<'.$this->htmlTagName.$attrs.' controls="true"/>';
    }
}
