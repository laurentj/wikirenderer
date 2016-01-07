<?php

/**
 * wikirenderer3 (wr3) syntax
 *
 * @author Laurent Jouanneau
 * @copyright 2003-2016 Laurent Jouanneau
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
 * Parser for a link
 */
class Link extends \WikiRenderer\TagNG
{
    protected $name = 'a';
    protected $generatorName = 'link';
    public $beginTag = '[[';
    public $endTag = ']]';
    protected $attribute = array('$$', 'href', 'hreflang', 'title');
    public $separators = array('|');

    public function getContent()
    {
        $cntattr = count($this->attribute);
        $cnt = ($this->separatorCount + 1 > $cntattr) ? $cntattr : ($this->separatorCount + 1);
        if ($cnt == 1) {
            list($href, $label) = $this->config->processLink($this->wikiContentArr[0], $this->generatorName);
            $this->wikiContentArr[1] = $href;
            $this->separatorCount++;
            $this->generator->setRawContent($label);
        } else {
            list($href, $label) = $this->config->processLink($this->wikiContentArr[1], $this->generatorName);
            $this->wikiContentArr[1] = $href;
        }
        return parent::getContent();
    }
}
