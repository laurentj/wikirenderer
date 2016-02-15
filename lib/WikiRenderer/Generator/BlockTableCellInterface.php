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

interface BlockTableCellInterface extends BlockGeneratorInterface
{
    /**
     * @param bool true if the cell is a cell header
     */
    public function setIsHeader($isHeader);

    /**
     * @param int $colspan
     */
    public function setColSpan($colspan);

    /**
     * if -1 is given, the cell is part of the cell above it.
     *
     * @param int $rowspan
     */
    public function setRowSpan($rowspan);

    /**
     * @return int $colspan
     */
    public function getColSpan();

    /**
     * @return int $rowspan
     */
    public function getRowSpan();

    /**
     * @param string
     */
    public function setAlign($align);

    public function getAlign();

    public function addContent(GeneratorInterface $content);
}
