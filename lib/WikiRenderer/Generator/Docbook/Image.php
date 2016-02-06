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

class Image extends AbstractInlineGenerator {

    protected $dbTagName = 'img';

    protected $supportedAttributes = array('id', 'src', 'alt', 'align', 'longdesc',
                                           'width', 'height', 'title', 'class');

    public function generate() {
        
        $alt = '';
        $text = '';
        $id = '';
        $attrs = '';
        $info='';

        if ($this->getAttribute('alt')) {
            $alt .= '<alt>'.htmlspecialchars($this->getAttribute('alt'), ENT_XML1)."</alt>\n";
        }

        $desc = $this->getAttribute('longdesc');
        $title = $this->getAttribute('title');
        if ($desc || $title) {
            $info = '<info><abstract><title>'.htmlspecialchars($title, ENT_XML1).'</title>';
            $info .= '<para>'.htmlspecialchars($desc, ENT_XML1)."</para></abstract></info>\n";
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

        $imagedata = '<imagedata fileref="'.htmlspecialchars($this->getAttribute('src'), ENT_XML1).'"'.$attrs."/>\n";
// FIXME: generates mediaobject if not in block
        return '<inlinemediaobject'.$id.">\n".$info.$alt.'<imageobject>'.$imagedata. '</imageobject>'.$text.'</inlinemediaobject>';
    }
}
