<?php

/**
 * DokuWiki syntax.
 *
 * @author Laurent Jouanneau
 * @copyright 2008-2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */
namespace WikiRenderer\Markup\DokuWiki;

use WikiRenderer\Generator\BlockListInterface;

/**
 * Parse a list block.
 */
class WikiList extends \WikiRenderer\Block
{
    public $type = 'list';
    protected $regexp = "/^(\s{2,})(\-|\*)\s*(.*)/";

    /**
     * @var BlockListInterface[]
     */
    protected $generatorStack = array();

    /**
     * @var array of array(indent len, 'o' or 'u');
     */
    protected $indentStack = array();

    public function isStarting($line)
    {
        return $this->detect($line);
    }

    public function detect($string)
    {
        $this->sameItem = false;
        if (!preg_match($this->regexp, $string, $this->_detectMatch)) {
            if (!count($this->indentStack)) {
                return false;
            }
            if (!preg_match("/^(\s*)((\*\*|[^\*\-\=\|\^>;<=~]).*)/", $string, $this->_detectMatch)) {
                return false;
            }
            if (strlen($this->_detectMatch[1]) < end($this->indentStack)[0]) {
                return false;
            }
            $this->sameItem = true;

            return true;
        }

        // if we are already here and the indentation length is lower
        // than the one of the first detected item so it is a new list.
        // we should start an other block
        if (count($this->indentStack) && $this->indentStack[0][0] > strlen($this->_detectMatch[1])) {
            return false;
        }

        // if this is not the same list type at the first level, 
        // we should start an other block
        $type = $this->getItemType($this->_detectMatch[2]);
        if (count($this->indentStack) == 1 &&
            $this->indentStack[0][0] == strlen($this->_detectMatch[1]) &&
            $this->indentStack[0][1] != $type) {
            return false;
        }

        return true;
    }

    protected function getItemType($type)
    {
        return $type == '*' ? 'u' : 'o';
    }

    public function open()
    {
        $type = $this->getItemType($this->_detectMatch[2]);
        $this->generatorStack = array($this->generator);
        $this->indentStack = array(array(strlen($this->_detectMatch[1]), $type));

        if ($type == 'u') {
            $this->generator->setListType(BlockListInterface::UNORDERED_LIST);
        } else {
            $this->generator->setListType(BlockListInterface::ORDERED_LIST);
        }
    }

    public function close()
    {
        $this->generatorStack = array();
        $this->indentStack = array();

        return parent::close();
    }

    protected function _createList($type)
    {
        $generator = $this->documentGenerator->getBlockGenerator('list');
        if ($type == 'u') {
            $generator->setListType(BlockListInterface::UNORDERED_LIST);
        } else {
            $generator->setListType(BlockListInterface::ORDERED_LIST);
        }
        $generator->createItem();

        return $generator;
    }

    public function validateDetectedLine()
    {
        if ($this->sameItem) {
            $last = $this->generatorStack[count($this->generatorStack) - 1];
            $last->addContentToItem($this->_renderInlineTag(' '.$this->_detectMatch[2]));

            return;
        }

        $t = end($this->indentStack);
        $newLen = strlen($this->_detectMatch[1]);
        $d = $t[0] - $newLen;
        $type = $this->getItemType($this->_detectMatch[2]);

        if ($d > 0) {
            // we pop off the list of nested list
            for ($i = count($this->indentStack) - 1; $i >= 0; --$i) {
                if ($this->indentStack[$i][0] <= $newLen) {
                    break;
                }
                array_pop($this->indentStack);
                array_pop($this->generatorStack);
            }

            // the new item is not of the same type
            // we should close the current sub list and create a new one
            $t = end($this->indentStack);
            if ($t[1] != $type) {
                array_pop($this->generatorStack);
                array_pop($this->indentStack);
                $this->indentStack[] = array($t[0],$type);
                $generator = $this->_createList($type);
                $generator->addContentToItem($this->_renderInlineTag($this->_detectMatch[3]));
                $last = $this->generatorStack[count($this->generatorStack) - 1];
                $last->addContentToItem($generator);
                $this->generatorStack[] = $generator;

                return;
            }
        } elseif ($d < 0) { // we have a new nested list

            $generator = $this->_createList($type);
            $generator->addContentToItem($this->_renderInlineTag($this->_detectMatch[3]));

            $last = $this->generatorStack[count($this->generatorStack) - 1];
            $last->addContentToItem($generator);
            $this->generatorStack[] = $generator;
            $this->indentStack[] = array(strlen($this->_detectMatch[1]), $type);

            return;
        } else {
            // the new item is not of the same type
            // we should close the current sub list and create a new one
            if ($t[1] != $type) {
                array_pop($this->generatorStack);
                array_pop($this->indentStack);
                $this->indentStack[] = array($t[0], $type);
                $generator = $this->_createList($type);
                $generator->addContentToItem($this->_renderInlineTag($this->_detectMatch[3]));
                $last = $this->generatorStack[count($this->generatorStack) - 1];
                $last->addContentToItem($generator);
                $this->generatorStack[] = $generator;

                return;
            }
        }

        $last = $this->generatorStack[count($this->generatorStack) - 1];
        $last->createItem();
        $last->addContentToItem($this->_renderInlineTag($this->_detectMatch[3]));
    }
}
