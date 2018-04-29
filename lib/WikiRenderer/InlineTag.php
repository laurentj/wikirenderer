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

    /**
     * List of possible separators.
     *
     * @var string[]
     */
    protected $separators = array();

    /**
     * list of names corresponding to each parts separated by the separator in the tag.
     * Each parts of the tag string are then called "attributes".
     * If the name is '$$', the content is not an attribute and may content
     * nested tag. However this behavior can be changed by the isOtherTagAllowed()
     * method in child classes.
     *
     * @var string[]
     */
    protected $attribute = array('$$');

    /**
     * list of attributes in which wiki words should be searched.
     *
     * @var string[]
     *
     * @deprecated
     */
    protected $convertWordsIn = array('$$');

    /**
     * values of each parts.
     *
     * @var string[]
     */
    protected $contents = array('');

    /** Wiki content of each part of the tag. */
    protected $wikiContentArr = array('');

    /** Wiki content of the full tag. */
    protected $wikiContent = '';

    /** number of separators found into the tag
     * @var int
     */
    protected $separatorCount = 0;

    /**
     * current separator during the parsing of the tag. False means no
     * separator found yet.
     *
     * @var string|false
     */
    protected $currentSeparator = false;

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
        if (count($this->separators)) {
            $this->currentSeparator = $this->separators[0];
        }
        $this->documentGenerator = $generator;
        $this->generator = $generator->getInlineGenerator($this->generatorName);
    }

    public function getBeginTag()
    {
        return $this->beginTag;
    }

    public function getBeginPattern()
    {
        return preg_quote($this->beginTag, '/');
    }

    public function getEndTag()
    {
        return $this->endTag;
    }

    public function getEndPattern()
    {
        return preg_quote($this->endTag, '/');
    }

    public function getSeparators()
    {
        return $this->separators;
    }

    public function isLineContainer()
    {
        return $this->isTextLineTag;
    }

    /**
     * Called by the inline parser, when it found a new content.
     *
     * @param string $wikiContent    The original content in wiki syntax
     */
    public function addContentString($wikiContent)
    {
        $isMainContent = isset($this->attribute[$this->separatorCount]) &&
            $this->attribute[$this->separatorCount] == '$$';
        $this->wikiContentArr[$this->separatorCount] .= $wikiContent;
        if ($isMainContent) {
            $parsedContent = $this->convertWords($wikiContent);
            $this->generator->addContent($parsedContent);
        } else {
            $this->contents[$this->separatorCount] .= $wikiContent;
        }
    }


    /**
     * Called by the inline parser, when it found a new content.
     *
     * @param string                             $wikiContent    The original content in wiki syntax
     * @param Generator\InlineGeneratorInterface $childGenerator The content already parsed (by an other Tag object), when this tag contains other tags.
     */
    public function addContentGenerator($wikiContent, Generator\InlineGeneratorInterface $childGenerator)
    {
        $isMainContent = isset($this->attribute[$this->separatorCount]) &&
                            $this->attribute[$this->separatorCount] == '$$';
        $this->wikiContentArr[$this->separatorCount] .= $wikiContent;
        if ($isMainContent) {
            $this->generator->addContent($childGenerator);
        } else {
            $this->contents[$this->separatorCount] .= $wikiContent;
        }
    }

    /**
     * Called by the inline parser, when it found a separator.
     *
     * @param string $token The token found as a separator
     */
    public function addSeparator($token)
    {
        $this->wikiContent .= $this->wikiContentArr[$this->separatorCount];
        ++$this->separatorCount;
        if ($this->separatorCount > count($this->separators)) {
            $this->currentSeparator = end($this->separators);
        } else {
            $this->currentSeparator = $this->separators[$this->separatorCount - 1];
        }
        $this->wikiContent .= $this->currentSeparator;
        $this->contents[$this->separatorCount] = '';
        $this->wikiContentArr[$this->separatorCount] = '';
    }

    /**
     * Says if the given token is the current separator of the tag.
     * The tag can support many separator.
     *
     * @param string $token
     * @return string The separator.
     */
    public function isCurrentSeparator($token)
    {
        return ($this->currentSeparator === $token);
    }

    /**
     * Returns the wiki content of the tag.
     *
     * @return string The content.
     */
    public function getWikiContent()
    {
        return $this->beginTag.$this->wikiContent.$this->wikiContentArr[$this->separatorCount].$this->endTag;
    }

    /**
     * Return generators that will generate final content.
     *
     * @return \WikiRenderer\Generator\InlineGeneratorInterface
     */
    public function getContent()
    {
        $cntattr = count($this->attribute);
        $count = ($this->separatorCount >= $cntattr) ? ($cntattr - 1) : $this->separatorCount;

        for ($i = 0; $i <= $count; ++$i) {
            if ($this->attribute[$i] != '$$') {
                $this->generator->setAttribute($this->attribute[$i], $this->wikiContentArr[$i]);
            }
        }

        return $this->generator;
    }

    /**
     * indicates if the tag can contains other tags.
     *
     * @return bool true if the tag can contain other tags
     */
    public function isOtherTagAllowed()
    {
        if (isset($this->attribute[$this->separatorCount])) {
            return ($this->attribute[$this->separatorCount] == '$$');
        } else {
            return false;
        }
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
                foreach ($this->generator->getChildGenerators() as $child) {
                    $generator->addContent($child);
                }
            } else {
                $generator->addRawContent($v);
            }
            if ($k < $m) {
                if ($k < $s) {
                    $generator->addRawContent($this->separators[$k]);
                } else {
                    $generator->addRawContent(end($this->separators));
                }
            }
        }

        return $generator;
    }

    public function getAttributeValue($name)
    {
        $cntattr = count($this->attribute);
        $count = ($this->separatorCount >= $cntattr) ? ($cntattr - 1) : $this->separatorCount;

        for ($i = 0; $i <= $count; ++$i) {
            if ($this->attribute[$i] == $name) {
                return $this->wikiContentArr[$i];
            }
        }

        return null;
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
        if (count($this->convertWordsIn)
            && isset($this->attribute[$this->separatorCount])
            && in_array($this->attribute[$this->separatorCount], $this->convertWordsIn)
            && count($this->config->wordConverters)) {
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
        $words = $this->documentGenerator->getInlineGenerator('words');
        $words->addRawContent($wikiContent);

        return $words;
    }
}
