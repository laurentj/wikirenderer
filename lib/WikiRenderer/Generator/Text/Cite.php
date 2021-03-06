<?php

/**
 * @author Laurent Jouanneau
 * @copyright 2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */
namespace WikiRenderer\Generator\Text;

class Cite extends AbstractInlineGenerator
{
    protected $supportedAttributes = array('id', 'title');

    protected $attributesInsideBrackets = array('title');
}
