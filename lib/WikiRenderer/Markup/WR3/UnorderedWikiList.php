<?php

/**
 * wikirenderer3 (wr3) syntax.
 *
 * @author Laurent Jouanneau
 * @copyright 2003-2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */
namespace WikiRenderer\Markup\WR3;

use WikiRenderer\Generator\BlockListInterface;

/**
 * Parse a list block.
 */
class UnorderedWikiList extends OrderedWikiList
{
    protected $regexp = "/^(\\s*[\\*-])\\s?(.*)/";

    protected function getTypeList() {
        return BlockListInterface::UNORDERED_LIST;
    }
}
