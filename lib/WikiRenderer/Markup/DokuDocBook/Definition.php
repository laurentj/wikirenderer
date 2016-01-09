<?php

/**
 * dokuwiki syntax to docbook 5.0.
 *
 * @author Laurent Jouanneau
 * @copyright 2008 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer\Markup\DokuDocBook;

class Definition extends \WikiRenderer\Block
{
    public $type = 'dfn';
    protected $regexp = "/^\s*;(.*) : (.*)/i";
    protected $_openTag = '<variablelist>';
    protected $_closeTag = '</variablelist>';

    public function validateDetectedLine()
    {
        $dt = $this->_renderInlineTag($this->_detectMatch[1]);
        $dd = $this->_renderInlineTag($this->_detectMatch[2]);

        $this->text[] = "<varlistentry><term>$dt</term>\n<listitem><para>$dd</para></listitem></varlistentry>";
    }
}
