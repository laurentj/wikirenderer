<?php

/**
 * @author Laurent Jouanneau
 *
 * @copyright 2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public 2.1
 * License as published by the Free Software Foundation.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */

namespace WikiRenderer\Generator;

interface BlockListInterface extends BlockGeneratorInterface {

    const UNORDERED_LIST = 0;
    const ORDERED_LIST = 1;

    /**
     * type of the list.
     * @param integer use ORDERED_LIST or UNORDERED_LIST constants
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
     * @param integer $itemIndex
     * @param GeneratorInterface $content
     */
    public function addContentToItem(GeneratorInterface $content, $itemIndex = -1);

}
