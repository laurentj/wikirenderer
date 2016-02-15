<?php

/**
 * @author Laurent Jouanneau
 * @copyright 2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */
namespace WikiRenderer\Generator;

interface BlockListInterface extends BlockGeneratorInterface
{
    const UNORDERED_LIST = 0;
    const ORDERED_LIST = 1;

    /**
     * type of the list.
     *
     * @param int use ORDERED_LIST or UNORDERED_LIST constants
     */
    public function setListType($type);

    /**
     * in automatic mode, call it each time you want to create a new item,
     * even for the first item.
     */
    public function createItem();

    /**
     * add content to the item whose index is given. If not given, it is the
     * automatic mode. In this case, you have to call createItem() first.
     * 
     * @param int                $itemIndex
     * @param GeneratorInterface $content
     */
    public function addContentToItem(GeneratorInterface $content, $itemIndex = -1);
}
