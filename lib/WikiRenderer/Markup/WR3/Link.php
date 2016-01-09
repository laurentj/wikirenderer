<?php

/**
 * wikirenderer3 (wr3) syntax
 *
 * @author Laurent Jouanneau
 * @copyright 2003-2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer\Markup\WR3;

/**
 * Parser for a link
 */
class Link extends \WikiRenderer\TagNG
{
    protected $name = 'a';
    protected $generatorName = 'link';
    public $beginTag = '[[';
    public $endTag = ']]';
    protected $attribute = array('$$', 'href', 'hreflang', 'title');
    public $separators = array('|');

    public function getContent()
    {
        $cntattr = count($this->attribute);
        $cnt = ($this->separatorCount + 1 > $cntattr) ? $cntattr : ($this->separatorCount + 1);
        if ($cnt == 1) {
            list($href, $label) = $this->config->processLink($this->wikiContentArr[0], $this->generatorName);
            $this->wikiContentArr[1] = $href;
            $this->separatorCount++;
            $this->generator->setRawContent($label);
        } else {
            list($href, $label) = $this->config->processLink($this->wikiContentArr[1], $this->generatorName);
            $this->wikiContentArr[1] = $href;
        }
        return parent::getContent();
    }
}
