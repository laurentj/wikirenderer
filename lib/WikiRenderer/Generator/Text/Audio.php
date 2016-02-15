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

class Audio extends AbstractInlineGenerator
{
    protected $supportedAttributes = array('id', 'src', 'align', 'title', 'class');

    protected $attributesInsideBrackets = array('title', 'src');
    protected $attributesInsideBracketsSeparator = ': ';
}
