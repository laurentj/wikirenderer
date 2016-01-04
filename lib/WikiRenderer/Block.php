<?php

/**
 * Wikirenderer is a wiki text parser. It can transform a wiki text into xhtml or other formats.
 *
 * @author Laurent Jouanneau
 * @contributor  Amaury Bouchard
 *
 * @copyright 2003-2013 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public 2.1
 * License as published by the Free Software Foundation.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */

namespace WikiRenderer;

/**
 * Base class to parse block elements.
 *
 * @cubpackage  core
 */
abstract class Block
{
    /** @var string  Type of the block. */
    public $type = '';
    /** @var string  The string inserted at the beginning of the block. */
    protected $_openTag = '';
    /** @var string  The string inserted at the end of the block. */
    protected $_closeTag = '';
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

    protected $text = array();

    /**
     * Constructor.
     *
     * @param \WikiRenderer\Renderer $wr Main parser object.
     */
    public function __construct(Renderer $wr)
    {
        $this->engine = $wr;
    }

    /**
     * Says if the given line belongs to the block. Called by the parser
     * to know if the block can be used for the given line.
     * If yes, the open() method will be called.
     *
     * @param string $string  The string to check.
     * @param bool   $inBlock (optional) True if the parser is already in the block. False by default.
     *
     * @return bool True if the line is part of the block.
     */
    public function detect($string, $inBlock = false)
    {
        return preg_match($this->regexp, $string, $this->_detectMatch);
    }

    /**
     * Called when the parser wants to use this block, after detecing
     * that the block correspond to a line.
     */
    public function open()
    {
        $this->text = array();
    }

    /**
     * called by the parser when the current line has been detected, so after
     * the call of detect(). This method should then take care of the line
     * given tho the detect() method.
     */
    public function validateDetectedLine()
    {
        $this->text[] = $this->_renderInlineTag($this->_detectMatch[1]);
    }

    /**
     * Called when the parser wants to close this block, after it discovers
     * that the line it parses is not belonging to the block.
     *
     * this method should then return the content generated with all lines
     *
     * @return string the content of the block.
     */
    public function close()
    {
        $content = '';
        if ($this->_openTag) {
            $content .= $this->_openTag;
        }
        $content .= implode("\n", $this->text); 
        if ($this->_closeTag) {
            $content .= $this->_closeTag;
        }
        return $content;
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
     * the detect method on each line. In most of case, the block should
     * be cloned when it is used for lines. But in particular case, depending
     * of the markup, it may not be cloned. 
     * 
     * @return bool true if the block should be cloned each time
     * it is opened.
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
     * @return string The transformed line.
     *
     * @see \WikiRenderer\InlineParser
     */
    protected function _renderInlineTag($string)
    {
        return $this->engine->inlineParser->parse($string);
    }
}
