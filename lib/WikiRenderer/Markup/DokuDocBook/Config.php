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

class Config extends \WikiRenderer\Config
{
    public $defaultTextLineContainer = '\WikiRenderer\XmlTextLine';
    public $textLineContainers = array(
        '\WikiRenderer\XmlTextLine' => array(
            '\WikiRenderer\Markup\DokuDocBook\Strong',
            '\WikiRenderer\Markup\DokuDocBook\Emphasis',
            '\WikiRenderer\Markup\DokuDocBook\Underlined',
            '\WikiRenderer\Markup\DokuDocBook\Monospaced',
            '\WikiRenderer\Markup\DokuDocBook\Subscript',
            '\WikiRenderer\Markup\DokuDocBook\Superscript',
            '\WikiRenderer\Markup\DokuDocBook\Del',
            '\WikiRenderer\Markup\DokuDocBook\Link',
            '\WikiRenderer\Markup\DokuDocBook\Footnote',
            '\WikiRenderer\Markup\DokuDocBook\Image',
            '\WikiRenderer\Markup\DokuDocBook\NoWikiInline',
        ),
        '\WikiRenderer\Markup\DokuDocBook\TableRow' => array(
            '\WikiRenderer\Markup\DokuDocBook\Strong',
            '\WikiRenderer\Markup\DokuDocBook\Emphasis',
            '\WikiRenderer\Markup\DokuDocBook\Underlined',
            '\WikiRenderer\Markup\DokuDocBook\Monospaced',
            '\WikiRenderer\Markup\DokuDocBook\Subscript',
            '\WikiRenderer\Markup\DokuDocBook\Superscript',
            '\WikiRenderer\Markup\DokuDocBook\Del',
            '\WikiRenderer\Markup\DokuDocBook\Link',
            '\WikiRenderer\Markup\DokuDocBook\Footnote',
            '\WikiRenderer\Markup\DokuDocBook\Image',
            '\WikiRenderer\Markup\DokuDocBook\NoWikiInline',
        )
    );

    /** liste des balises de type bloc reconnus par WikiRenderer. */
    public $blocktags = array(
        '\WikiRenderer\Markup\DokuDocBook\Title',
        '\WikiRenderer\Markup\DokuDocBook\WikiList',
        '\WikiRenderer\Markup\DokuDocBook\Blockquote',
        '\WikiRenderer\Markup\DokuDocBook\Table',
        '\WikiRenderer\Markup\DokuDocBook\Pre',
        '\WikiRenderer\Markup\DokuDocBook\SyntaxHighlight',
        '\WikiRenderer\Markup\DokuDocBook\File',
        '\WikiRenderer\Markup\DokuDocBook\NoWiki',
        '\WikiRenderer\Markup\DokuDocBook\Html',
        '\WikiRenderer\Markup\DokuDocBook\Php',
        '\WikiRenderer\Markup\DokuDocBook\Para',
        '\WikiRenderer\Markup\DokuDocBook\Macro'
    );
    public $simpletags = array("\\\\" => '');
    public $escapeChar = '';
    public $sectionLevel = array();

    /**
     * called before the parsing
     */
    public function onStart($text)
    {
        $this->sectionLevel = array();
        return $text;
    }

    /**
     * called after the parsing
     */
    public function onParse($finalText)
    {
        $finalText .= str_repeat('</section>', count($this->sectionLevel));
        return $finalText;
    }

    public function getSectionId($title)
    {
        return '';
    }

    public function processLink($url, $tagName = '')
    {
        $label = $url;
        if (strlen($label) > 40)
            $label = substr($label, 0, 40) . '(..)';
        if (strpos($url, 'javascript:') !== false) // for security reason
            $url = '#';
        return array($url, $label);
    }
}

