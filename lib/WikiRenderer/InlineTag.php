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
 * Base class to generate output from inline wiki tag.
 * These objects are driven by the wiki inline parser.
 *
 * @see \WikiRenderer\InlineParser
 */
abstract class InlineTag
{
    /** @var string a name for the tag. Can be used to generate the output content */
    protected $name = '';

    /**
     * @var string generator type name
     */
    protected $generatorName = '';

    /**  @var string characters that defines the start of the tag */
    protected $beginTag = '';

    /**  @var string characters that defines the end of the tag */
    protected $endTag = '';

    /**
     * indicates if the tag object represent an entire line or not.
     * if true, beginTag and endTag are ignored.
     *
     * @var bool
     */
    protected $isTextLineTag = false;

    /** Wiki content of the full tag. */
    protected $wikiContent = '';

    /** @var \WikiRenderer\Config */
    protected $config = null;

    /**
     * @var \WikiRenderer\Generator\DocumentGeneratorInterface
     */
    protected $documentGenerator = null;

    /**
     * @var \WikiRenderer\Generator\InlineGeneratorInterface
     */
    protected $generator = null;

    /**
     * Constructor.
     *
     * @param \WikiRenderer\Config $config Configuration object.
     * @param Generator\DocumentGeneratorInterface $generator
     */
    public function __construct(Config $config, \WikiRenderer\Generator\DocumentGeneratorInterface $generator)
    {
        $this->config = $config;
        $this->documentGenerator = $generator;
        $this->generator = $generator->getInlineGenerator($this->generatorName);
    }

    public function getBeginTag()
    {
        return $this->beginTag;
    }

    public function getEndTag()
    {
        return $this->endTag;
    }

    public function getPatterns()
    {
        $patterns = array();
        $patterns[] = preg_quote($this->beginTag, '/');
        $patterns[] = preg_quote($this->endTag, '/');
        return $patterns;
    }

    public function isLineContainer()
    {
        return $this->isTextLineTag;
    }

    const INTERMEDIATE_TOKEN = 1;

    const END_TOKEN = 2;

    /**
     * @return false|int
     */
    public function isSupportedToken($tag) {
        if ($tag == $this->endTag && !$this->isTextLineTag) {
            return self::END_TOKEN;
        }
        return false;
    }

    /**
     * Called by the inline parser, when it found a new content.
     *
     * @param string $wikiContent    The original content in wiki syntax
     */
    public function addContentString($wikiContent)
    {
        $this->wikiContent .= $wikiContent;
        $parsedContent = $this->convertWords($wikiContent);
        $this->generator->addContent($parsedContent);
    }


    /**
     * Called by the inline parser, when it found a new content.
     *
     * @param string                             $wikiContent    The original content in wiki syntax
     * @param Generator\InlineGeneratorInterface $childGenerator The content already parsed (by an other Tag object), when this tag contains other tags.
     */
    public function addContentGenerator($wikiContent, Generator\InlineGeneratorInterface $childGenerator)
    {
        $this->wikiContent .= $wikiContent;
        $this->generator->addContent($childGenerator);
    }

    /**
     * Returns the wiki content of the tag.
     *
     * @return string The content.
     */
    public function getWikiContent()
    {
        return $this->beginTag.$this->wikiContent.$this->endTag;
    }

    /**
     * Return generators that will generate final content.
     *
     * @return \WikiRenderer\Generator\InlineGeneratorInterface
     */
    public function getContent()
    {
        return $this->generator;
    }

    /**
     * indicates if the tag can contains other tags.
     *
     * @return bool true if the tag can contain other tags
     */
    public function isOtherTagAllowed()
    {
        return true;
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
        foreach ($this->generator->getChildGenerators() as $child) {
            $generator->addContent($child);
        }
        return $generator;
    }

    public function __clone()
    {
        $this->generator = clone $this->generator;
    }

    /**
     * @param string $wikiContent
     * @return Generator\InlineGeneratorInterface
     */
    protected function convertWords($wikiContent)
    {
        if (count($this->config->wordConverters) && $this->isOtherTagAllowed()) {
            return $this->callWordConverters($wikiContent);
        }

        $words = $this->documentGenerator->getInlineGenerator('words');
        $words->addRawContent($wikiContent);
        return $words;
    }

    protected function callWordConverters($wikiContent) {
        $matches = preg_split("/(\s+)/u",
                $wikiContent, -1, PREG_SPLIT_DELIM_CAPTURE);

        $text = $this->documentGenerator->getInlineGenerator('textline');
        foreach ($matches as $k => $word) {
            if (!($k % 2)) {
                $ok = false;
                foreach ($this->config->wordConverters as $converter) {
                    if ($converter->isMatching($word)) {
                        $ok = true;
                        $text->addContent($converter->getContent($this->documentGenerator, $word));
                        break;
                    }
                }
                if (!$ok) {
                    $text->addRawContent($word);
                }
            } else {
                $text->addRawContent($word);
            }
        }

        return $text;
    }
}
