<?php

/**
 * @author Laurent Jouanneau
 * @copyright 2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */
namespace WikiRenderer\Generator\Text;

class BracketTag extends AbstractInlineGenerator
{
    /**
     * @return string
     */
    public function generate()
    {
        $text = '(';
        foreach ($this->content as $content) {
            $text .= $content->generate();
        }

        return $text.')';
    }
}
