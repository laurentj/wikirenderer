<?php

/**
 * wikirenderer3 (wr3) syntax to xhtml.
 *
 * @author Laurent Jouanneau
 * @copyright 2003-2006 Laurent Jouanneau
 *
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
 */

namespace WikiRenderer\Markup\WR3;

/**
 * ???
 */
class Image extends \WikiRenderer\TagNG
{
    protected $name = 'image';
    protected $generatorName = 'image';
    public $beginTag = '((';
    public $endTag = '))';
    protected $attribute = array('src', 'alt', 'align', 'longdesc');
    public $separators = array('|');

    public function getContent()
    {
        $contents = $this->wikiContentArr;
        $cnt = count($contents);
        $attribut = '';
        if ($cnt > 4) {
            $cnt = 4;
        }
        if ($cnt >= 3) {
            if ($contents[2] == 'l' || $contents[2] == 'L' || $contents[2] == 'g' || $contents[2] == 'G') {
                $this->wikiContentArr[2] = 'left';
            } elseif ($contents[2] == 'r' || $contents[2] == 'R' || $contents[2] == 'd' || $contents[2] == 'D') {
                $this->wikiContentArr[2] = 'right';
            }
            else {
                $this->wikiContentArr[2] = '';
            }
        }

        list($href, $label) = $this->config->processLink($contents[0], $this->generatorName);
        $this->wikiContentArr[0] = $href;
        if ($cnt == 1 && $href != $label) {
            $this->wikiContentArr[1] = $label;
            $this->separatorCount++;
        }

        return parent::getContent();
    }
}
