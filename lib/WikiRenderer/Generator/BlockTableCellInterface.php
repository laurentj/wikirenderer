<?php

/**
 * @author Laurent Jouanneau
 *
 * @copyright 2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer\Generator;

interface BlockTableCellInterface extends BlockGeneratorInterface {

    /**
     * @param boolean true if the cell is a cell header
     */
    public function setIsHeader($isHeader);

    /**
     * @param integer $colspan
     */
    public function setColSpan($colspan);

    /**
     * @param integer $rowspan
     */
    public function setRowSpan($rowspan);

    /**
     * @return integer $colspan
     */
    public function getColSpan();

    /**
     * @return integer $rowspan
     */
    public function getRowSpan();

    /**
     * @param string
     */
    public function setAlign($align);

    public function getAlign();

    public function addContent(GeneratorInterface $content);

}
