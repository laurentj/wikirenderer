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
class Link extends \WikiRenderer\TagXhtml
{
    protected $name = 'a';
    public $beginTag = '[[';
    public $endTag = ']]';
    protected $attribute = array('$$', 'href', 'hreflang', 'title');
    public $separators = array('|');

    public function getContent()
    {
        $cntattr = count($this->attribute);
        $cnt = ($this->separatorCount + 1 > $cntattr) ? $cntattr : ($this->separatorCount + 1);
        if ($cnt == 1) {
            list($href, $label) = $this->config->processLink($this->wikiContentArr[0], $this->name);

            return '<a href="'.htmlspecialchars($href).'">'.htmlspecialchars($label).'</a>';
        } else {
            list($href, $label) = $this->config->processLink($this->wikiContentArr[1], $this->name);
            $this->wikiContentArr[1] = $href;

            return parent::getContent();
        }
    }
}
