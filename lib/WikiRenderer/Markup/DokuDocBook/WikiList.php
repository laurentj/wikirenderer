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

/**
 * traite les signes de types liste
 */
class WikiList extends \WikiRenderer\Block
{
    public $type = 'list';
    protected $_stack = array();
    protected $_firstTagLen;
    protected $regexp = "/^(\s{2,})([\*\-])(.*)/";
    protected $_firstItem = true;

    public function open()
    {
        $this->_stack[] = array(strlen($this->_detectMatch[1]),  $this->_detectMatch[2]);
        $this->_firstTagLen = strlen($this->_detectMatch[1]);
        $this->_firstItem = true;
        if ($this->_detectMatch[2] == '-')
            return "<orderedlist>\n";
        else
            return "<itemizedlist>\n";
    }

    public function close()
    {
        $str = '';

        for ($i = count($this->_stack) - 1; $i >= 0; $i--) {
            if ($this->_stack[$i][0] < $this->_firstTagLen)
                break;

            $str .= ($this->_stack[$i][1] == '-') ? "</listitem></orderedlist>\n" : "</listitem></itemizedlist>\n";
            array_pop($this->_stack);
        }
        return $str;
    }

    public function getRenderedLine()
    {
        $t = end($this->_stack);
        $newLen = strlen($this->_detectMatch[1]);
        $d = $t[0] - $newLen;
        $str = '';

        if ($d < 0) { // un niveau de plus
            $this->_stack[] = array($newLen, $this->_detectMatch[2]);
            $str = ($this->_detectMatch[2] == '-') ? "<orderedlist><listitem>" : "<itemizedlist><listitem>";
        } else {
            if ($d > 0) { // on remonte d'un ou plusieurs cran dans la hierarchie...
                for ($i = count($this->_stack) - 1; $i >= 0; $i--) {
                    if ($this->_stack[$i][0] <= $newLen)
                        break;
                    else
                        $str .= ($this->_stack[$i][1]== '-') ? "</listitem></orderedlist>\n" : "</listitem></itemizedlist>\n";
                    array_pop($this->_stack);
                }
                if (count($this->_stack) == 0) {
                    $this->_firstTagLen = $newLen;
                    $this->_firstItem = true;
                    $t = array($newLen, $this->_detectMatch[2]);
                    $this->_stack[] = $t;
                    if ($t[1] == '-')
                        $str .= "<orderedlist>\n";
                    else
                        $str .= "<itemizedlist>\n";
                } else
                    $t = end($this->_stack);
            }

            if ($t[1] != $this->_detectMatch[2]) {
                if (!$this->_firstItem)
                    $str .='</listitem>';
                if ($t[1] == '-')
                    $str .= "<orderedlist>\n<listitem>";
                else
                    $str .= "<itemizedlist>\n<listitem>";
                array_pop($this->_stack);
                $this->_stack[] = array($newLen ,  $this->_detectMatch[2]);
            } else {
                if ($this->_firstItem)
                    $str .= "<listitem>";
                else
                    $str .= "</listitem>\n<listitem>";
            }
        }
        $this->_firstItem = false;
        return $str . $this->_renderInlineTag(trim($this->_detectMatch[3]));
    }
}

