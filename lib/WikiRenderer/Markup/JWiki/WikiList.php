<?php

/**
 * jWiki syntax
 *
 * @author Laurent Jouanneau
 * @copyright 2008-2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer\Markup\JWiki;

/**
 * Parse a list block
 */
class WikiList extends \WikiRenderer\Markup\DokuWiki
{

    public $type = 'list';
    protected $regexp = "/^(\s*)(\-|\*|#)\s*(.*)/";

    protected function getItemType($type) {
        return $type == '*' ? 'u':'o';
    }
}
