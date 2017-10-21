<?php

/**
 * @author Laurent Jouanneau
 * @copyright 2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */
namespace WikiRenderer\Generator\Docbook;

class LineBreak implements \WikiRenderer\Generator\InlineGeneratorInterface
{
    public function __construct(\WikiRenderer\Generator\Config $config) {
    }

    public function isEmpty()
    {
        return false;
    }

    /**
     * @return string
     */
    public function generate()
    {
        return '';
    }
}
