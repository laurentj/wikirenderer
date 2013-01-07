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
class Pre extends \WikiRenderer\Block
{
    public $type = 'pre';

    public function getRenderedLine()
    {
        return '   ' . $this->_detectMatch;
    }

    public function detect($string, $inBlock = false)
    {
        if ($this->isOpen) {
            if (preg_match("/(.*)<\/code>\s*$/", $string, $m)) {
                $this->_detectMatch = $m[1];
                $this->isOpen = false;
            } else {
                $this->_detectMatch = $string;
            }
            return true;
        } else {
            if (preg_match('/^\s*<code>(.*)/', $string, $m)) {
                if (preg_match('/(.*)<\/code>\s*$/', $m[1], $m2)) {
                    $this->_closeNow = true;
                    $this->_detectMatch = $m2[1];
                } else {
                    $this->_closeNow = false;
                    $this->_detectMatch = $m[1];
                }
                return true;
            } else {
                return false;
            }
        }
    }
}

