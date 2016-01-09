<?php

/**
 * dokuwiki syntax to xhtml.
 *
 * @author Laurent Jouanneau
 * @copyright 2008-2012 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer\Markup\DokuHtml;

class Link extends \WikiRenderer\TagXhtml
{
    protected $name = 'a';
    public $beginTag = '[[';
    public $endTag = ']]';
    protected $attribute = array('href', '$$');
    public $separators = array('|');

    public function getContent()
    {
        $cntattr = count($this->attribute);
        $cnt = (($this->separatorCount + 1) > $cntattr) ? $cntattr : ($this->separatorCount + 1);
        list($href, $label) = $this->config->processLink($this->wikiContentArr[0], $this->name);
        if ($cnt == 1) {
            return '<a href="'.htmlspecialchars(trim($href)).'">'.htmlspecialchars($label).'</a>';
        }
        $this->wikiContentArr[0] = $href;

        return parent::getContent();
    }
}
