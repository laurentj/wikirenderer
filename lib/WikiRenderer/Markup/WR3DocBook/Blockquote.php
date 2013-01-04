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
class Blockquote extends \WikiRenderer\Block
{
    public $type = 'bq';
    protected $regexp = "/^\s*(\>+)(.*)/";

    public function open()
    {
        $this->_previousTag = $this->_detectMatch[1];
        $this->_firstTagLen = strlen($this->_previousTag);
        $this->_firstLine = true;
        return str_repeat('<blockquote>', $this->_firstTagLen) . '<para>';
    }

    public function close()
    {
      return '</para>' . str_repeat('</blockquote>', strlen($this->_previousTag));
    }

    public function getRenderedLine()
    {
        $d = strlen($this->_previousTag) - strlen($this->_detectMatch[1]);
        $str = '';

        if ($d > 0) { // on remonte d'un cran dans la hierarchie...
            $str = '</para>' . str_repeat('</blockquote>', $d) . '<para>';
            $this->_previousTag = $this->_detectMatch[1];
        } elseif ($d < 0) { // un niveau de plus
            $this->_previousTag = $this->_detectMatch[1];
            $str = '</para>' . str_repeat('<blockquote>', -$d) . '<para>';
        } else {
            if ($this->_firstLine)
                $this->_firstLine = false;
        }
        return $str . $this->_renderInlineTag($this->_detectMatch[2]);
    }
}

