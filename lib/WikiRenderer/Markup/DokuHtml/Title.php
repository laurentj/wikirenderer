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

/**
 * traite les signes de types titre
 */
class Title extends \WikiRenderer\Block
{
    public $type = 'title';
    protected $regexp = "/^\s*(\={1,6})([^=]*)(\={1,6})\s*$/";
    protected $_closeNow = true;

    public function getRenderedLine()
    {
        $level = strlen($this->_detectMatch[1]);
        $conf = $this->engine->getConfig();
        $output = '';
        if (count($conf->sectionLevel)) {
            $last = end($conf->sectionLevel);
            if ($last < $level) {
                while ($last = end($conf->sectionLevel) && $last <= $level) {
                    $output .= '</div>';
                    array_pop($conf->sectionLevel);
                }
            } else if($last > $level) {

            } else {
                array_pop($conf->sectionLevel);
                $output .= '</div>';
            }
        }
        $conf->sectionLevel[] = $level;
        $h = 6 - $level + $conf->startHeaderNumber;
        if ($h > 5)
            $h = 5;
        elseif ($h < 1)
            $h = 1;
        return $output . '<div><h' . $h . '>' . $this->_renderInlineTag(trim($this->_detectMatch[2])) . '</h' . $h . '>';
    }
}

