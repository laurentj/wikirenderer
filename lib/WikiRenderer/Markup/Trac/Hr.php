<?php

/**
 * Trac syntax
 *
 * @author Laurent Jouanneau
 * @copyright 2006-2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer\Markup\Trac;

/**
 * Parser for a text separator
 */
class Hr extends \WikiRenderer\BlockNG
{
    public $type = 'hr';
    protected $regexp = '/^\-{4,}\s*$/';
    protected $_closeNow = true;

    public function validateDetectedLine()
    {
    }
}
