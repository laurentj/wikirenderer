<?php

/**
 * word converter for wiki words.
 *
 * @author Laurent Jouanneau
 * @copyright 2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */
namespace WikiRenderer\WordConverter;

class WikiWordConverter extends AbstractWordConverter
{
    protected $regexp = "/^(\W*)([A-Z]\p{Ll}+[A-Z0-9][\p{Ll}\p{Lu}0-9]*)(\W*)$/u";

    /**
     * escape char.
     */
    protected $escapeChar = '\\';

    /**
     * @var string url
     */
    protected $url;

    /**
     * @param string $url should contain marker %s for sprintf()
     * @param string $escapeChar
     */
    public function __construct($url, $escapeChar = '\\')
    {
        $this->url = $url;
        $this->escapeChar = $escapeChar;
    }

    public function getContent(\WikiRenderer\Generator\DocumentGeneratorInterface $documentGenerator, $word)
    {
        if ($this->matches[1] == $this->escapeChar) {
            $words = $documentGenerator->getInlineGenerator('words');
            $words->addRawContent($this->matches[2].$this->matches[3]);

            return $words;
        }
        $link = $documentGenerator->getInlineGenerator('link');
        $link->addRawContent($word);
        if ($this->url) {
            $link->setAttribute('href', sprintf($this->url, $this->matches[2]));
        } else {
            $link->setAttribute('href', $word);
        }

        return $link;
    }
}
