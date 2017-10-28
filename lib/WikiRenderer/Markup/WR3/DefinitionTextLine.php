<?php

/**
 * wikirenderer3 (wr3) syntax.
 *
 * @author Laurent Jouanneau
 * @copyright 2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */
namespace WikiRenderer\Markup\WR3;

/**
 * Parser that parse a definition line, and which discover the term and the
 * definition text.
 */
class DefinitionTextLine extends \WikiRenderer\InlineTag
{
    protected $generatorName = 'textline';
    public $isTextLineTag = true;
    public $separators = array(' : ');
    protected $attribute = array('$$', '$$');

    protected $termGenerator;
    protected $definitionGenerator;

    public function __construct(\WikiRenderer\Config $config, \WikiRenderer\Generator\DocumentGeneratorInterface $generator)
    {
        parent::__construct($config, $generator);
        $this->termGenerator = $this->generator;
        $this->definitionGenerator = clone $this->generator;
    }

    public function addContentString($wikiContent)
    {
        $this->wikiContentArr[$this->separatorCount] .= $wikiContent;
        $parsedContent = $this->convertWords($wikiContent);
        $this->generator->addContent($parsedContent);
    }

    public function addContentGenerator($wikiContent, \WikiRenderer\Generator\InlineGeneratorInterface $childGenerator)
    {
        $this->wikiContentArr[$this->separatorCount] .= $wikiContent;
        $this->generator->addContent($childGenerator);
    }

    public function addSeparator($token)
    {
        if ($this->separatorCount == 0) {
            $this->wikiContent .= $this->wikiContentArr[0].$token;
            $this->separatorCount = 1;
            $this->contents[1] = '';
            $this->wikiContentArr[1] = '';
            $this->generator = $this->definitionGenerator;
        } else {
            $this->wikiContentArr[1] .= $token;
        }
    }

    public function getContent()
    {
        $generator = new \WikiRenderer\Generator\InlineBagGenerator($this->documentGenerator->getConfig());
        $generator->addGenerator($this->termGenerator);
        $generator->addGenerator($this->definitionGenerator);

        return $generator;
    }

    public function __clone()
    {
        $this->generator = clone $this->generator;
        $this->termGenerator = $this->generator;
        $this->definitionGenerator = clone $this->definitionGenerator;
    }
}
