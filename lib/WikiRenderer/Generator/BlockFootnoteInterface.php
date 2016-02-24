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
     * @param string $prefixId  the prefix for id of footnotes
     */
    public function __construct($prefixId);

    /**
     * @param integer $index the index of the foonote for which we want ids
     * @return array  first item is the id for the footnote,
     *   second item is the id of the link to the footnote
     */
    public function getLinkId($index);

    /**
     * add a footnote
     * 
     * @param InlineFootnotelinkInterface $footnote
     * @return int  the footnote index
     */
    public function addFootnote(InlineFootnotelinkInterface $footnote);
}
