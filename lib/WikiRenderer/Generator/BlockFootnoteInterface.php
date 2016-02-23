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

interface BlockFootnoteInterface extends BlockGeneratorInterface
{

    /**
     * @return integer the number of footnotes. Can be used to create footnote
     * id.
     */
    public function getFootnoteCount();

    /**
     * add content to the item whose index is given. If not given, it is the
     * automatic mode. In this case, you have to call createItem() first.
     * 
     * @param int                $itemIndex
     * @param InlineGeneratorInterface $content
     */
    public function addFootnote(InlineGeneratorInterface $content);
}
