<?php

/**
 * dokuwiki syntax to xhtml.
 *
 * @author Laurent Jouanneau
 * @copyright 2008-2012 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer\Markup\DokuHtml;

class Macro extends \WikiRenderer\Block
{
    public $type = 'macro';
    protected $regexp = "/^\s*~~[^~]*~~\s*$/";
    protected $_closeNow = true;

    public function validateDetectedLine()
    {
    }
}
