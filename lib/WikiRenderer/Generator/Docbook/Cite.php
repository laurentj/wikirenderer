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

class Cite extends AbstractInlineGenerator
{
    protected $dbTagName = 'citetitle';

    protected $supportedAttributes = array('id');
}
