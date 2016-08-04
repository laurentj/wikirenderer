<?php
/**
 * Markdown (CommonMark) syntax.
 *
 * @author Laurent Jouanneau
 * @copyright 2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */
namespace WikiRenderer\Markup\Markdown;

use WikiRenderer\Generator\BlockListInterface;

/**
 * Parse a list block.
 */
class UnorderedWikiList extends OrderedWikiList
{
    protected $regexp = "/^( {0,3})([\\-\\+\\*])(\\s+)(.*)/";

    protected function getTypeList() {
        return BlockListInterface::UNORDERED_LIST;
    }
}
