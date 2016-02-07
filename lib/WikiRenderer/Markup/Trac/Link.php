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
class Link extends LinkCreole
{
    protected $name = 'a';
    protected $generatorName = 'link';
    public $beginTag = '[';
    public $endTag = ']';
    protected $attribute = array('href', '$$');
    public $separators = array();

    protected $inLabel = false;

    public function addContent($wikiContent, Generator\InlineGeneratorInterface $childGenerator = null)
    {
        if (!$this->inLabel) {
            $items = preg_split("/(\\s+)/", $wikiContent, 2, PREG_SPLIT_DELIM_CAPTURE);
            $this->wikiContentArr[0] .= $items[0];

            if (count($items) < 2) {
                return;
            }
            
            $this->inLabel = true;
            $this->wikiContent .= $this->wikiContentArr[0].$items[1];
            ++$this->separatorCount;
            $this->wikiContentArr[$this->separatorCount] = '';
            $this->contents[$this->separatorCount] = '';

            if ($items[2] === '') {
                return;
            }
            $wikiContent = $items[2];
        }
        $this->wikiContentArr[$this->separatorCount] .= $wikiContent;

        if ($childGenerator === null) {
            $parsedContent = $this->convertWords($wikiContent);
            $this->generator->addContent($parsedContent);
        }
        else {
            $this->generator->addContent($childGenerator);
        }
    }

    public function isOtherTagAllowed()
    {
        return $this->inLabel;
    }
}
