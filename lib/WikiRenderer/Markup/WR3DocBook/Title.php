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
class Title extends \WikiRenderer\Block
{
    public $type = 'title';
    protected $regexp = "/^\s*(\!{1,3})(.*)/";
    protected $_closeNow = true;
    /**
     * Indique le sens dans lequel il faut interpreter le nombre de signe de titre.
     * true -> ! = titre , !! = sous titre, !!! = sous-sous-titre
     * false-> !!! = titre , !! = sous titre, ! = sous-sous-titre
     */
    protected $_order = false;

    public function getRenderedLine()
    {
        $level = strlen($this->_detectMatch[1]);
        if (!$this->_order)
            $level = 4 - $level;

        $conf = $this->engine->getConfig();

        $output = '';
        if (count($conf->sectionLevel)) {
            $last = end($conf->sectionLevel);
            if ($last > $level) {
                while ($last = end($conf->sectionLevel) && $last >= $level) {
                    $output .= '</section>';
                    array_pop($conf->sectionLevel);
                }
            } else if ($last < $level) {

            } else {
                array_pop($conf->sectionLevel);
                $output .= '</section>';
            }
        }

        $conf->sectionLevel[] = $level;
        return $output . '<section><title>' . $this->_renderInlineTag($this->_detectMatch[2]) . '</title>';
    }
}

