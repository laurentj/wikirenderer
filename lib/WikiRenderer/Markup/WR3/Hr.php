<?php

/**
 * wikirenderer3 (wr3) syntax
 *
 * @author Laurent Jouanneau
 * @copyright 2003-2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer\Markup\WR3;

/**
 * Parser for a text separator
 */
class Hr extends \WikiRenderer\BlockNG
{
    public $type = 'hr';
    protected $regexp = '/^\s*={4,} *$/';
    protected $_closeNow = true;

    public function validateDetectedLine()
    {
    }
}
