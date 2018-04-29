<?php

/**
 * Wikirenderer is a wiki text parser. It can transform a wiki text into xhtml or other formats.
 *
 * @author Laurent Jouanneau
 * @copyright 2003-2018 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */
namespace WikiRenderer;

/**
 * The parser used to find all inline tag in a single line of text.
 */
class InlineParser
{
    /** @var bool indicate if an error has been found during the parsing */
    public $error = false;

    /** list of simple tags (copy of ccongi */
    protected $simpletags = array();

    /**
     * the current parsed line, splited into chuncked and tokens.
     *
     * @var string[]
     */
    protected $str = array();

    /**
     * count of parts into the string.
     *
     * @var int
     */
    protected $end = 0;

    /** @var \WikiRenderer\Config  */
    protected $config;

    /** @var  TextLineContainer[]   key is class name of the TextLine */
    protected $textLineContainers = array();

    /** @var TextLineContainer */
    protected $currentTextLineContainer = null;

    /** @var string escape character */
    protected $escapeChar = '';

    protected $allSimpleTags = array();

    /**
     * @var \WikiRenderer\Generator\DocumentGeneratorInterface
     */
    protected $documentGenerator = null;

    public function __construct(Config $config, \WikiRenderer\Generator\DocumentGeneratorInterface $generator)
    {
        $this->escapeChar = $config->escapeChar;
        $this->config = $config;
        $this->documentGenerator = $generator;

        // let's construct the regexp that will find all tokens on the line

        // first all basic tags
        $simpletagPattern = '';
        foreach ($config->simpleTags as $tagParser) {
            $simpletagPattern .= '|('.$tagParser->getRegexpSubPattern().')';
            $ar = $tagParser->getPossibleTags();
            $this->allSimpleTags = array_merge(
                        $this->allSimpleTags,
                        array_combine($ar,
                                      array_fill(0, count($ar), $tagParser)));
        }

        // the pattern that matches the escape character
        $escapePattern = '';
        if ($this->escapeChar != '') {
            $escapePattern = '|('.preg_quote($this->escapeChar, '/').')';
        }

        // now let's construct patterns corresponding to all different
        // kind of lines
        foreach ($config->textLineContainers as $class => $tags) {
            $c = new TextLineContainer();
            $c->tag = new $class($config, $generator);
            $separators = $c->tag->getSeparatorsPatterns();

            foreach ($tags as $tag) {
                $t = new $tag($config, $generator);
                $c->allowedTags[$t->getBeginTag()] = $t;
                $c->pattern .= '|('.$t->getBeginPattern().')';
                if ($t->getBeginTag() != $t->getEndTag()) {
                    $c->pattern .= '|('.$t->getEndPattern().')';
                }
                $separators = array_merge($separators, $t->getSeparatorsPatterns());
            }
            $separators = array_unique($separators);
            foreach ($separators as $sep) {
                $c->pattern .= '|('.$sep.')';
            }
            $c->pattern .= $simpletagPattern.$escapePattern;
            $c->pattern = '/'.substr($c->pattern, 1).'/';

            $this->textLineContainers[$class] = $c;
        }
    }

    /**
     * Main function which parses a line of wiki content.
     *
     * @param string $line a string containing wiki content, but without line feeds
     *
     * @return \WikiRenderer\Generator\InlineGeneratorInterface the line transformed to the target content
     */
    public function parse($line)
    {
        $this->error = false;
        $this->currentTextLineContainer = $this->textLineContainers[$this->config->defaultTextLineContainer];
        $firsttag = clone ($this->currentTextLineContainer->tag);

        $this->str = preg_split($this->currentTextLineContainer->pattern, $line, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
        $this->end = count($this->str);

        if ($this->end > 1) {
            $pos = -1;
            $this->_parse($firsttag, $pos);

            return $firsttag->getContent();
        } else {
            $firsttag->addContentString($line);

            return $firsttag->getContent();
        }
    }

    /**
     * Parser's core function.
     *
     * @param \WikiRenderer\InlineTag $tag      ???
     * @param int               $posstart ???
     *
     * @return int new position
     */
    protected function _parse(\WikiRenderer\InlineTag $tag, $posstart)
    {
        $checkNextTag = true;

        // we analyse each part of the string,
        for ($i = $posstart + 1; $i < $this->end; ++$i) {
            $t = &$this->str[$i];

            // is it the escape char ?
            if ($this->escapeChar != '' && $t === $this->escapeChar) {
                if ($checkNextTag) {
                    $t = ''; // yes -> let's ignore the tag
                    $checkNextTag = false;
                } else {
                    // if we are here, this is because the previous part was the escape char
                    $tag->addContentString($this->escapeChar);
                    if ($this->config->outputDoubleEscapeChar) {
                        $tag->addContentString($this->escapeChar);
                    }
                    $checkNextTag = true;
                }

            // is this a separator ?
            } elseif ($tag->isCurrentSeparator($t)) {
                $tag->addSeparator($t);
            // no separator, no escape char, and previous token allowed us to
            // take care of the current token, so let's processing it
            } elseif ($checkNextTag) {
                // is there a ended tag
                if ($tag->getEndTag() == $t && !$tag->isLineContainer()) {
                    return $i;
                } elseif (!$tag->isOtherTagAllowed()) {
                    $tag->addContentString($t);
                }
                // is there a tag which begin something ?
                elseif (isset($this->currentTextLineContainer->allowedTags[$t])) {
                    $newtag = clone $this->currentTextLineContainer->allowedTags[$t];
                    $i = $this->_parse($newtag, $i);
                    if ($i !== false) {
                        $tag->addContentGenerator($newtag->getWikiContent(), $newtag->getContent());
                    } else {
                        $i = $this->end;
                        $tag->addContentGenerator($newtag->getWikiContent(), $newtag->getBogusContent());
                    }
                }
                // is there a simple tag ?
                elseif (isset($this->allSimpleTags[$t])) {
                    $tag->addContentGenerator($t, $this->allSimpleTags[$t]->getContent($this->documentGenerator, $t));
                } else {
                    $tag->addContentString($t);
                }
            // previous token prevents us to process the current token, and
            // indicated to ignore it, so let's ignore it.
            } else {
                if (isset($this->currentTextLineContainer->allowedTags[$t]) ||
                    isset($this->allSimpleTags[$t]) ||
                    $tag->getEndTag() == $t
                ) {
                    if ($this->config->outputEscapeCharForTags) {
                        $tag->addContentString($this->escapeChar . $t);
                    } else {
                        $tag->addContentString($t);
                    }
                } else {
                    if ($this->config->outputEscapeChar) {
                        $tag->addContentString($this->escapeChar . $t);
                    } else {
                        $tag->addContentString($t);
                    }
                }
                $checkNextTag = true;
            }
        }

        if (!$checkNextTag && ($this->config->outputEscapeChar||$this->config->outputEscapeCharAtEOL)) {
            $tag->addContentString($this->escapeChar);
        }
        if (!$tag->isLineContainer()) {
            //we didn't find the ended tag, error
            $this->error = true;

            return false;
        } else {
            return $this->end;
        }
    }
}
