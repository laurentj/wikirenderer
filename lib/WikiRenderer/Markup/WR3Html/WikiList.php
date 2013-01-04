<?php
/**
 * wikirenderer3 (wr3) syntax to xhtml
 *
 * @package WikiRenderer
 * @subpackage rules
 * @author Laurent Jouanneau
 * @copyright 2003-2006 Laurent Jouanneau
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
namespace WikiRenderer\Markup\WR3Html;

/**
 * ???
 * @package	WikiRenderer
 * @subpackage	WR3Html
 */
class WikiList extends \WikiRenderer\Block
{
    public $type = 'list';
    protected $_previousTag;
    protected $_firstItem;
    protected $_firstTagLen;
    protected $regexp = "/^\s*([\*#-]+)(.*)/";

    public function open()
    {
        $this->_previousTag = $this->_detectMatch[1];
        $this->_firstTagLen = strlen($this->_previousTag);
        $this->_firstItem = true;

        if (substr($this->_previousTag, -1, 1) == '#')
            return "<ol>\n";
        else
            return "<ul>\n";
    }

    public function close()
    {
        $t = $this->_previousTag;
        $str = '';

        for ($i = strlen($t); $i >= $this->_firstTagLen; $i--) {
            $str .= ($t[$i - 1] == '#') ? "</li></ol>\n" : "</li></ul>\n";
        }
        return $str;
    }

    public function getRenderedLine()
    {
        $t = $this->_previousTag;
        $d = strlen($t) - strlen($this->_detectMatch[1]);
        $str = '';

        if ($d > 0) { // on remonte d'un ou plusieurs cran dans la hierarchie...
            $l = strlen($this->_detectMatch[1]);
            for ($i = strlen($t); $i > $l; $i--) {
                $str .= ($t[$i - 1] == '#') ? "</li></ol>\n" : "</li></ul>\n";
            }
            $str .= "</li>\n<li>";
            $this->_previousTag = substr($this->_previousTag, 0, -$d); // pour étre sur...

        } elseif ($d < 0) { // un niveau de plus
            $c = substr($this->_detectMatch[1], -1, 1);
            $this->_previousTag .= $c;
            $str = ($c == '#') ? "<ol><li>" : "<ul><li>";

        } else {
            $str = $this->_firstItem ? '<li>' : "</li>\n<li>";
        }
        $this->_firstItem = false;
        return $str . $this->_renderInlineTag($this->_detectMatch[2]);
    }
}

