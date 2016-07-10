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

/**
 * Parse a list block.
 */
class OrderedWikiList extends \WikiRenderer\Block
{
    public $type = 'list';

    protected $regexp = "/^(\\s*)(\\d+\\.)\\s?(.*)/";

    protected $_allowChild = true;

    protected $previousLineWasEmpty = false;

    protected $firstItemIndent = '';
    protected $linePrefix = '';
    protected $lineContent = '';

    public function isStarting($line)
    {
        if (preg_match($this->regexp, $line, $m)) {
            $this->linePrefix = $m[1].$m[2];
            $this->lineContent = $m[3];
            $this->firstItemIndent = $m[1];
            return true;
        }
        return false;
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
            $this->previousLineWasEmpty = true;
            return true;
        }
        if (preg_match("/^(\\s+)(.*)/", $line, $m)) {
            $this->previousLineWasEmpty = false;
            if (preg_match($this->regexp, $line, $m2)) {
                // the line is starting a new list item
                if ($m2[1] == $this->linePrefix) {
                    // if the indentation is the same as the first item
                    // then we are still in the same list
                    $this->linePrefix = $m2[1].$m2[2];
                    $this->lineContent = $m2[3];
                    $this->generator->createItem();
                }
                else {
                    // if the indentation is not the same as the first item
                    // then a sub list is began
                    $this->linePrefix = '';
                    $this->lineContent = $line;
                }
            }
            else {
                $this->linePrefix = $m[1];
                $this->lineContent = $m[2];
            }
            return true;
        } else if (!$this->previousLineWasEmpty) {
            $this->linePrefix = '';
            $this->lineContent = $line;
            return true;
        }
        $this->previousLineWasEmpty = false;
        return false;
    }

    public function getLineContentForSubBlocks()
    {
        return $this->lineContent;
    }

    public function addChildBlock(\WikiRenderer\Generator\GeneratorInterface $child)
    {
        /*if (!($child instanceof BlockListInterface)) {
            $this->generator->createItem();
        }*/
        $this->generator->addContentToItem($child);
    }

    public function getAuthorizedChildBlocks()
    {
        return array('list', 'para', 'pre', 'syntaxhighlight');
    }

    public function validateLine()
    {
        $this->generator->addContentToItem($this->_renderInlineTag($this->lineContent));
    }
}
