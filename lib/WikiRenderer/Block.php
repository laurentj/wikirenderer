<?php
/**
 * Wikirenderer is a wiki text parser. It can transform a wiki text into xhtml or other formats
 * @package WikiRenderer
 * @author Laurent Jouanneau
 * @contributor  Amaury Bouchard
 * @copyright 2003-2013 Laurent Jouanneau
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
 *
 */
namespace WikiRenderer;

/**
 * Base class to parse block elements.
 * @package	WikiRenderer
 * @cubpackage  core
 */
abstract class Block
{
    /** @var string  Type of the block. */
    public $type = '';
    /** @var string  The string inserted at the beginning of the block. */
    protected $_openTag = '';
    /** @var string  The string inserted at the end of the block. */
    protected $_closeTag='';
    /**
     * @var boolean   Says if the block is only on one line.
     * @access private
     */
    protected $_closeNow = false;
    /** @var \WikiRenderer\Renderer      Reference to the main parser. */
    protected $engine=null;
    /** @var   array      List of elements found by the regular expression. */
    protected $_detectMatch = null;
    /** @var string      Regular expression which can detect the block. */
    protected $regexp = '';
    /** @var bool	True if the block object must be cloned. Warning: True by default. */
    protected $_mustClone = true;

    /**
     * Constructor.
     * @param   \WikiRenderer\Renderer    $wr   Main parser object.
     */
    function __construct(Renderer $wr)
    {
        $this->engine = $wr;
    }

    /**
     * ???
     * @return string   The string to insert at the beginning of the block.
     */
    public function open()
    {
        return $this->_openTag;
    }

    /**
     * ???
     * @return string The string to insert at the end of the block.
     */
    public function close()
    {
        return $this->_closeTag;
    }

    /**
     * @return boolean Says if the block can exists only on one line.
     */
    public function closeNow()
    {
        return $this->_closeNow;
    }

    /**
     * Says if the given line belongs to the block.
     * @param string   $string  The string to check.
     * @param bool     $inBlock (optional) True if the parser is already in the block. False by default.
     * @return bool True if the line is part of the block.
     */
    public function detect($string, $inBlock = false)
    {
        return preg_match($this->regexp, $string, $this->_detectMatch);
    }

    /**
     * ???
     * @return string   A rendered line  of block.
     */
    public function getRenderedLine()
    {
        return $this->_renderInlineTag($this->_detectMatch[1]);
    }

    /**
     * Returns a boolean value about the need to clone this block object.
     * @return bool The value of the configuraiton attribute.
     */
    public function mustClone() {
        return $this->_mustClone;
    }

    /**
     * ???
     * @param   string  $string A line of wiki text.
     * @return  string  The transformed line.
     * @see \WikiRenderer\InlineParser
     */
    protected function _renderInlineTag($string)
    {
        return $this->engine->inlineParser->parse($string);
    }
}

