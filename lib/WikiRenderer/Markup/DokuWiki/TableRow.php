<?php

/**
 * DokuWiki syntax.
 * 
 * @author Laurent Jouanneau
 * @copyright 2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */
namespace WikiRenderer\Markup\DokuWiki;

/**
 * Parse a line of a table.
 */
class TableRow extends \WikiRenderer\InlineTagWithSeparator
{
    protected $generatorName = 'tablecell';
    protected $isTextLineTag = true;
    protected $attribute = array('$$');
    protected $separators = array('|', '^');

    /**
     * @var \WikiRenderer\Generator\InlineBagGenerator
     */
    protected $row;

    protected $cell = array();

    public function __construct(\WikiRenderer\Config $config, \WikiRenderer\Generator\DocumentGeneratorInterface $generator)
    {
        parent::__construct($config, $generator);
        $this->row = new \WikiRenderer\Generator\InlineBagGenerator($generator->getConfig());
    }

    public function isCurrentSeparator($token)
    {
        return ($token == '|' || $token == '^');
    }


    public function addContentString($wikiContent)
    {
        if ($wikiContent === '') {
            return;
        }

        $this->wikiContentArr[$this->separatorCount] .= $wikiContent;
        if (trim($wikiContent) == ':::') {
            $this->generator->setRowSpan(-1);
            return;
        }
        $parsedContent = $this->convertWords($wikiContent);
        $this->generator->addContent($parsedContent);
    }

    public function addContentGenerator($wikiContent, \WikiRenderer\Generator\InlineGeneratorInterface $childGenerator)
    {
        if ($wikiContent === '') {
            return;
        }

        $this->wikiContentArr[$this->separatorCount] .= $wikiContent;
        $this->generator->addContent($childGenerator);
    }

    protected $previousGenerator = null;

    /**
     * called by the inline parser, when it found a separator.
     * @param string $token
     */
    public function addSeparator($token)
    {
        $cellContent = $this->wikiContentArr[$this->separatorCount];
        if ($cellContent === '') {
            if ($this->previousGenerator) {
                $this->previousGenerator->setColSpan($this->previousGenerator->getColSpan() + 1);
            }
        } else {
            if (preg_match('/^\s\s/', $cellContent) &&
                preg_match('/\s\s$/', $cellContent)) {
                if (trim($cellContent) != '') {
                    $this->generator->setAlign('center');
                }
            } elseif (preg_match('/^\s\s/', $cellContent)) {
                $this->generator->setAlign('right');
            } elseif (preg_match('/\s\s$/', $cellContent) && preg_match('/^\S/', $cellContent)) {
                $this->generator->setAlign('left');
            }
            $this->row->addGenerator($this->generator);
            $this->wikiContent .= $cellContent;
            $this->previousGenerator = $this->generator;
            $this->generator = $this->documentGenerator->getInlineGenerator($this->generatorName);
            if ($token == '^') {
                $this->generator->setIsHeader(true);
            }
            ++$this->separatorCount;
            $this->contents[$this->separatorCount] = '';
            $this->wikiContentArr[$this->separatorCount] = '';
        }
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
