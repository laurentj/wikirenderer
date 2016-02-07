<?php

/**
 * DokuWiki syntax
 *
 * @author Laurent Jouanneau
 * @copyright 2008-2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer\Markup\DokuWiki;

/**
 * Parse a title block
 */
class Title extends \WikiRenderer\Block
{
    public $type = 'title';
    protected $regexp = "/^\s*(\=+)\s*([^=]+)\s*(\=+)\s*$/";
    protected $_closeNow = true;

    public function validateDetectedLine()
    {
        $level = strlen($this->_detectMatch[1]);
        $h = 6 - $level + $this->engine->getConfig()->startHeaderNumber;
        if ($h > 6) {
            $h = 6;
        } elseif ($h < 1) {
            $h = 1;
        }
        $this->generator->setLevel($h);
        $title = trim($this->_detectMatch[2]);
        $this->generator->addLine($this->_renderInlineTag($title));
    }
}
