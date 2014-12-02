<?php
/**
 * Markdown syntax to xhtml
 *
 * @author Laurent Jouanneau
 * @copyright 2014 Laurent Jouanneau
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
namespace WikiRenderer\Markup\MarkdownHtml;

class Config extends \WikiRenderer\Config
{
    public $defaultTextLineContainer = '\WikiRenderer\HtmlTextLine';
    public $textLineContainers = array(
        '\WikiRenderer\HtmlTextLine' => array(
        ),
        /*'\WikiRenderer\Markup\MarkdownHtml\TableRow' => array(
        )*/
    );

    /**
     * liste des balises de type bloc reconnus par WikiRenderer.
     */
    public $blocktags = array(
        /*'\WikiRenderer\Markup\MarkdownHtml\Title',
        '\WikiRenderer\Markup\MarkdownHtml\WikiList',
        '\WikiRenderer\Markup\MarkdownHtml\Blockquote',
        '\WikiRenderer\Markup\MarkdownHtml\Table',
        '\WikiRenderer\Markup\MarkdownHtml\Pre',
        '\WikiRenderer\Markup\MarkdownHtml\SyntaxHighlight',
        '\WikiRenderer\Markup\MarkdownHtml\File',
        '\WikiRenderer\Markup\MarkdownHtml\Nowiki',
        '\WikiRenderer\Markup\MarkdownHtml\Html',
        '\WikiRenderer\Markup\MarkdownHtml\Macro',*/
        '\WikiRenderer\Markup\MarkdownHtml\Para'
    );

    public $simpletags = array("\\\\"=>"");
    public $escapeChar = '';
    public $sectionLevel= array();

    /**
     * called before the parsing
     */
    public function onStart($texte)
    {
        $this->sectionLevel = array();
        return $texte;
    }

    /**
     * called after the parsing
     */
    public function onParse($finalTexte)
    {
        $finalTexte .= str_repeat('</div>', count($this->sectionLevel));
        return $finalTexte;
    }

    public function processLink($url, $tagName='')
    {
        $label = $url;
        if (strlen($label) > 40)
            $label = substr($label, 0, 40) . '(..)';
  
        if (strpos($url,'javascript:') !== false) // for security reason
            $url = '#';
        return array($url, $label);
    }
}

