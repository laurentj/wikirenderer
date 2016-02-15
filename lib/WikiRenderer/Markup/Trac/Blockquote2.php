<?php

/**
 * Trac syntax.
 *
 * @author Laurent Jouanneau
 * @copyright 2006-2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */
namespace WikiRenderer\Markup\Trac;

/**
 * Parse blockquote block.
 */
class Blockquote2 extends Blockquote
{
    protected $regexp = "/^(\s{2,})([^\s\>\*1\=\{\-\[].*)/";

    protected function getTagLen($tag)
    {
        return floor(strlen($tag) / 2);
    }
}
