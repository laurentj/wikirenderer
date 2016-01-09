<?php

/**
 * wikirenderer3 syntax to plain text.
 *
 * @author Laurent Jouanneau
 * @contributor  Amaury Bouchard
 *
 * @copyright 2003-2013 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer\Markup\WR3Text;

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
        $this->text[] = "=======================================================";
    }
}
