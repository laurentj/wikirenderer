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

    protected $hasStartHeader = false;
    protected $hasEndHeader = false;
    protected $firstWord = null;
    protected $lastWord = null;
    protected $cell = array();

    public function addContent($wikiContent, \WikiRenderer\Generator\InlineGeneratorInterface $childGenerator = null)
    {
        if ($wikiContent === '') {
            return;
        }
        $this->hasEndHeader = false;
        $this->lastWord = null;

        if ($childGenerator === null) {
            $parsedContent = $this->checkWikiWord($wikiContent);
            $words = $this->documentGenerator->getInlineGenerator('words');
            $words->addRawContent($parsedContent);
            if ($this->wikiContentArr[$this->separatorCount] === ''
                && $wikiContent[0] == '=') {
                $this->hasStartHeader = true;
                $this->firstWord = $this->documentGenerator->getInlineGenerator('words');

                if (substr($wikiContent, -1) == '=') {
                    $this->hasEndHeader = true;
                    $this->firstWord->addRawContent(substr($parsedContent, 1, -1));
                }
                else {
                    $this->firstWord->addRawContent(substr($parsedContent, 1));
                }

            }
            else if ($this->wikiContentArr[$this->separatorCount] !== ''
                     && substr($wikiContent, -1) == '=') {
                $this->hasEndHeader = true;
                $this->lastWord = $this->documentGenerator->getInlineGenerator('words');
                $this->lastWord->addRawContent(substr($parsedContent, 0, -1));
            }
            $this->wikiContentArr[$this->separatorCount] .= $wikiContent;
            $this->cell[] = $words;
        }
        else {
            $this->wikiContentArr[$this->separatorCount] .= $wikiContent;
            $this->cell[] = $childGenerator;
        }
    }

    /**
     * called by the inline parser, when it found a separator.
     */
    public function addSeparator($token)
    {
        $this->wikiContent .= $this->wikiContentArr[$this->separatorCount];

        if (count($this->cell) === 0) {
            $this->generator->setColSpan($this->generator->getColSpan() + 1);
        }
        else {
            if ($this->hasStartHeader && $this->hasEndHeader) {
                $this->cell[0] = $this->firstWord;
                if ($this->lastWord) {
                    $this->cell[count($this->cell)-1] = $this->lastWord;
                }
                $this->generator->setIsHeader(true);
            }
            foreach($this->cell as $gen) {
                $this->generator->addContent($gen);
            }
            $this->row->addGenerator($this->generator);
            $this->generator = $this->documentGenerator->getInlineGenerator($this->generatorName);
            ++$this->separatorCount;
            $this->contents[$this->separatorCount] = '';
            $this->wikiContentArr[$this->separatorCount] = '';
        }
        $this->firstWord = $this->lastWord = null;
        $this->hasStartHeader = $this->hasEndHeader = false;
        $this->cell = array();
        $this->currentSeparator = $token;
        $this->wikiContent .= $token;
    }

    public function getContent()
    {
        // don't add the "pseudo" cell which is after the last separator
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
