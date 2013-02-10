<?php
/**
 * dokuwiki syntax to docbook 4.3
 *
 * @package WikiRenderer
 * @subpackage rules
 * @author Laurent Jouanneau
 * @copyright 2008 Laurent Jouanneau
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
namespace WikiRenderer\Markup\DokuDocBook;

class SyntaxHighlight extends \WikiRenderer\Block
{
    public $type = 'syntaxhighlight';
    protected $_openTag = '<programlisting>';
    protected $_closeTag = '</programlisting>';
    protected $isOpen = false;
    protected $dktag = 'code';

    public function open()
    {
        $this->isOpen = true;
        return $this->_openTag;
    }

    public function close()
    {
        $this->isOpen = false;
        return $this->_closeTag;
    }

    public function getRenderedLine()
    {
        return htmlspecialchars($this->_detectMatch, ENT_NOQUOTES);
    }

    public function detect($string, $inBlock = false)
    {
        if ($this->isOpen) {
            if (preg_match('/(.*)<\/' . $this->dktag . '>\s*$/', $string, $m)) {
                $this->_detectMatch = $m[1];
                $this->isOpen = false;
            } else {
                $this->_detectMatch=$string;
            }
            return true;
        } else {
            if (preg_match('/^\s*<' . $this->dktag . '( \w+)?>(.*)/', $string, $m)) {
                if (preg_match('/(.*)<\/' . $this->dktag . '>\s*$/', $m[2], $m2)) {
                    $this->_closeNow = true;
                    $this->_detectMatch=$m2[1];
                } else {
                    $this->_closeNow = false;
                    $this->_detectMatch = $m[2];
                }
                return true;
            } else
                return false;
        }
    }
}

