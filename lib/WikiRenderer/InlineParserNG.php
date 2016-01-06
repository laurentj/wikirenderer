<?php

/**
 * @author Laurent Jouanneau
 * @copyright 2003-2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public 2.1
 * License as published by the Free Software Foundation.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */

namespace WikiRenderer;

/**
 * The parser used to find all inline tag in a single line of text.
 */
class InlineParserNG extends InlineParser
{
    public function __construct(Config $config, \WikiRenderer\Generator\DocumentGeneratorInterface $generator)
    {
        $this->escapeChar = $config->escapeChar;
        $this->config = $config;

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
}