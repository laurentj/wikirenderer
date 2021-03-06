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
use \WikiRenderer\Generator\InlineGeneratorInterface;

/**
 * Parser for a link.
 */
class Link extends LinkCreole
{
    protected $name = 'a';
    protected $generatorName = 'link';
    protected $beginTag = '[';
    protected $endTag = ']';
    protected $attribute = array('href', '$$');
    protected $separators = array();

    protected $inLabel = false;

    protected function _addWikiContent($wikiContent) {
        if (!$this->inLabel) {
            $items = preg_split('/(\\s+)/', $wikiContent, 2, PREG_SPLIT_DELIM_CAPTURE);
            $this->wikiContentArr[0] .= $items[0];

            if (count($items) < 2) {
                return false;
            }

            $this->inLabel = true;
            $this->wikiContent .= $this->wikiContentArr[0].$items[1];
            ++$this->separatorCount;
            $this->wikiContentArr[$this->separatorCount] = '';
            $this->contents[$this->separatorCount] = '';

            if ($items[2] === '') {
                return false;
            }
            $wikiContent = $items[2];
        }
        $this->wikiContentArr[$this->separatorCount] .= $wikiContent;
        return $wikiContent;
    }

    public function addContentString($wikiContent)
    {
        $wikiContent = $this->_addWikiContent($wikiContent);
        if ($wikiContent === false) {
            return;
        }

        $parsedContent = $this->convertWords($wikiContent);
        $this->generator->addContent($parsedContent);
    }

    public function addContentGenerator($wikiContent, InlineGeneratorInterface $childGenerator)
    {
        $wikiContent = $this->_addWikiContent($wikiContent);
        if ($wikiContent === false) {
            return;
        }

        $this->generator->addContent($childGenerator);
    }

    public function isOtherTagAllowed()
    {
        return $this->inLabel;
    }
}
