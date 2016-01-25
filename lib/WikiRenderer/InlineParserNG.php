<?php

/**
 * @author Laurent Jouanneau
 * @copyright 2003-2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer;

/**
 * The parser used to find all inline tag in a single line of text.
 */
class InlineParserNG extends InlineParser
{

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
            $this->allSimpleTags = array_merge($this->allSimpleTags,
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
            $separators = $c->tag->separators;

            $tagList = array();
            foreach ($tags as $tag) {
                $t = new $tag($config, $generator);
                $c->allowedTags[$t->beginTag] = $t;
                $c->pattern .= '|('.preg_quote($t->beginTag, '/').')';
                if ($t->beginTag != $t->endTag) {
                    $c->pattern .= '|('.preg_quote($t->endTag, '/').')';
                }
                $separators = array_merge($separators, $t->separators);
            }
            $separators = array_unique($separators);
            foreach ($separators as $sep) {
                $c->pattern .= '|('.preg_quote($sep, '/').')';
            }
            $c->pattern .= $simpletagPattern.$escapePattern;
            $c->pattern = '/'.substr($c->pattern, 1).'/';

            $this->textLineContainers[$class] = $c;
        }
    }

    /**
     * Parser's core function.
     *
     * @param ??? $tag      ???
     * @param ??? $posstart ???
     *
     * @return int new position
     */
    protected function _parse($tag, $posstart)
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
                    $tag->addContent($this->escapeChar);
                    if ($this->config->outputEscapeChar) {
                        $tag->addContent($this->escapeChar);
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
                if ($tag->endTag == $t && !$tag->isTextLineTag) {
                    return $i;
                } elseif (!$tag->isOtherTagAllowed()) {
                    $tag->addContent($t);
                }
                // is there a tag which begin something ?
                elseif (isset($this->currentTextLineContainer->allowedTags[$t])) {
                    $newtag = clone $this->currentTextLineContainer->allowedTags[$t];
                    $i = $this->_parse($newtag, $i);
                    if ($i !== false) {
                        $tag->addContent($newtag->getWikiContent(), $newtag->getContent());
                    } else {
                        $i = $this->end;
                        $tag->addContent($newtag->getWikiContent(), $newtag->getBogusContent());
                    }
                }
                // is there a simple tag ?
                elseif (isset($this->allSimpleTags[$t])) {
                    $tag->addContent($t, $this->allSimpleTags[$t]->getContent($this->documentGenerator));
                } else {
                    $tag->addContent($t);
                }
            // previous token prevents us to process the current token, and
            // indicated to ignore it, so let's ignore it.
            } else {
                if (!$this->config->outputEscapeChar &&
                    (isset($this->currentTextLineContainer->allowedTags[$t]) ||
                    isset($this->allSimpleTags[$t]) ||
                    $tag->endTag == $t)) {
                    $tag->addContent($t);
                } else {
                    $tag->addContent($this->escapeChar.$t);
                }
                $checkNextTag = true;
            }
        }
        if (!$tag->isTextLineTag) {
            //we didn't find the ended tag, error
            $this->error = true;
            return false;
        } else {
            return $this->end;
        }
    }
}
