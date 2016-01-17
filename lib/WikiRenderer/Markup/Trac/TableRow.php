<?php

/**
 * Trac syntax
 * 
 * @author Laurent Jouanneau
 * @copyright 2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer\Markup\Trac;

/**
 * Parse a line of a table
 */
class TableRow extends \WikiRenderer\TagNG
{
    protected $generatorName = 'tablecell';
    public $isTextLineTag = true;
    protected $attribute = array('$$');
    protected $checkWikiWordIn = array('$$');
    public $separators = array('||');

    /**
     * @var \WikiRenderer\Generator\InlineBagGenerator
     */
    protected $row;

    public function __construct(\WikiRenderer\Config $config, \WikiRenderer\Generator\DocumentGeneratorInterface $generator) {
        parent::__construct($config, $generator);
        $this->row = new \WikiRenderer\Generator\InlineBagGenerator();
    }

    public function addContent($wikiContent, \WikiRenderer\Generator\InlineGeneratorInterface $childGenerator = null)
    {
        if ($wikiContent === '') {
            return;
        }
        $this->wikiContentArr[$this->separatorCount] .= $wikiContent;
        if ($childGenerator === null) {
            $parsedContent = $this->checkWikiWord($wikiContent);
            $words = $this->documentGenerator->getInlineGenerator('words');
            $words->addRawContent($parsedContent);
            $this->generator->addContent($words);
        }
        else {
            $this->generator->addContent($childGenerator);
        }
    }

    /**
     * called by the inline parser, when it found a separator.
     */
    public function addSeparator($token)
    {
        $this->wikiContent .= $this->wikiContentArr[$this->separatorCount];

        if ($this->generator->isEmpty()) {
            $this->generator->setColSpan($this->generator->getColSpan() + 1 );
        }
        else {
            $this->row->addGenerator($this->generator);
            $this->generator = $this->documentGenerator->getInlineGenerator($this->generatorName);
            ++$this->separatorCount;
            $this->contents[$this->separatorCount] = '';
            $this->wikiContentArr[$this->separatorCount] = '';
        }

        $this->currentSeparator = $token;
        $this->wikiContent .= $token;
    }

    public function getContent()
    {
        if (!$this->generator->isEmpty()) {
            $this->row->addGenerator($this->generator);
        }
        return $this->row;
    }

    public function isOtherTagAllowed()
    {
        return true;
    }

    public function __clone() {
        $this->generator = clone $this->generator;
        $this->row = clone $this->row;
    }
}
