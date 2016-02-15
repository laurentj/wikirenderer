<?php

/**
 * wikirenderer3 (wr3) syntax.
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
 * Parse a title block.
 */
class Title extends \WikiRenderer\Block
{
    public $type = 'title';
    protected $regexp = "/^\s*(\!{1,3})(.*)/";
    protected $_closeNow = true;
    protected $_minlevel = 3;

    /**
     * indicate if the level is ascending or descending
     * true -> ! = title , !! = sub title, !!! = sub-sub-title
     * false-> !!! = title , !! = sub title, ! = sub-sub-title.
     */
    protected $_order = false;

    public function validateDetectedLine()
    {
        if ($this->_order) {
            $hx = $this->_minlevel + strlen($this->_detectMatch[1]) - 1;
        } else {
            $hx = $this->_minlevel + 3 - strlen($this->_detectMatch[1]);
        }
        $this->generator->setLevel($hx);
        $this->generator->addLine($this->_renderInlineTag($this->_detectMatch[2]));
    }
}
