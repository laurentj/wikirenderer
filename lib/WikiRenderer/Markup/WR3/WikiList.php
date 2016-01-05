<?php

/**
 * wikirenderer3 (wr3) syntax to xhtml.
 *
 * @author Laurent Jouanneau
 * @copyright 2003-2006 Laurent Jouanneau
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

namespace WikiRenderer\Markup\WR3;
use WikiRenderer\Generator\BlockListInterface;

/**
 * ???
 */
class WikiList extends \WikiRenderer\BlockNG
{
    public $type = 'list';
    protected $_previousTag;
    protected $_firstTagLen;
    protected $regexp = "/^\s*([\*#-]+)(.*)/";

    /**
     * @var \SplStack
     */
    protected $generatorStack;

    public function open()
    {
        $this->_previousTag = $this->_detectMatch[1];
        $this->_firstTagLen = strlen($this->_previousTag);

        $this->generatorStack = new \SplStack();
        $this->generatorStack->push($this->generator);

        if (substr($this->_previousTag, -1, 1) == '#') {
            $this->generator->setListType(BlockListInterface::ORDERED_LIST);
        } else {
            $this->generator->setListType(BlockListInterface::UNORDERED_LIST);
        }
        $this->generator->createItem();
    }

    public function close()
    {
        $this->generatorStack = null;
        return parent::close();
    }

    public function validateDetectedLine()
    {
        $t = $this->_previousTag;
        $d = strlen($t) - strlen($this->_detectMatch[1]);
        $str = '';

        if ($d > 0) { // we pop off the list of nested list
            $l = strlen($this->_detectMatch[1]);
            for ($i = strlen($t); $i > $l; --$i) {
                $this->generatorStack->pop();
            }
            $this->_previousTag = substr($this->_previousTag, 0, -$d); // to be sure..
        } elseif ($d < 0) { // we have an other nested list
            $c = substr($this->_detectMatch[1], -1, 1);
            $this->_previousTag .= $c;

            $generator = $this->globalGenerator->getBlockGenerator('list');
            if ($c == '#') {
                $generator->setListType(BlockListInterface::ORDERED_LIST);
            }
            else {
                $generator->setListType(BlockListInterface::UNORDERED_LIST);
            }
            $last = $this->generatorStack->top();
            $last->addContentToItem($generator);
            $this->generatorStack->push($generator);
        }
        $this->generatorStack->top()->createItem();
        $this->generatorStack->top()->addContentToItem($this->_renderInlineTag($this->_detectMatch[2]));
    }
}
