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

class TableRow extends \WikiRenderer\Tag
{
    public $isTextLineTag = true;
    protected $attribute = array('$$');
    protected $checkWikiWordIn = array('$$');
    public $separators = array('|', '^');
    protected $columns = array('');

    protected function _doEscape($string)
    {
        return htmlspecialchars($string, ENT_NOQUOTES);
    }

    /**
     * called by the inline parser, when it found a separator
     */
    public function addSeparator($token)
    {
        $this->wikiContent .= $this->wikiContentArr[$this->separatorCount];
        $this->separatorCount++;
        $this->currentSeparator = $token;
        $this->wikiContent .= $token;
        $this->contents[$this->separatorCount] = '';
        $this->wikiContentArr[$this->separatorCount] = '';
        $this->columns[$this->separatorCount] = $token;
    }

    public function isCurrentSeparator($token)
    {
        return ($token == '|' || $token == '^');
    }

    public function isOtherTagAllowed()
    {
        return true;
    }

    public function getBogusContent()
    {
        $c = $this->beginTag;
        $m = count($this->contents)-1;
        $s = count($this->separators);
        foreach ($this->contents as $k => $v)
            $c .= $this->columns[$k] . $v;
        return $c;
    }

    public function getContent()
    {
        $c = "<tr>\n";
        $col = '';
        $colnum = 0;
        $colspan = 0;
        $last = count($this->contents) -1;
        foreach ($this->contents as $k => $content) {
            if ($k == 0)
                continue; // we ignore first content (which is before the first separator
            if ($k == $last)
                break; // we ignore the last content (which is after the last separator
            if ($content == '') {
                if ($col == '' && $k > 0) { // if bad syntax on first col
                    $c .= '<td></td>';
                } else
                    $colspan++;
            } else {
                if ($col !='')
                    $c .= $this->addCol($colnum, $col, $colspan);
                $colnum = $k;
                $col = $content;
            }
        }
        $c .= $this->addCol($colnum, $col, $colspan);
        return $c . "\n</tr>\n";
    }

    protected function addCol($num, $content, $colspan)
    {
        if ($this->columns[$num] == '^')
            $t = 'th';
        else
            $t = 'td';

        $align = '';
        $l = 0;
        $r = 0;
        if (preg_match("/^(\s+)/", $content, $m))
            $l = strlen($m[1]);
        if (preg_match("/(\s+)$/", $content, $m))
            $r = strlen($m[1]);
        if (trim($content) == '')
            $l = $r = 0;
        if ($l==0 && $r > 2)
            $align = ' align="left"';
        else if ($r == 0 && $l > 2)
            $align = ' align="right"';
        else if ($l > 2 && $l == $r)
            $align = ' align="center"';
        if ($colspan)
            return '<' . $t . ' colspan="' . ($colspan + 1) . '"' . $align . '>' . $content . '</' . $t . '>';
        else
            return '<' . $t . $align . '>' . $content . '</' . $t . '>';
    }
}

