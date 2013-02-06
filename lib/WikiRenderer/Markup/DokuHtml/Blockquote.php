<?php
/**
 * dokuwiki syntax to xhtml
 *
 * @package WikiRenderer
 * @subpackage rules
 * @author Laurent Jouanneau
 * @copyright 2008-2012 Laurent Jouanneau
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
namespace WikiRenderer\Markup\DokuHtml;

/**
 * traite les signes de type blockquote
 */
class Blockquote extends \WikiRenderer\Block
{
    public $type = 'blockquote';
    protected $regexp = "/^\s*(\>+)(.*)/";

    public function open()
    {
        $this->_previousTag = $this->_detectMatch[1];
        $this->_firstTagLen = strlen($this->_previousTag);
        $this->_firstLine = true;
        return str_repeat('<blockquote>', $this->_firstTagLen) . '<p>';
    }

    public function close()
    {
        return '</p>' . str_repeat('</blockquote>', strlen($this->_previousTag));
    }

    public function getRenderedLine()
    {
        $d = strlen($this->_previousTag) - strlen($this->_detectMatch[1]);
        $str = '';

        if ($d > 0) { // on remonte d'un cran dans la hierarchie...
            $str = '</p>' . str_repeat('</blockquote>', $d) . '<p>';
            $this->_previousTag = $this->_detectMatch[1];
        } elseif ($d < 0) { // un niveau de plus
            $this->_previousTag = $this->_detectMatch[1];
            $str = '</p>' . str_repeat('<blockquote>', -$d) . '<p>';
        } else {
            if ($this->_firstLine)
                $this->_firstLine = false;
        }
        return $str.$this->_renderInlineTag($this->_detectMatch[2]);
    }
}

