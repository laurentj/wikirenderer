<?php

/**
 * DokuWiki syntax
 *
 * @author Laurent Jouanneau
 * @copyright 2008-2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer\Markup\DokuWiki;

/**
 * Parser for a link
 */
class Link extends \WikiRenderer\Tag
{
    protected $name = 'a';
    protected $generatorName = 'link';
    public $beginTag = '[[';
    public $endTag = ']]';
    protected $attribute = array('href', '$$');
    public $separators = array('|');

    public function getContent()
    {
        $cntattr = count($this->attribute);
        $cnt = ($this->separatorCount + 1 > $cntattr) ? $cntattr : ($this->separatorCount + 1);
        list($href, $label) = $this->config->getLinkProcessor()->processLink($this->wikiContentArr[0], $this->generatorName);
        $this->wikiContentArr[0] = $href;

        if ($cnt == 1) {
            $this->separatorCount++;
            $this->wikiContentArr[1] = '';
            $this->generator->setRawContent($label);
        }
        return parent::getContent();
    }
}
