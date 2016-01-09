<?php

/**
 * Original wikirenderer (wr) syntax
 *
 * @author Laurent Jouanneau
 * @copyright 2003-2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer\Markup\ClassicWR;

/**
 * Parser for a text separator
 */
class Hr extends \WikiRenderer\BlockNG
{
    public $type = 'hr';
    protected $regexp = '/^={4,} *$/';
    protected $_closeNow = true;

    public function validateDetectedLine()
    {
    }
}
