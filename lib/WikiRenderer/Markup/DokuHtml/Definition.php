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

/**
 * definition list.
 */
class Definition extends \WikiRenderer\Block
{
    public $type = 'dfn';
    protected $regexp = "/^\s*;(.*) : (.*)/i";
    protected $_openTag = '<dl>';
    protected $_closeTag = '</dl>';

    public function validateDetectedLine()
    {
        $dt = $this->_renderInlineTag($this->_detectMatch[1]);
        $dd = $this->_renderInlineTag($this->_detectMatch[2]);

        $this->text[] = "<dt>$dt</dt>\n<dd>$dd</dd>";
    }
}
