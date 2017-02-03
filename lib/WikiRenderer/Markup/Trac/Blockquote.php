<?php

/**
 * Trac syntax.
 *
 * @author Laurent Jouanneau
 * @copyright 2006-2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */
namespace WikiRenderer\Markup\Trac;

/**
 * Parse blockquote block.
 */
class Blockquote extends \WikiRenderer\Block
{
    public $type = 'blockquote';
    protected $regexp = "/^\s*(\>+)\s*(.*)/";

    /**
     * @var \SplStack
     */
    protected $generatorStack;

    protected $_firstLine = true;
    protected $_previousTag = '';

    public function open()
    {
        $this->_previousTag = $this->_detectMatch[1];
        $firstTagLen = $this->getTagLen($this->_previousTag);
        $this->_firstLine = true;

        $this->generatorStack = new \SplStack();
        $this->generatorStack->push($this->generator);

        for ($i = 0; $i < $firstTagLen - 1; ++$i) {
            $generator = $this->documentGenerator->getBlockGenerator('blockquote');
            $last = $this->generatorStack->top();
            $last->addContent($generator);
            $this->generatorStack->push($generator);
        }
    }

    public function close($reason)
    {
        $this->generatorStack = null;

        return parent::close($reason);
    }

    protected function getTagLen($tag)
    {
        return strlen($tag);
    }

    public function validateLine()
    {
        $d = $this->getTagLen($this->_previousTag) - $this->getTagLen($this->_detectMatch[1]);

        if ($d > 0) { // we pop off the list of nested blockquote
            for ($i = $d; $i > 0; --$i) {
                $this->generatorStack->pop();
            }
            $this->_previousTag = $this->_detectMatch[1];
        } elseif ($d < 0) { // we have an other nested blockquote 
            $this->_previousTag = $this->_detectMatch[1];
            for ($i = 0; $i < -$d; ++$i) {
                $generator = $this->documentGenerator->getBlockGenerator('blockquote');
                $last = $this->generatorStack->top();
                $last->addContent($generator);
                $this->generatorStack->push($generator);
            }
        } else {
            if ($this->_firstLine) {
                $this->_firstLine = false;
            }
        }

        $inline = $this->_renderInlineTag($this->_detectMatch[2]);
        $this->generatorStack->top()->addContent($inline);
    }
}
