<?php

/**
 * word converter for wiki words
 *
 * @author Laurent Jouanneau
 * @copyright 2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer\Markup\Trac;
use \WikiRenderer\Generator\DocumentGeneratorInterface;

class WikiWordConverter extends \WikiRenderer\WordConverter\WikiWordConverter {

    protected $regexp = "/^(\W*)(\\!?)([A-Z]\p{Ll}+[A-Z0-9][\p{Ll}\p{Lu}0-9]*)(\W*)$/u";
    protected $wordRegexpIndex = 3;

    public function getContent(\WikiRenderer\Generator\DocumentGeneratorInterface $documentGenerator, $word) {
        $link = $documentGenerator->getInlineGenerator('link');
        $link->addRawContent($word);
        if ($this->url) {
            $link->setAttribute('href', sprintf($this->url, $this->matches[$this->wordRegexpIndex]));
        }
        else {
            $link->setAttribute('href', $word);
        }
        return $link;
    }
}
