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
 * Parse a line of a table.
 */
class TableRow extends \WikiRenderer\InlineTag
{
    protected $generatorName = 'tablecell';
    protected $isTextLineTag = true;
    protected $attribute = array('$$');
    protected $separators = array(' | ');

    /**
     * @var \WikiRenderer\Generator\InlineBagGenerator
     */
    protected $row;

    public function __construct(\WikiRenderer\Config $config, \WikiRenderer\Generator\DocumentGeneratorInterface $generator)
    {
        parent::__construct($config, $generator);
        $this->row = new \WikiRenderer\Generator\InlineBagGenerator($this->documentGenerator->getConfig());
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

    /**
     * called by the inline parser, when it found a separator.
     * @param string $token
     */
    public function addSeparator($token)
    {
        $this->row->addGenerator($this->generator);
        $this->generator = $this->documentGenerator->getInlineGenerator($this->generatorName);

        $this->wikiContent .= $this->wikiContentArr[$this->separatorCount];
        ++$this->separatorCount;
        $this->currentSeparator = $token;
        $this->wikiContent .= $token;
        $this->contents[$this->separatorCount] = '';
        $this->wikiContentArr[$this->separatorCount] = '';
    }

    public function getContent()
    {
        $this->row->addGenerator($this->generator);

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
