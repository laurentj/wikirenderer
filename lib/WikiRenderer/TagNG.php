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

    protected $convertWordsIn = array('$$');
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
                $parsedContent = $this->convertWords($wikiContent);
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

    protected function convertWords($wikiContent) {
        if (count($this->convertWordsIn)
            && isset($this->attribute[$this->separatorCount])
            && in_array($this->attribute[$this->separatorCount], $this->convertWordsIn)
            && count($this->config->wordConverters)) {

            $matches = preg_split( "/(\s+)/u",
                $wikiContent, -1, PREG_SPLIT_DELIM_CAPTURE);

            $text = $this->documentGenerator->getInlineGenerator('textline');
            foreach($matches as $k=>$word) {
                if (!($k % 2)) {
                    $ok = false;
                    foreach($this->config->wordConverters as $converter) {
                        if ($converter->isMatching($word)) {
                            $ok = true;
                            $text->addContent($converter->getContent($this->documentGenerator, $word));
                            break;
                        }
                    }
                    if (!$ok) {
                        $text->addRawContent($word);
                    }
                }
                else {
                    $text->addRawContent($word);
                }

            }
            return $text;
        }
        return $wikiContent;
    }
}
