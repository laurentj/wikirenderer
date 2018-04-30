<?php
/**
 * Markdown (CommonMark) syntax.
 *
 * @author Laurent Jouanneau
 * @copyright 2018 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */
namespace WikiRenderer\Markup\Markdown;

/**
 * Parser for a link.
 */
class Link extends \WikiRenderer\InlineTag
{
    protected $name = 'a';
    protected $generatorName = 'link';
    protected $beginTag = '[';
    protected $endTag = '';

    const PART_LABEL = 0;
    const PART_LINK = 1;

    protected $currentPart = 0;

    protected $link = '';

    public function getPatterns()
    {
        $patterns = array();
        $patterns[] = preg_quote($this->beginTag, '/');
        $patterns[] = '\]\s*\(';
        $patterns[] = preg_quote(']', '/');
        $patterns[] = preg_quote(')', '/');
        return $patterns;
    }

    public function isSupportedToken($tag) {
        if ($this->currentPart == self::PART_LABEL) {
            if ($tag == ']' ) {
                // this is a link reference
                return self::END_TOKEN;
            }
    
            if (preg_match("/^\]\s*\($/m", $tag)) {
                $this->currentPart = self::PART_LINK;
                $this->addContentString($tag);
                return self::INTERMEDIATE_TOKEN;
            }
        }
        else if ($this->currentPart == self::PART_LINK) {
            if ($tag == ')' ) {
                return self::END_TOKEN;
            }
        }
        return false;
    }

    public function getContent()
    {
        if ($this->currentPart == self::PART_LABEL) {
            // no link: we should retrieve the link with the given reference
            $href = null;
            $title = '';
            $linkRefs = $this->documentGenerator->getMetaData('linkRefs');
            if ($linkRefs !== null) {
                if (class_exists('Transliterator',false)) {
                    $tl = \Transliterator::create("Lower()");
                    $label = $tl->transliterate($this->wikiContent);
                }
                else {
                    $label = \strtolower($this->wikiContent);
                }
                if (isset($linkRefs[$label])) {
                    list($href, $title) = $linkRefs[$label];
                }
            }
            if ($href === null) {
                $words = $this->documentGenerator->getInlineGenerator('words');
                $words->addRawContent('['.$this->wikiContent.']');
                return $words;
            }
            else {
                list($href, $label) = $this->config->getLinkProcessor()->processLink($href, $this->generatorName);
                $this->generator->setRawContent($this->wikiContent);
            }
            
        }
        else {
            if ($this->link == '') {
                $words = $this->documentGenerator->getInlineGenerator('words');
                $words->addRawContent('['.$this->wikiContent.']()');
                return $words;
            }
            else {
                list($href, $label) = $this->config->getLinkProcessor()->processLink($this->link, $this->generatorName);
            }
        }

        $this->generator->setAttribute('href', $href);
        if ($title) {
            $this->generator->setAttribute('title', $title);
        }

        return $this->generator;
    }


    public function addContentString($wikiContent)
    {
        $this->wikiContent .= $wikiContent;
        if ($this->currentPart == self::PART_LABEL) {
            $parsedContent = $this->convertWords($wikiContent);
            $this->generator->addContent($parsedContent);
        }
        else {
            $this->link .= $wikiContent;
        }
    }


    public function addContentGenerator($wikiContent, \WikiRenderer\Generator\InlineGeneratorInterface $childGenerator)
    {
        $this->wikiContent .= $wikiContent;
        if ($this->currentPart == self::PART_LABEL) {
            $this->generator->addContent($childGenerator);
        }
    }


    public function isOtherTagAllowed()
    {
        return false;
        //return ($this->currentPart == self::PART_LABEL);
    }
}
