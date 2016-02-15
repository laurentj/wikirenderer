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

class Flash extends AbstractInlineGenerator
{
    protected $htmlTagName = 'object';

    protected $supportedAttributes = array('id', 'src', 'width', 'height', 'align', 'title', 'class');

    public function generate()
    {
        $attrs = ' data="'.htmlspecialchars($this->getAttribute('src')).'"';

        foreach (array('id', 'title', 'class', 'width', 'height') as $attr) {
            $val = $this->getAttribute($attr);
            if ($val) {
                $attrs .= ' '.$attr.'="'.htmlspecialchars($val).'"';
            }
        }

        $align = $this->getAttribute('align');
        if ($align) {
            $attrs .= ' style="float:'.htmlspecialchars($align).';"';
        }

        return '<'.$this->htmlTagName.$attrs.' type="application/vnd.adobe.flash-movie">'.
            '<p>Flash content cannot be loaded</p></'.$this->htmlTagName.'>';
    }
}
