<?php

/**
 * @author Laurent Jouanneau
 * @copyright 2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */
namespace WikiRenderer\Generator\Docbook;

class Flash extends AbstractInlineGenerator
{
    protected $dbTagName = 'object';

    protected $supportedAttributes = array('id', 'src', 'width', 'height', 'align', 'title', 'class');

    public function generate()
    {
        $attrs = ' data="'.htmlspecialchars($this->getAttribute('src'), ENT_XML1).'"';

        foreach (array('id', 'title', 'class', 'width', 'height') as $attr) {
            $val = $this->getAttribute($attr);
            if ($val) {
                $attrs .= ' '.$attr.'="'.htmlspecialchars($val, ENT_XML1).'"';
            }
        }

        $align = $this->getAttribute('align');
        if ($align) {
            $attrs .= ' style="float:'.htmlspecialchars($align, ENT_XML1).';"';
        }

        return '<'.$this->dbTagName.$attrs.' type="application/vnd.adobe.flash-movie">'.
            '<p>Flash content cannot be loaded</p></'.$this->dbTagName.'>';
    }
}
