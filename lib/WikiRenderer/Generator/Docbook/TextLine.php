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

class TextLine extends AbstractInlineGenerator
{
    /**
     * @return string
     */
    public function generate()
    {
        $html = '';
        foreach ($this->content as $content) {
            $html .= $content->generate();
        }

        return $html;
    }
}
