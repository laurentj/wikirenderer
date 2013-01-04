<?php
/**
 * wikirenderer3 (wr3) syntax to docbook 4.3
 *
 * @package WikiRenderer
 * @subpackage rules
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
namespace WikiRenderer\Markup\WR3DocBook;

/**
 * ???
 * @package	WikiRenderer
 * @subpackage	WR3DocBook
 */
class Table extends \WikiRenderer\Block
{
    public $type = 'table';
    protected $regexp = "/^\s*\| ?(.*)/";
    protected $_openTag = '<table border="1">';
    protected $_closeTag = '</table>';
    protected $_colcount = 0;

    public function open()
    {
        $this->_colcount = 0;
        return $this->_openTag;
    }

    public function getRenderedLine()
    {
        $result = explode(' | ', trim($this->_detectMatch[1]));
        $str = '';
        $t = '';

        if ((count($result) != $this->_colcount) && ($this->_colcount != 0))
            $t = '</table><table border="1">';
        $this->_colcount = count($result);

        for ($i = 0; $i < $this->_colcount; $i++) {
            $str .='<td>' . $this->_renderInlineTag($result[$i]) . '</td>';
        }
        $str = $t . '<tr>' . $str . '</tr>';

        return $str;
    }
}

