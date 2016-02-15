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

/**
 * Block that does generate nothing. Useful for markup comments...
 */
class DummyBlock implements BlockGeneratorInterface
{
    public function setId($id)
    {
        // do nothing
    }

    public function addLine($content)
    {
        // do nothing
    }

    public function isEmpty()
    {
        return true;
    }

    public function generate()
    {
        return '';
    }
}
