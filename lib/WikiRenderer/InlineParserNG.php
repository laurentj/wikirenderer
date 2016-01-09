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
        foreach ($config->simpletags as $tag => $html) {
            $simpletagPattern .= '|('.preg_quote($tag, '/').')';
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
        $this->simpletags = $config->simpletags;
    }

    protected function _addSimpleTag($tag, $t) {
        $generator = $this->documentGenerator->getInlineGenerator('words');
        $generator->addGeneratedContent($this->simpletags[$t]);
        $tag->addContent($t, $generator);
    }
}