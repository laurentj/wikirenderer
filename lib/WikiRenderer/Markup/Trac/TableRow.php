<?php

/**
 * Trac syntax.
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
 * Parse a line of a table.
 */
class TableRow extends \WikiRenderer\InlineTag
{
    protected $generatorName = 'tablecell';
    public $isTextLineTag = true;
    protected $attribute = array('$$');
    public $separators = array('||');

    /**
     * @var \WikiRenderer\Generator\InlineBagGenerator
     */
    protected $row;

    public function __construct(\WikiRenderer\Config $config, \WikiRenderer\Generator\DocumentGeneratorInterface $generator)
    {
        parent::__construct($config, $generator);
        $this->row = new \WikiRenderer\Generator\InlineBagGenerator($generator->getConfig());
    }

    protected $hasStartHeader = false;
    protected $hasEndHeader = false;
    protected $cell = array();

    public function addContentString($wikiContent)
    {
        if ($wikiContent === '') {
            return;
        }
        $this->hasEndHeader = false;
        $this->lastWord = null;

        $filteredWikiContent = $wikiContent;
        if ($this->wikiContentArr[$this->separatorCount] === ''
            && $wikiContent[0] == '=') {
            $this->hasStartHeader = true;

            if (substr($wikiContent, -1) == '=') {
                $this->hasEndHeader = true;
                $filteredWikiContent = substr($wikiContent, 1, -1);
            } else {
                $filteredWikiContent = substr($wikiContent, 1);
            }
        } elseif ($this->wikiContentArr[$this->separatorCount] !== ''
                 && substr($wikiContent, -1) == '=') {
            $this->hasEndHeader = true;
            $filteredWikiContent = substr($wikiContent, 0, -1);
        }

        $this->wikiContentArr[$this->separatorCount] .= $wikiContent;
        $this->cell[] = $this->convertWords($filteredWikiContent);
    }

    public function addContentGenerator($wikiContent, \WikiRenderer\Generator\InlineGeneratorInterface $childGenerator)
    {
        if ($wikiContent === '') {
            return;
        }
        $this->hasEndHeader = false;
        $this->lastWord = null;

        $this->wikiContentArr[$this->separatorCount] .= $wikiContent;
        $this->cell[] = $childGenerator;
    }

    /**
     * called by the inline parser, when it found a separator.
     * @param string $token
     */
    public function addSeparator($token)
    {
        $this->wikiContent .= $this->wikiContentArr[$this->separatorCount];

        if (count($this->cell) === 0) {
            $this->generator->setColSpan($this->generator->getColSpan() + 1);
        } else {
            if ($this->hasStartHeader && $this->hasEndHeader) {
                $this->generator->setIsHeader(true);
            } elseif ($this->hasStartHeader) {
                // no header, we revert the '=' removal
                $words = $this->documentGenerator->getInlineGenerator('words');
                $words->addRawContent('=');
                array_unshift($this->cell, $words);
            } elseif ($this->hasEndHeader) {
                // no header, we revert the '=' removal
                $words = $this->documentGenerator->getInlineGenerator('words');
                $words->addRawContent('=');
                array_push($this->cell, $words);
            }

            foreach ($this->cell as $gen) {
                $this->generator->addContent($gen);
            }
            $this->row->addGenerator($this->generator);
            $this->generator = $this->documentGenerator->getInlineGenerator($this->generatorName);
            ++$this->separatorCount;
            $this->contents[$this->separatorCount] = '';
            $this->wikiContentArr[$this->separatorCount] = '';
        }
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

    public function __clone()
    {
        $this->generator = clone $this->generator;
        $this->row = clone $this->row;
    }
}
