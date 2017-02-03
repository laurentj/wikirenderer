<?php

/**
 * Trac syntax.
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
 * Parser for a link.
 */
class LinkCreole extends \WikiRenderer\Tag
{
    protected $name = 'a';
    protected $generatorName = 'link';
    public $beginTag = '[[';
    public $endTag = ']]';
    protected $attribute = array('href', '$$');
    public $separators = array('|');

    /** @var \WikiRenderer\Markup\Trac\Config */
    protected $config = null;

    /**
     * @var \WikiRenderer\Generator\InlineComplexGeneratorInterface
     */
    protected $generator = null;

    public function getContent()
    {
        foreach ($this->config->macros as $macro) {
            if ($macro->match($this->wikiContentArr[0])) {
                return $macro->getContent($this->config, $this->documentGenerator, $this->wikiContentArr[0]);
            }
        }
        list($href, $label) = $this->config->getLinkProcessor()->processLink($this->wikiContentArr[0], $this->generatorName);
        if ($href == '') {
            if (preg_match('/^(=?)#(\\w+)$/', $this->wikiContentArr[0], $m)) {
                if ($m[1]) {
                    $content = $this->generator->getChildGenerators();
                    $this->generator = $this->documentGenerator->getInlineGenerator('anchor');
                    foreach ($content as $child) {
                        $this->generator->addContent($child);
                    }
                    $this->generator->setAttribute('anchor', $m[2]);
                } else {
                    $href = '#'.$m[2];
                }
            } elseif (strtolower($this->wikiContentArr[0]) == 'br') {
                return $this->documentGenerator->getInlineGenerator('linebreak');
            } else {
                $this->generator = $this->documentGenerator->getInlineGenerator('words');
                $this->generator->addRawContent($this->getWikiContent());

                return $this->generator;
            }
        }
        $this->wikiContentArr[0] = $href;
        if (!$this->separatorCount) {
            ++$this->separatorCount;
            $this->generator->setRawContent($label);
        }

        return parent::getContent();
    }
}
