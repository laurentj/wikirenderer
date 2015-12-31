<?php

/**
 * classic wikirenderer syntax to xhtml.
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

namespace WikiRenderer\Markup\WRHtml;

class Config extends \WikiRenderer\Config
{
    public $defaultTextLineContainer = '\WikiRenderer\HtmlTextLine';

    public $textLineContainers = array(
            '\WikiRenderer\HtmlTextLine' => array(
                '\WikiRenderer\Markup\WR3Html\Strong',
                '\WikiRenderer\Markup\WR3Html\Em',
                '\WikiRenderer\Markup\WRHtml\Code',
                '\WikiRenderer\Markup\WR3Html\Q',
                '\WikiRenderer\Markup\WR3Html\Cite',
                '\WikiRenderer\Markup\WR3Html\Acronym',
                '\WikiRenderer\Markup\WRHtml\Link',
                '\WikiRenderer\Markup\WR3Html\Image',
                '\WikiRenderer\Markup\WR3Html\Anchor',
            ),
        );

   /**
    * liste des balises de type bloc reconnus par WikiRenderer.
    */
   public $blocktags = array(
        '\WikiRenderer\Markup\WRHtml\Title',
        '\WikiRenderer\Markup\WRHtml\WikiList',
        '\WikiRenderer\Markup\WRHtml\Pre',
        '\WikiRenderer\Markup\WRHtml\Hr',
        '\WikiRenderer\Markup\WRHtml\Blockquote',
        '\WikiRenderer\Markup\WRHtml\Definition',
        '\WikiRenderer\Markup\WRHtml\Table',
        '\WikiRenderer\Markup\WRHtml\P', );

    public $simpletags = array('%%%' => '<br />', ':-)' => '<img src="laugh.png" alt=":-)" />');

    public function processLink($url, $tagName = '')
    {
        $label = $url;
        if (strlen($label) > 40) {
            $label = substr($label, 0, 40).'(..)';
        }
        if (strpos($url, 'javascript:') !== false) { // for security reason
         $url = '#';
        }

        return array($url, $label);
    }
}
