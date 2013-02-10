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

/**
 * traite les signes de types table
 */
class Table extends \WikiRenderer\Block
{
    public $type = 'table';
    protected $regexp = "/^\s*(\||\^)(.*)/";
    protected $_openTag = '<table>';
    protected $_closeTag = '</table>';
    protected $_colcount = 0;

    public function open()
    {
        $this->engine->getConfig()->defaultTextLineContainer = 'dkdbk_table_row';
        return $this->_openTag;
    }

    public function close()
    {
        $this->engine->getConfig()->defaultTextLineContainer = 'WikiXmlTextLine';
        return $this->_closeTag;
    }

    public function getRenderedLine()
    {
        return $this->engine->inlineParser->parse($this->_detectMatch[1] . $this->_detectMatch[2]);
    }

}

