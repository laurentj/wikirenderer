<?php
/**
 * Markdown (CommonMark) syntax.
 *
 * @author Laurent Jouanneau
 * @copyright 2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */
namespace WikiRenderer\Markup\Markdown;

use WikiRenderer\Generator\BlockListInterface;
use WikiRenderer\StringUtils;

/**
 * Parse a list block.
 *
 * case 1: Basic case
 * ( {0,3})(\d{1,9}[\.\)])(\s{0,4})(.*)
 * -> indent = length((\s{0,3})(\d{1,9}[\.\)])(\s{0,4}))
 *
 * case 2: Item starting with indented code
 * ( {0,3})(\d{1,9}[\.\)])(\s)(\s{4,})(.*)
 * -> indent = length(( {0,3})(\d{1,9}[\.\)])(\s))
 *
 * case 3: Item starting with a blank line
 * ( {0,3})(\d{1,9}[\.\)])(\s*)$
 * -> indent = length(( {0,3})(\d{1,9}[\.\)])\s)
 *
 * case 4 : if indentation of one line of a paragraph is < indent
 * the line is part of the previous paragraph
 *
 * changing the bullet/orderered list delimiter change the list
 */
class OrderedWikiList extends \WikiRenderer\Block
{
    public $type = 'list';

    protected $regexp = "/^( {0,3})(\\d{1,9}[\\.\\)])(\\s*)(.*)/";

    protected $_allowChild = true;

    protected $previousLineWasEmpty = false;

    protected $firstItemIndentLength = 0;
    protected $previousItemIndentLength = 0;
    protected $itemIndentLength = 0;
    protected $linePrefix = '';
    protected $lineContent = '';

    public function isStarting($line)
    {
        $line = StringUtils::tabExpand($line);
        if (preg_match($this->regexp, $line, $m)) {
            $this->setItemIndentation($m);
            $this->firstItemIndentLength = $this->itemIndentLength;
            $this->previousItemIndentLength = $this->itemIndentLength;
            if ($this->getTypeList() == BlockListInterface::ORDERED_LIST) {
                $this->generator->setStartIndex(intval(substr($m[1], 0 ,-1)));
            }
            return true;
        }
        return false;
    }

    protected function setItemIndentation($matches) {
        $this->linePrefix = $matches[1].$matches[2];
        $this->lineContent = $matches[4];
        $this->itemIndentLength = strlen($matches[1])+strlen($matches[2]);

        $indentContent = strlen($matches[3]);
        if ($indentContent == 0 || $matches[4] == '') {
            // case 3: item starting with a blank line
            $this->itemIndentLength++;
            $this->linePrefix .= $matches[3];
        }
        else if ($indentContent <5) {
            // case 1: basic case
            $this->linePrefix .= $matches[3];
            $this->itemIndentLength += $indentContent;
        }
        else {
            // case 2: item starting with indented code
            $this->itemIndentLength++;
            $this->linePrefix .= ' ';
            $this->lineContent = substr($matches[3], 1).$matches[4];
        }
    }

    public function getLinePrefixForSubBlocks()
    {
        return $this->linePrefix;
    }

    protected function getTypeList() {
        return BlockListInterface::ORDERED_LIST;
    }

    public function open()
    {
        $this->generator->setListType($this->getTypeList());
        $this->generator->createItem();
    }

    public function isAccepting($line)
    {
        if ($line == '') {
            $this->linePrefix = '';
            $this->lineContent = '';
            if ($this->previousLineWasEmpty) {
                // two blank lines interrupt a list
                return false;
            }
            $this->previousLineWasEmpty = true;
            return true;
        }
        $line = StringUtils::tabExpand($line);
        if (preg_match($this->regexp, $line, $m)) {
            // a new item is starting
            $this->previousLineWasEmpty = false;
            $this->setItemIndentation($m);
            if ($this->itemIndentLength == $this->firstItemIndentLength) {
                // if the indentation is the same as the first item
                // then we are still in the same list
                $this->generator->createItem();
                $this->previousItemIndentLength = $this->itemIndentLength;
                return true;
            }
            else if ($this->itemIndentLength < $this->firstItemIndentLength) {
                // this is an item of a parent list. We can stop
                return false;
            }
            else {
                // this is an item of a child list.
                // we should not be there...
                throw new \LogicException("new child item in isAccepting???");
            }
        }
        return false;
    }

    public function isAcceptingForSubBlocks($line)
    {
        if ($line == '') {
            $this->linePrefix = '';
            $this->lineContent = '';
            return true;
        }
        $line = StringUtils::tabExpand($line);
        if (preg_match("/^(\\s+)(.*)/", $line, $m)) {
            $expanded = $m[1];
            $indentLength = strlen($expanded);
            if ($indentLength == $this->previousItemIndentLength) {
                $this->lineContent = $m[2];
                return true;
            }
            else if ($indentLength > $this->previousItemIndentLength) {
                $this->lineContent = substr($expanded, $this->previousItemIndentLength).$m[2];
                return true;
            }
        }
        return false;
    }

    public function getLineContentForSubBlocks()
    {
        return $this->lineContent;
    }

    public function addChildBlock(\WikiRenderer\Generator\GeneratorInterface $child)
    {
        $this->generator->addContentToItem($child);
    }

    public function getAuthorizedChildBlocks()
    {
        return array('list', 'para', 'pre', 'syntaxhighlight', 'blockquote');
    }

    public function validateLine()
    {
        $this->generator->addContentToItem($this->_renderInlineTag($this->lineContent));
    }
}
