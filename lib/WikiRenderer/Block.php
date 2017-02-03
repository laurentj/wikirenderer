<?php

/**
 * Wikirenderer is a wiki text parser. It can transform a wiki text into xhtml or other formats.
 *
 * @author Laurent Jouanneau
 * @contributor  Amaury Bouchard
 *
 * @copyright 2003-2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */
namespace WikiRenderer;

/**
 * Base class to parse block elements.
 *
 * @subpackage  core
 */
abstract class Block
{
    /** @var string  Type of the block. */
    public $type = '';

    /**
     * @var bool Says if the block is only on one line.
     */
    protected $_closeNow = false;

    /** @var \WikiRenderer\Renderer      Reference to the main parser. */
    protected $engine = null;

    /** @var   array      List of elements found by the regular expression. */
    protected $_detectMatch = null;

    /** @var string      Regular expression which can detect the block. */
    protected $regexp = '';

    /** @var bool  True if the block object must be cloned. Warning: True by default. */
    protected $_mustClone = true;

    /** @var bool True if the block allows child block */
    protected $_allowChild = false;

    /**
     * @var \WikiRenderer\Generator\BlockGeneratorInterface
     */
    protected $generator;

    /**
     * @var \WikiRenderer\Generator\DocumentGeneratorInterface
     */
    protected $documentGenerator;

    const CLOSE_REASON_UNKNOWN = 0;
    const CLOSE_REASON_LINE_NOT_MATCH = 1;
    const CLOSE_REASON_IMMEDIATELY = 2;
    const CLOSE_REASON_PARENT_CLOSED = 3;
    const CLOSE_REASON_EOF = 4;

    /**
     * Constructor.
     *
     * @param \WikiRenderer\Renderer $wr Main parser object.
     * @param Generator\DocumentGeneratorInterface $generator
     */
    public function __construct(Renderer $wr, \WikiRenderer\Generator\DocumentGeneratorInterface $generator)
    {
        $this->engine = $wr;
        $this->generator = $generator->getBlockGenerator($this->type);
        $this->documentGenerator = $generator;
    }

    /**
     * Says if the given line starts the block. Called by the parser
     * to know if the block can be used for the given line.
     * If yes, the open() method will be called.
     *
     * @param string $string The string to check.
     *
     * @return bool True if the line is part of the block.
     */
    public function isStarting($string)
    {
        return preg_match($this->regexp, $string, $this->_detectMatch);
    }

    public function allowsChildBlocks()
    {
        return $this->_allowChild;
    }

    /**
     * @return array list of block type
     */
    public function getAuthorizedChildBlocks()
    {
        return array();
    }

    public function addChildBlock(\WikiRenderer\Generator\GeneratorInterface $child)
    {
    }

    /**
     * Called when the parser wants to use this block, after detecing
     * that the block correspond to a line.
     */
    public function open()
    {
    }

    /**
     * Says if the given line belongs to the block. Called by the parser
     * to know if the block can be used for the given line.
     * No child block was found in this line.
     *
     * @param string $line The line to check. It may be a line truncated
     *   by parent blocks
     *
     * @return bool True if the line is part of the block.
     */
    public function isAccepting($line)
    {
        return preg_match($this->regexp, $line, $this->_detectMatch);
    }

    /**
     * Says if the given line belongs to the block.
     *
     * Called by the parser when parsing a subblock, to be
     * sure that the current line is belonging to the block
     * which is the parent block of the current subblock
     *
     * It may be called several times for the same line.
     *
     * @param string $line The line to check. It may be a line
     *                     truncated by a parent block.
     *
     * @return bool True if the line is part of the block.
     */
    public function isAcceptingForSubBlocks($line)
    {
        return $this->isAccepting($line);
    }

    /**
     * When a block is accepting a line (after the call of isAccepting), and
     * if it accepts sub-blocks, the parser could call it to retrieve the part
     * of the line corresponding to the content of the block
     * @return string
     */
    public function getLineContentForSubBlocks()
    {
        return '';
    }

    /**
     * When a block is accepting a line, and if it accepts sub-blocks,
     * it returns the part of the line that is belongs to the block syntax
     * @return string
     */
    public function getLinePrefixForSubBlocks()
    {
        return '';
    }

    /**
     * called by the parser when the current line has been detected, so after
     * the call of isAccepting(). This method should then take care of the line
     * given tho the isAccepting() method.
     */
    abstract public function validateLine();

    /**
     * Called when the parser wants to close this block, after it discovers
     * that the line it parses is not belonging to the block.
     *
     * this method should then return the content generated with all lines
     *
     * @param integer $reason  one of the CLOSE_REASON constants
     * @return \WikiRenderer\Generator\BlockGeneratorInterface the content of the block.
     */
    public function close($reason)
    {
        return $this->generator;
    }

    /**
     * @return bool Says if the block can exists only on one line.
     */
    public function closeNow()
    {
        return $this->_closeNow;
    }

    /**
     * Returns a boolean value about the need to clone this block object.
     *
     * The parser instancies the block at the start of the parsing to call
     * the isAccepting method on each line. In most of case, the block should
     * be cloned when it is used for lines. But in particular case, depending
     * of the markup, it may not be cloned.
     *
     * @return bool true if the block should be cloned each time
     *              it is opened.
     */
    public function mustClone()
    {
        return $this->_mustClone;
    }

    /**
     * It uses an "inline parser" to parse the given string, so to
     * transform the markup of a line into an other syntax.
     *
     * @param string $string A line of wiki text.
     *
     * @return \WikiRenderer\Generator\InlineGeneratorInterface The transformed line.
     *
     * @see \WikiRenderer\InlineParser
     */
    protected function _renderInlineTag($string)
    {
        return $this->engine->inlineParser->parse($string);
    }

    public function __clone()
    {
        $this->generator = clone $this->generator;
    }
}
