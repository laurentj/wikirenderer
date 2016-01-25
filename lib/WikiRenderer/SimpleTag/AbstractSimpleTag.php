<?php

/**
 * abstract class processing a simple tag
 *
 * @author Laurent Jouanneau
 * @copyright 2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer\SimpleTag;


abstract class AbstractSimpleTag {

    /**
     * the string to replace by a content.
     * @var string
     */
    protected $tag = null;

    /**
     * A sub pattern for a regexp, that match the string to replace by a content.
     *
     * @optional
     * @var string
     */
    protected $regexpSubPattern = null;

    /**
     * It returns a sub pattern for a regexp, so it returns $regexpSubPattern
     * or escaped $tag. This sub pattern is used into the main regexp of the
     * inline parser to detect all tags.
     * 
     * @return string a sub pattern for a regexp
     */
    public function getRegexpSubPattern() {
        if ($this->regexpSubPattern) {
            return $this->regexpSubPattern;
        }
        else {
            return preg_quote($this->tag, "/");
        }
    }

    /**
     * return all possible simple tags that the class support
     * @return string[]
     */
    function getPossibleTags() {
        return array($this->tag);
    }

    /**
     * @return \WikiRenderer\Generator\InlineGeneratorInterface
     */
    abstract public function getContent(\WikiRenderer\Generator\DocumentGeneratorInterface $documentGenerator);

}
