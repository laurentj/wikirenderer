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

class Audio extends AbstractInlineGenerator
{
    protected $dbTagName = 'audioobject';

    protected $supportedAttributes = array('id', 'src', 'align', 'title', 'class');

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

        $imagedata = '<audiodata format="" fileref="'.htmlspecialchars($this->getAttribute('src'), ENT_XML1).'"'.$attrs."/>\n";

        return '<inlinemediaobject'.$id.">\n".$info.'<audioobject>'.$imagedata.'</audioobject></inlinemediaobject>';
    }
}
