<?php
/**
 * wikirenderer3 syntax to plain text
 *
 * @package WikiRenderer
 * @subpackage wr3_to_text
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
namespace WikiRenderer\Markup\WR3Text;

/**
 * ???
 * @package	WikiRenderer
 * @subpackage	WR3Text
 */
class Config extends \WikiRenderer\Config
{
    public $defaultTextLineContainer = '\WikiRenderer\TextLine';
    public $textLineContainers = array(
        '\WikiRenderer\TextLine' => array(
            '\WikiRenderer\Markup\WR3Text\Strong',
            '\WikiRenderer\Markup\WR3Text\Em',
            '\WikiRenderer\Markup\WR3Text\Code',
            '\WikiRenderer\Markup\WR3Text\Q',
            '\WikiRenderer\Markup\WR3Text\Cite',
            '\WikiRenderer\Markup\WR3Text\Acronym',
            '\WikiRenderer\Markup\WR3Text\Link',
            '\WikiRenderer\Markup\WR3Text\Image',
            '\WikiRenderer\Markup\WR3Text\Anchor',
            '\WikiRenderer\Markup\WR3Text\Footnote'
        )
    );
    /** Liste des balises de type bloc reconnus par WikiRenderer. */
    public $blocktags = array(
        '\WikiRenderer\Markup\WR3Text\Title',
        '\WikiRenderer\Markup\WR3Text\List',
        '\WikiRenderer\Markup\WR3Text\Pre',
        '\WikiRenderer\Markup\WR3Text\Hr',
        '\WikiRenderer\Markup\WR3Text\Blockquote',
        '\WikiRenderer\Markup\WR3Text\Definition',
        '\WikiRenderer\Markup\WR3Text\Table',
        '\WikiRenderer\Markup\WR3Text\P'
    );
    public $simpletags = array('%%%' => "\n");
}

