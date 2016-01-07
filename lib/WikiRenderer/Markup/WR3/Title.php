<?php

/**
 * wikirenderer3 (wr3) syntax
 *
 * @author Laurent Jouanneau
 * @copyright 2003-2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public 2.1
 * License as published by the Free Software Foundation.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */

namespace WikiRenderer\Markup\WR3;

/**
 * Parse a title block
 */
class Title extends \WikiRenderer\BlockNG
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
