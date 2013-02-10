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

class Config extends \WikiRenderer\Config
{
    public $defaultTextLineContainer = '\WikiRenderer\HtmlTextLine';
    public $textLineContainers = array(
        '\WikiRenderer\HtmlTextLine' => array(
            '\WikiRenderer\Markup\DokuHtml\Strong',
            '\WikiRenderer\Markup\DokuHtml\Emphasis',
            '\WikiRenderer\Markup\DokuHtml\Underlined',
            '\WikiRenderer\Markup\DokuHtml\Monospaced',
            '\WikiRenderer\Markup\DokuHtml\Subscript',
            '\WikiRenderer\Markup\DokuHtml\Superscript',
            '\WikiRenderer\Markup\DokuHtml\Del',
            '\WikiRenderer\Markup\DokuHtml\Link',
            '\WikiRenderer\Markup\DokuHtml\Footnote',
            '\WikiRenderer\Markup\DokuHtml\Image',
            '\WikiRenderer\Markup\DokuHtml\NowikiInline'
        ),
        '\WikiRenderer\Markup\DokuHtml\TableRow' => array(
            '\WikiRenderer\Markup\DokuHtml\Strong',
            '\WikiRenderer\Markup\DokuHtml\Emphasis',
            '\WikiRenderer\Markup\DokuHtml\Underlined',
            '\WikiRenderer\Markup\DokuHtml\Monospaced',
            '\WikiRenderer\Markup\DokuHtml\Subscript',
            '\WikiRenderer\Markup\DokuHtml\Superscript',
            '\WikiRenderer\Markup\DokuHtml\Del',
            '\WikiRenderer\Markup\DokuHtml\Link',
            '\WikiRenderer\Markup\DokuHtml\Footnote',
            '\WikiRenderer\Markup\DokuHtml\Image',
            '\WikiRenderer\Markup\DokuHtml\NowikiInline'
        )
    );

    /**
     * liste des balises de type bloc reconnus par WikiRenderer.
     */
    public $blocktags = array(
        '\WikiRenderer\Markup\DokuHtml\Title',
        '\WikiRenderer\Markup\DokuHtml\WikiList',
        '\WikiRenderer\Markup\DokuHtml\Blockquote',
        '\WikiRenderer\Markup\DokuHtml\Table',
        '\WikiRenderer\Markup\DokuHtml\Pre',
        '\WikiRenderer\Markup\DokuHtml\SyntaxHighlight',
        '\WikiRenderer\Markup\DokuHtml\File',
        '\WikiRenderer\Markup\DokuHtml\Nowiki',
        '\WikiRenderer\Markup\DokuHtml\Html',
        '\WikiRenderer\Markup\DokuHtml\Php',
        '\WikiRenderer\Markup\DokuHtml\Para',
        '\WikiRenderer\Markup\DokuHtml\Macro'
    );

    public $simpletags = array("\\\\"=>"");
    public $escapeChar = '';
    public $sectionLevel= array();
    public $footnotes = array();
    public $footnotesId = '';
    public $footnotesTemplate = '<div class="footnotes"><h4>Notes</h4>%s</div>';
    public $startHeaderNumber = 1; // top level header will be <h1> if you set to 1, <h2> if it is 2 etc..

    /**
     * called before the parsing
     */
    public function onStart($texte)
    {
        $this->sectionLevel = array();
        $this->footnotesId = rand(0,30000);
        $this->footnotes = array();
        return $texte;
    }

    /**
     * called after the parsing
     */
    public function onParse($finalTexte)
    {
        $finalTexte .= str_repeat('</div>', count($this->sectionLevel));
        if (count($this->footnotes)) {
            $footnotes = implode("\n",$this->footnotes);
            $finalTexte .= str_replace('%s', $footnotes, $this->footnotesTemplate);
        }
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

