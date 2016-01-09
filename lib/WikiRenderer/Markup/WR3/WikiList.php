<?php

/**
 * wikirenderer3 (wr3) syntax
 *
 * @author Laurent Jouanneau
 * @copyright 2003-2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer\Markup\WR3;
use WikiRenderer\Generator\BlockListInterface;

/**
 * Parse a list block
 */
class WikiList extends \WikiRenderer\BlockNG
{
    public $type = 'list';
    protected $_previousTag;
    protected $_firstTagLen;
    protected $regexp = "/^\s*([\*#-]+)\s?(.*)/";

    /**
     * @var BlockListInterface[]
     */
    protected $generatorStack = array();

    public function detect($string, $inBlock = false)
    {
        if(!preg_match($this->regexp, $string, $this->_detectMatch)) {
            return false;
        }
        // if we are already and the first sign is not equal to the
        // first sign of the previous line, so it is a new list.
        // we should start an other block
        if ($inBlock && $this->_previousTag[0] != $this->_detectMatch[1][0]) {
            return false;
        }
        return true;
    }

    public function open()
    {
        $this->_previousTag = $this->_detectMatch[1];
        $this->_firstTagLen = strlen($this->_previousTag);

        $this->generatorStack = array();
        $this->generatorStack[] = $this->generator;
        if (substr($this->_previousTag, 0, 1) == '#') {
            $this->generator->setListType(BlockListInterface::ORDERED_LIST);
        } else {
            $this->generator->setListType(BlockListInterface::UNORDERED_LIST);
        }
        $this->generator->createItem();

        // if the block starts with more than a sign, we should create
        // all corresponding lists
        for($i=1; $i < $this->_firstTagLen; $i++) {
            $generator = $this->_createList(substr($this->_previousTag, $i, 1));
            $last = $this->generatorStack[count($this->generatorStack)-1];
            $last->addContentToItem($generator);
            $this->generatorStack[] = $generator;
        }
    }

    public function close()
    {
        $this->generatorStack = array();
        return parent::close();
    }

    protected function _createList($type) {
        $generator = $this->documentGenerator->getBlockGenerator('list');
        if ($type == '#') {
            $generator->setListType(BlockListInterface::ORDERED_LIST);
        } else {
            $generator->setListType(BlockListInterface::UNORDERED_LIST);
        }
        $generator->createItem();
        return $generator;
    }

    public function validateDetectedLine()
    {
        $t = $this->_previousTag;
        $d = strlen($t) - strlen($this->_detectMatch[1]);
        $str = '';

        if ($d > 0) {
            // we pop off the list of nested list
            $l = strlen($this->_detectMatch[1]);
            for ($i = strlen($t); $i > $l; --$i) {
                array_pop($this->generatorStack);
            }
            // we verify that other items are same
            // type. if not, so we know that nested lists
            // are changed
            $newtag = $this->_detectMatch[1];
            $change = false;
            foreach($this->generatorStack as $k=>$generator) {
                if ($change) {
                    $generator = $this->_createList($newtag[$k]);
                    $this->generatorStack[$k-1]->addContentToItem($generator);
                    $this->generatorStack[$k] = $generator;
                    continue;
                }
                if ($t[$k] == $newtag[$k]) {
                    continue;
                }
                $change = true;
                $generator = $this->_createList($newtag[$k]);
                $this->generatorStack[$k-1]->addContentToItem($generator);
                $this->generatorStack[$k] = $generator;
            }
            $this->_previousTag = substr($this->_previousTag, 0, -$d); // to be sure..
        } elseif ($d < 0) { // we have an other nested list
            $c = substr($this->_detectMatch[1], -1, 1);
            $this->_previousTag .= $c;

            $generator = $this->documentGenerator->getBlockGenerator('list');
            if ($c == '#') {
                $generator->setListType(BlockListInterface::ORDERED_LIST);
            }
            else {
                $generator->setListType(BlockListInterface::UNORDERED_LIST);
            }
            $last = $this->generatorStack[count($this->generatorStack)-1];
            $last->addContentToItem($generator);
            $this->generatorStack[] = $generator;
        }
        $last = $this->generatorStack[count($this->generatorStack)-1];
        $last->createItem();
        $last->addContentToItem($this->_renderInlineTag($this->_detectMatch[2]));
    }
}
