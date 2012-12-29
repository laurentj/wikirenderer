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
class Image extends \WikiRenderer\TagXhtml
{
    protected $name = 'image';
    public $beginTag = '((';
    public $endTag = '))';
    protected $attribute = array('src', 'alt', 'align', 'longdesc');
    public $separators = array('|');

    public function getContent()
    {
        $contents = $this->wikiContentArr;
        $cnt=count($contents);
        $attribut = '';
        if ($cnt > 4)
            $cnt = 4;
        switch ($cnt) {
            case 4:
                $attribut .= ' longdesc="' . $contents[3] . '"';
            case 3:
                if ($contents[2] == 'l' || $contents[2] == 'L' || $contents[2] == 'g' || $contents[2] == 'G')
                    $attribut .= ' style="float:left;"';
                elseif ($contents[2] == 'r' || $contents[2] == 'R' || $contents[2] == 'd' || $contents[2] == 'D')
                    $attribut .= ' style="float:right;"';
            case 2:
                $attribut .= ' alt="' . $contents[1] . '"';
            case 1:
            default:
                list($href, $label) = $this->config->processLink($contents[0], $this->name);
                $attribut .= ' src="' . htmlspecialchars($href) . '"';
                if ($cnt == 1)
                    $attribut .= ' alt=""';
        }
        return '<img' . $attribut . '/>';
    }
}

