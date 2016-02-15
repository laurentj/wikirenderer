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

interface BlockOfRawLinesInterface extends BlockGeneratorInterface
{
    /**
     * @param string $content
     */
    public function addLine($content);
}
