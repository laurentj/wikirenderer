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
    protected $supportedAttributes = array('id', 'src', 'width', 'height', 'align', 'title', 'class');

    public function generate()
    {

        $txt = '';

        $attr = $this->getAttribute('src');
        if ($attr) {
            $txt .= '<filename>'.htmlspecialchars($attr, ENT_XML1).'</filename>';
        }

        $attr = $this->getAttribute('title');
        if ($attr) {
            $txt .= '('.htmlspecialchars($attr, ENT_XML1).')';
        }
        return $txt;
    }
}
