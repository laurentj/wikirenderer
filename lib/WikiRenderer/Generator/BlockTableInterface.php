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

interface BlockTableInterface extends BlockGeneratorInterface
{
    public function createRow();

    public function addCell(BlockTableCellInterface $content);
}
