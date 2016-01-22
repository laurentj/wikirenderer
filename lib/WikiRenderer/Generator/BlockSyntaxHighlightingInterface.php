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

interface BlockSyntaxHighlightingInterface extends BlockOfRawLinesInterface {

    public function setSyntaxType($type);

    public function getSyntaxType();

    public function setFileName($filename);

    public function getFileName();
}
