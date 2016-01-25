<?php

/**
 * wikirenderer3 (wr3) syntax to xhtml.
 *
 * @author Laurent Jouanneau
 * @copyright 2003-2006 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer\Markup\WR3Html;

/**
 * ???
 */
class Config extends \WikiRenderer\Config
{
    public $defaultTextLineContainer = '\WikiRenderer\HtmlTextLine';
    public $textLineContainers = array(
        '\WikiRenderer\HtmlTextLine' => array(
            '\WikiRenderer\Markup\WR3Html\Strong',
            '\WikiRenderer\Markup\WR3Html\Em',
            '\WikiRenderer\Markup\WR3Html\Code',
            '\WikiRenderer\Markup\WR3Html\Q',
            '\WikiRenderer\Markup\WR3Html\Cite',
            '\WikiRenderer\Markup\WR3Html\Acronym',
            '\WikiRenderer\Markup\WR3Html\Link',
            '\WikiRenderer\Markup\WR3Html\Image',
            '\WikiRenderer\Markup\WR3Html\Anchor',
            '\WikiRenderer\Markup\WR3Html\Footnote',
        ),
    );
    /** Liste des balises de type bloc reconnus par WikiRenderer. */
    public $blocktags = array(
        '\WikiRenderer\Markup\WR3Html\Title',
        '\WikiRenderer\Markup\WR3Html\WikiList',
        '\WikiRenderer\Markup\WR3Html\Pre',
        '\WikiRenderer\Markup\WR3Html\Hr',
        '\WikiRenderer\Markup\WR3Html\Blockquote',
        '\WikiRenderer\Markup\WR3Html\Definition',
        '\WikiRenderer\Markup\WR3Html\Table',
        '\WikiRenderer\Markup\WR3Html\P',
    );
    public $simpleTags = array('%%%' => '<br />');

    // la syntaxe wr3 contient la possibilité de mettre des notes de bas de page
    // celles-ci seront stockées ici, avant leur incorporation é la fin du texte.
    public $footnotes = array();
    public $footnotesId = '';
    public $footnotesTemplate = '<div class="footnotes"><h4>Notes</h4>%s</div>';

    /**
     * Called before parsing.
     *
     * @param string $text ???
     *
     * @return string ???
     */
    public function onStart($text)
    {
        $this->footnotesId = rand(0, 30000);
        $this->footnotes = array(); // on remet é zero les footnotes
        return $text;
    }

    /**
     * Called after parsing.
     *
     * @param string $finalText ???
     *
     * @return string ???
     */
    public function onParse($finalText)
    {
        // on rajoute les notes de bas de pages.
        if (count($this->footnotes)) {
            $footnotes = implode("\n", $this->footnotes);
            $finalText .= str_replace('%s', $footnotes, $this->footnotesTemplate);
        }

        return $finalText;
    }

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
