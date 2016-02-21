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

class Video extends AbstractInlineGenerator
{
    protected $supportedAttributes = array('id', 'src', 'align', 'width',
                                           'height', 'title', 'class', );

    public function generate()
    {
        $id = '';
        $attrs = '';
        $info = '';

        $title = $this->getAttribute('title');
        if ($title) {
            $info = '<info><abstract><title>'.htmlspecialchars($title, ENT_XML1).'</title>';
            $info .= "<para></para></abstract></info>\n";
        }

        $attr = $this->getAttribute('id');
        if ($attr) {
            $id = ' xml:id="'.htmlspecialchars($attr, ENT_XML1).'"';
        }

        $attr = $this->getAttribute('align');
        if ($attr) {
            $attrs .= ' align="'.htmlspecialchars($attr, ENT_XML1).'"';
        }
        $width = $this->getAttribute('width');
        if ($width) {
            $attrs .= ' contentwidth="'.htmlspecialchars($width, ENT_XML1).'"';
        }
        $height = $this->getAttribute('height');
        if ($height) {
            $attrs .= ' contentdepth="'.htmlspecialchars($height, ENT_XML1).'"';
        }

        $imagedata = '<videodata fileref="'.htmlspecialchars($this->getAttribute('src'), ENT_XML1).'"'.$attrs."/>\n";

        return '<inlinemediaobject'.$id.">\n".$info.'<videoobject>'.$imagedata.'</videoobject></inlinemediaobject>';
    }
}
