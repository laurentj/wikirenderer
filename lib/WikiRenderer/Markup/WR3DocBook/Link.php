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
class Link extends \WikiRenderer\TagXhtml
{
    protected $name = 'ulink';
    public $beginTag = '[[';
    public $endTag = ']]';
    protected $attribute = array('$$', 'href', 'hreflang', 'title');
    public $separators = array('|');
    protected $ignoreAttribute = array('hreflang', 'title');

    public function getContent()
    {
        $cntattr = count($this->attribute);
        $cnt = ($this->separatorCount + 1 > $cntattr) ? $cntattr : ($this->separatorCount + 1);
        if ($cnt == 1) {
            list($href, $label) = $this->config->processLink($this->wikiContentArr[0], $this->name);

            if (preg_match("/^\#(.+)$/", $href, $m))
                return '<link linkterm="' . htmlspecialchars($m[1]) . '">' . htmlspecialchars($label) . '</link>';
            else
                return '<ulink url="' . htmlspecialchars($href) . '">' . htmlspecialchars($label) . '</ulink>';
        } else {
            list($href, $label) = $this->config->processLink($this->wikiContentArr[1], $this->name);
            if (preg_match("/^\#(.+)$/", $href, $m))
                return '<link linkterm="' . htmlspecialchars($m[1]) . '">' . $this->contents[0] . '</link>';
            else
                return '<ulink url="' . htmlspecialchars($href) . '">' . $this->contents[0] . '</ulink>';
        }
    }
}

