<?php
/**
 * wikirenderer3 syntax to plain text
 *
 * @package WikiRenderer
 * @subpackage wr3_to_text
 * @author Laurent Jouanneau
 * @contributor  Amaury Bouchard
 * @copyright 2003-2013 Laurent Jouanneau
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
 *
 */
namespace WikiRenderer\Markup\WR3Text;

/**
 * ???
 * @package	WikiRenderer
 * @subpackage	WR3Text
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
     * false-> !!! = titre , !! = sous titre, ! = sous-sous-titre
     */
    protected $_order = false;

    public function getRenderedLine()
    {
        if ($this->_order) {
            $repeat = 4 - strlen($this->_detectMatch[1]);
            if ($repeat < 1)
                $repeat = 1;
        } else
            $repeat = strlen($this->_detectMatch[1]);
        return str_repeat("\n", $repeat) . "\t" . $this->_renderInlineTag($this->_detectMatch[2]) . "\n";
    }
}

