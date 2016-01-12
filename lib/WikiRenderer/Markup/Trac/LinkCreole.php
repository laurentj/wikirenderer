<?php

/**
 * Trac syntax
 *
 * @author Laurent Jouanneau
 * @copyright 2006-2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer\Markup\Trac;

/**
 * Parser for a link
 */
class LinkCreole extends \WikiRenderer\TagNG
{
    protected $name = 'a';
    protected $generatorName = 'link';
    public $beginTag = '[[';
    public $endTag = ']]';
    protected $attribute = array('href', '$$');
    public $separators = array('|');

    public function getContent()
    {
        list($href, $label) = $this->config->processLink($this->wikiContentArr[0], $this->generatorName);
        if ($href == '') {
            if (preg_match("/^(=?)#(\\w+)$/", $this->wikiContentArr[0], $m)) {
                if ($m[1]) {
                    $content = $this->generator->getChildGenerators();
                    $this->generator =  $this->documentGenerator->getInlineGenerator('anchor');
                    foreach($content as $child) {
                        $this->generator->addContent($child);
                    }
                    $this->generator->setAttribute('anchor', $m[2]);
                }
                else {
                    $href = '#'.$m[2];
                }
            }
        }
        $this->wikiContentArr[0] = $href;
        if (!$this->separatorCount) {
            $this->separatorCount++;
            $this->generator->setRawContent($label);
        }
        return parent::getContent();
    }
}
