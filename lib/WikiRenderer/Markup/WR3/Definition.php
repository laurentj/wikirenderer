<?php

/**
 * wikirenderer3 (wr3) syntax.
 *
 * @author Laurent Jouanneau
 * @copyright 2003-2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */
namespace WikiRenderer\Markup\WR3;

/**
 * Parser for definitions block.
 */
class Definition extends \WikiRenderer\Block
{
    public $type = 'definition';
    protected $regexp = "/^\s*;(.*) : (.*)/i";

    public function open()
    {
        $this->engine->getConfig()->defaultTextLineContainer = '\WikiRenderer\Markup\WR3\DefinitionTextLine';

        parent::open();
    }

    public function close($reason)
    {
        $this->engine->getConfig()->defaultTextLineContainer = '\WikiRenderer\Markup\WR3\TextLine';

        return parent::close($reason);
    }

    public function validateLine()
    {
        // $generator is supposed to be a InlineBagGenerator class
        $generator = $this->_renderInlineTag($this->_detectMatch[1].' : '.$this->_detectMatch[2]);

        list($term, $definition) = $generator->getGenerators();

        $this->generator->addDefinition($term, $definition);
    }
}
