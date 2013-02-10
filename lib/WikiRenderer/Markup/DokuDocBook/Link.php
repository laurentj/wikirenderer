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

class Link extends \WikiRenderer\TagXml
{
    protected $name = 'ulink';
    public $beginTag = '[[';
    public $endTag = ']]';
    protected $attribute = array('href', '$$');
    public $separators = array('|');

    public function getContent()
    {
        $cntattr = count($this->attribute);
        $cnt = (($this->separatorCount + 1) > $cntattr) ? $cntattr : ($this->separatorCount + 1);
        list($href, $label) = $this->config->processLink($this->wikiContentArr[0], $this->name);
        if ($cnt == 1)
            $label = htmlspecialchars($label, ENT_NOQUOTES);
        else
            $label = $this->contents[1];
        if ($href == '#' || $href == '')
            return $label;
        if (preg_match("/^\#(.+)$/", $href, $m))
            return '<link linkterm="' . htmlspecialchars(trim($m[1])) . '">' . $label . '</link>';
        else
            return '<ulink url="' . htmlspecialchars(trim($href)) . '">' . $label . '</ulink>';
    }
}

