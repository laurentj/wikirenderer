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

class Hr implements \WikiRenderer\Generator\BlockGeneratorInterface
{
    protected $id = '';

    public function __construct(\WikiRenderer\Generator\Config $config) {

    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function isEmpty()
    {
        return false;
    }

    public function generate()
    {
        return '';
    }
}
