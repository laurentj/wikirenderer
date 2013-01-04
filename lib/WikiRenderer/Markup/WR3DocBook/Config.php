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
class Config extends \WikiRenderer\Config
{
    public $defaultTextLineContainer = '\WikiRenderer\HtmlTextLine';
    public $textLineContainers = array(
        '\WikiRenderer\HtmlTextLine' => array(
            '\WikiRenderer\Markup\WR3DocBook\Strong',
            '\WikiRenderer\Markup\WR3DocBook\Em',
            '\WikiRenderer\Markup\WR3DocBook\Code',
            '\WikiRenderer\Markup\WR3DocBook\Q',
            '\WikiRenderer\Markup\WR3DocBook\Cite',
            '\WikiRenderer\Markup\WR3DocBook\Acronym',
            '\WikiRenderer\Markup\WR3DocBook\Link',
            '\WikiRenderer\Markup\WR3DocBook\Image',
            '\WikiRenderer\Markup\WR3DocBook\Anchor',
            '\WikiRenderer\Markup\WR3DocBook\Footnote'
        )
    );
    /** Liste des balises de type bloc reconnus par WikiRenderer. */
    public $blocktags = array(
        '\WikiRenderer\Markup\WR3DocBook\Title',
        '\WikiRenderer\Markup\WR3DocBook\WikiList',
        '\WikiRenderer\Markup\WR3DocBook\Pre',
        '\WikiRenderer\Markup\WR3DocBook\Hr',
        '\WikiRenderer\Markup\WR3DocBook\Blockquote',
        '\WikiRenderer\Markup\WR3DocBook\Definition',
        '\WikiRenderer\Markup\WR3DocBook\Table',
        '\WikiRenderer\Markup\WR3DocBook\P'
    );
    public $simpletags = array('%%%' => '<br />');
    public $sectionLevel= array();

    /**
     * Called before the parsing.
     * @param   string  $text   ???
     * @return  string  ???
     */
    public function onStart($text)
    {
        $this->sectionLevel = array();
        return $text;
    }

    /**
     * Called after the parsing.
     * @param   string  $finalText  ???
     * @return  string  ???
     */
    public function onParse($finalText)
    {
        $finalText .= str_repeat('</section>', count($this->sectionLevel));
        return $finalText;
    }
}

