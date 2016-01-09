<?php

/**
 * dokuwiki syntax to xhtml.
 *
 * @author Laurent Jouanneau
 * @copyright 2008-2012 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer\Markup\DokuHtml;

/**
 * traite les signes de types liste.
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
        $this->_stack[] = array(strlen($this->_detectMatch[1]) ,  $this->_detectMatch[2]);
        $this->_firstTagLen = strlen($this->_detectMatch[1]);
        $this->_firstItem = true;
        if ($this->_detectMatch[2] == '-') {
            $this->_openTag = "<ol>\n";
        } else {
            $this->_openTag = "<ul>\n";
        }
    }

    public function close()
    {
        $this->_closeTag = '';
        for ($i = count($this->_stack) - 1; $i >= 0; --$i) {
            if ($this->_stack[$i][0] < $this->_firstTagLen) {
                break;
            }

            $this->_closeTag .= ($this->_stack[$i][1] == '-') ? "</li></ol>\n" : "</li></ul>\n";
            array_pop($this->_stack);
        }

        return parent::close();
    }

    public function validateDetectedLine()
    {
        $t = end($this->_stack);
        $newLen = strlen($this->_detectMatch[1]);
        $d = $t[0] - $newLen;
        $str = '';

        if ($d < 0) { // un niveau de plus
            $this->_stack[] = array($newLen ,  $this->_detectMatch[2]);
            $str = ($this->_detectMatch[2] == '-') ? '<ol><li>' : '<ul><li>';
        } else {
            if ($d > 0) { // on remonte d'un ou plusieurs cran dans la hierarchie...
                for ($i = count($this->_stack) - 1; $i >= 0; --$i) {
                    if ($this->_stack[$i][0] <= $newLen) {
                        break;
                    } else {
                        $str .= ($this->_stack[$i][1] == '-') ? "</li></ol>\n" : "</li></ul>\n";
                    }
                    array_pop($this->_stack);
                }
                if (count($this->_stack) == 0) {
                    $this->_firstTagLen = $newLen;
                    $this->_firstItem = true;
                    $t = array($newLen,   $this->_detectMatch[2]);
                    $this->_stack[] = $t;
                    if ($t[1] == '-') {
                        $str .= "<ol>\n";
                    } else {
                        $str .= "<ul>\n";
                    }
                } else {
                    $t = end($this->_stack);
                }
            }
            if ($t[1] != $this->_detectMatch[2]) {
                if (!$this->_firstItem) {
                    $str .= '</li>';
                }
                if ($t[1] == '-') {
                    $str .= "<ol>\n<li>";
                } else {
                    $str .= "<ul>\n<li>";
                }
                array_pop($this->_stack);
                $this->_stack[] = array($newLen, $this->_detectMatch[2]);
            } else {
                if ($this->_firstItem) {
                    $str .= '<li>';
                } else {
                    $str .= "</li>\n<li>";
                }
            }
        }
        $this->_firstItem = false;

        $this->text[] = $str.$this->_renderInlineTag(trim($this->_detectMatch[3]));
    }
}
