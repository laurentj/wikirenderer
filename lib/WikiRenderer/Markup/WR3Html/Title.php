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
class Title extends \WikiRenderer\Block
{
    public $type = 'title';
    protected $regexp = "/^\s*(\!{1,3})(.*)/";
    protected $_closeNow = true;
    protected $_minlevel = 3;
    /**
     * indique le sens dans lequel il faut interpreter le nombre de signe de titre
     * true -> ! = titre , !! = sous titre, !!! = sous-sous-titre
     * false-> !!! = titre , !! = sous titre, ! = sous-sous-titre.
     */
    protected $_order = false;

    public function validateDetectedLine()
    {
        if ($this->_order) {
            $hx = $this->_minlevel + strlen($this->_detectMatch[1]) - 1;
        } else {
            $hx = $this->_minlevel + 3 - strlen($this->_detectMatch[1]);
        }

        $this->text[] = '<h'.$hx.'>'.$this->_renderInlineTag($this->_detectMatch[2]).'</h'.$hx.'>';
    }
}
