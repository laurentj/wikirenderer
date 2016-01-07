<?php

/**
 * wikirenderer3 (wr3) syntax
 *
 * @author Laurent Jouanneau
 * @copyright 2003-2016 Laurent Jouanneau
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

/**
 * Parse blockquote block
 */
class Blockquote extends \WikiRenderer\BlockNG
{
    public $type = 'blockquote';
    protected $regexp = "/^\s*(\>+)(.*)/";

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

        for($i=0; $i < $this->_firstTagLen-1; $i++) {
            $generator = $this->documentGenerator->getBlockGenerator('blockquote');
            $last = $this->generatorStack->top();
            $last->addContent($generator);
            $this->generatorStack->push($generator);
        }
    }

    public function close()
    {
        $this->generatorStack =null;
        return parent::close();
    }

    public function validateDetectedLine()
    {
        $d = strlen($this->_previousTag) - strlen($this->_detectMatch[1]);
        $str = '';

        if ($d > 0) { // we pop off the list of nested blockquote
            for ($i = $d; $i > 0; --$i) {
                $this->generatorStack->pop();
            }
            $this->_previousTag = $this->_detectMatch[1];
        } elseif ($d < 0) { // we have an other nested blockquote 
            $this->_previousTag = $this->_detectMatch[1];
            for ($i = 0; $i < -$d; $i++) {
                $generator = $this->documentGenerator->getBlockGenerator('blockquote');
                $last = $this->generatorStack->top();
                $last->addContent($generator);
                $this->generatorStack->push($generator);
            }
        }

        $this->generatorStack->top()->addContent($this->_renderInlineTag($this->_detectMatch[2]));
    }
}
