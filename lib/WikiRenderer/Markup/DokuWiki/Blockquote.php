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

    public function open()
    {
        $this->_previousTag = $this->_detectMatch[1];
        $this->_firstTagLen = strlen($this->_previousTag);
        $this->_firstLine = true;

        $this->generatorStack = new \SplStack();
        $this->generatorStack->push($this->generator);

        for ($i = 0; $i < $this->_firstTagLen - 1; ++$i) {
            $generator = $this->documentGenerator->getBlockGenerator('blockquote');
            $last = $this->generatorStack->top();
            $last->addContent($generator);
            $this->generatorStack->push($generator);
        }
    }

    public function close()
    {
        $this->generatorStack = null;

        return parent::close();
    }

    public function validateLine()
    {
        $d = strlen($this->_previousTag) - strlen($this->_detectMatch[1]);

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
