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

class Flash extends Audio
{
    protected $supportedAttributes = array('id', 'src', 'width', 'height', 'align', 'title', 'class');
}
