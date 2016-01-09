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
class Title extends \WikiRenderer\Block
{
    public $type = 'title';
    protected $regexp = "/^\s*(\!{1,3})(.*)/";
    protected $_closeNow = true;
    protected $_minlevel = 3;
    /**
     * Indique le sens dans lequel il faut interpreter le nombre de signe de titre.
     * true -> ! = titre , !! = sous titre, !!! = sous-sous-titre
     * false-> !!! = titre , !! = sous titre, ! = sous-sous-titre.
     */
    protected $_order = false;

    public function validateDetectedLine()
    {
        if ($this->_order) {
            $repeat = 4 - strlen($this->_detectMatch[1]);
            if ($repeat < 1) {
                $repeat = 1;
            }
        } else {
            $repeat = strlen($this->_detectMatch[1]);
        }

        $this->text[] = str_repeat("\n", $repeat)."\t".$this->_renderInlineTag($this->_detectMatch[2]);
    }
}
