<?php

/**
 * wikirenderer3 (wr3) syntax to xhtml.
 *
 * @author Laurent Jouanneau
 * @copyright 2003-2006 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer\Markup\WR3Html;

/**
 * ???
 */
class Hr extends \WikiRenderer\Block
{
    public $type = 'hr';
    protected $regexp = '/^\s*={4,} *$/';
    protected $_closeNow = true;

    public function validateDetectedLine()
    {
        $this->text[] = '<hr />';
    }
}
