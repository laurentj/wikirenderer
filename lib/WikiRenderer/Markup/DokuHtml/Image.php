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

class Image extends \WikiRenderer\TagXhtml
{
    protected $name = 'image';
    public $beginTag = '{{';
    public $endTag = '}}';
    protected $attribute = array('fileref', 'title');
    public $separators = array('|');

    public function getContent()
    {
        $contents = $this->wikiContentArr;

        if (count($contents) == 1) {
            $href = $contents[0];
            $title = '';
        } else {
            $href = $contents[0];
            $title = $contents[1];
        }

        $align = '';
        $width = '';
        $height = '';

        $m= array('', '', '', '', '', '', '', '');
        if (preg_match("/^(\s*)([^\s\?]+)(\?(\d+)(x(\d+))?)?(\s*)$/", $href, $m)) {
            if($m[1] != '' && $m[7] != '')
                $align = 'center';
            elseif ($m[1] != '')
                $align = 'right';
            elseif ($m[7] != '')
                $align = 'left';
            if ($m[3]) {
                $width = $height = $m[4];
                if ($m[5])
                   $height = $m[6];
            }
            $href = $m[2];
        }
        list($href, $label) = $this->config->processLink($href, $this->name);
        $tag = '<img src="' . $href . '"';
        if ($width != '')
            $tag .= ' width="' . $width . '"';
        if ($height != '')
            $tag .= ' height="' . $height . '"';
        if ($align != '')
            $tag .= ' align="' . $align . '"';
        if ($title != '') 
            $tag .= ' title="' . htmlspecialchars($title) . '"';

        return $tag . ' />';
    }
}

