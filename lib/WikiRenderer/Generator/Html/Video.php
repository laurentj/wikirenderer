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
        $attrs = ' src="'.htmlspecialchars($this->getAttribute('src')).'"';

        foreach (array('id', 'width', 'height', 'title', 'class') as $attr) {
            $val = $this->getAttribute($attr);
            if ($val) {
                $attrs .= ' '.$attr.'="'.htmlspecialchars($val).'"';
            }
        }

        $align = $this->getAttribute('align');
        if ($align) {
            $attrs .= ' style="float:'.htmlspecialchars($align).';"';
        }

        return '<'.$this->htmlTagName.$attrs.' controls="true"/>';
    }
}
