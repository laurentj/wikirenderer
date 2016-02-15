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

interface GeneratorInterface
{
    /**
     * says if it has no content.
     */
    public function isEmpty();

    /**
     * @return string
     */
    public function generate();
}
