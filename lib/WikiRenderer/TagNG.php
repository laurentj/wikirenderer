<?php

/**
 * @author Laurent Jouanneau
 *
 * @copyright 2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer;

/**
 * Base class for wiki inline tag, to generate XHTML element.
 */
abstract class TagNG extends Tag
{

    protected $generatorName = '';

    /**
     * @var \WikiRenderer\Generator\DocumentGeneratorInterface
     */
    protected $documentGenerator = null;

    protected $generator = null;

    public function __construct(Config $config, \WikiRenderer\Generator\DocumentGeneratorInterface $generator) {
        parent::__construct($config);
        $this->documentGenerator = $generator;
        $this->generator = $generator->getInlineGenerator($this->generatorName);
    }

    public function addContent($wikiContent, Generator\InlineGeneratorInterface $childGenerator = null)
    {
        $isMainContent = isset($this->attribute[$this->separatorCount]) &&
                            $this->attribute[$this->separatorCount] == '$$';
        $this->wikiContentArr[$this->separatorCount] .= $wikiContent;
        if ($isMainContent) {
            if ($childGenerator === null) {
                $parsedContent = $this->checkWikiWord($wikiContent);
                if (is_string($parsedContent)) {
                    $this->generator->addRawContent($parsedContent);
                }
                else {
                    $this->generator->addContent($parsedContent);
                }
            }
            else {
                $this->generator->addContent($childGenerator);
            }
        }
        else {
            $this->contents[$this->separatorCount] .= $wikiContent;
        }
    }

    /**
     * Return generators that will generate final content
     *
     * @return \WikiRenderer\Generator\InlineGeneratorInterface
     */
    public function getContent()
    {
        $attr = '';
        $cntattr = count($this->attribute);
        $count = ($this->separatorCount >= $cntattr) ? ($cntattr - 1) : $this->separatorCount;
        $content = '';

        for ($i = 0; $i <= $count; ++$i) {
            if ($this->attribute[$i] != '$$') {
                $this->generator->setAttribute($this->attribute[$i], $this->wikiContentArr[$i]);
            }
        }

        return $this->generator;
    }

    /**
     * Returns the generated content of the tag.
     *
     * @return string the content
     */
    public function getBogusContent()
    {
        $generator = $this->documentGenerator->getInlineGenerator('textline');
        $generator->addRawContent($this->beginTag);
        $m = count($this->contents) - 1;
        $s = count($this->separators);
        foreach ($this->contents as $k => $v) {
            if ($this->attribute[$k] == '$$') {
                foreach($this->generator->getChildGenerators() as $child) {
                    $generator->addContent($child);
                }
            }
            else {
                $generator->addRawContent($v);
            }
            if ($k < $m) {
                if ($k < $s) {
                    $generator->addRawContent( $this->separators[$k]);
                } else {
                    $generator->addRawContent(end($this->separators));
                }
            }
        }

        return $generator;
    }

    public function getAttributeValue($name) {
        $cntattr = count($this->attribute);
        $count = ($this->separatorCount >= $cntattr) ? ($cntattr - 1) : $this->separatorCount;

        for ($i = 0; $i <= $count; ++$i) {
            if ($this->attribute[$i] == $name) {
                return $this->wikiContentArr[$i];
            }
        }
        return null;
    }

    public function __clone() {
        $this->generator = clone $this->generator;
    }

    protected function _findWikiWord($string)
    {
        if ($this->checkWikiWordFunction === null) {
            return $string;
        }

        $matches = preg_split(
            "/(?:(?<=\b)|!)([A-Z]\p{Ll}+[A-Z0-9][\p{Ll}\p{Lu}0-9]*)/u",
            $string, -1, PREG_SPLIT_DELIM_CAPTURE);

        if (count($matches) == 1) {
            return $string;
        }
        $words = $this->documentGenerator->getInlineGenerator('words');
        foreach($matches as $k=>$word) {
            if ($k % 2) {
                $words->addGeneratedContent(call_user_func($this->checkWikiWordFunction, $word));
            }
            else {
                $words->addRawContent($word);
            }
        }
        return $words;
    }
}
