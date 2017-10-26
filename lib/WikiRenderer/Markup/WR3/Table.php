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
 * Parse a table block.
 */
class Table extends \WikiRenderer\Block
{
    public $type = 'table';
    protected $regexp = "/^\s*\| ?(.*)/";
    protected $_colcount = 0;

    public function open()
    {
        $this->_colcount = 0;
        $this->engine->getConfig()->defaultTextLineContainer = '\WikiRenderer\Markup\WR3\TableRow';
        parent::open();
    }

    public function close($reason)
    {
        $this->engine->getConfig()->defaultTextLineContainer = '\WikiRenderer\Markup\WR3\TextLine';

        return parent::close($reason);
    }

    public function validateLine()
    {
        $this->generator->createRow();
        // $generator is supposed to be a InlineBagGenerator class
        $generator = $this->parseInlineContent($this->_detectMatch[1]);

        $cells = $generator->getGenerators();
        foreach ($cells as $generator) {
            $this->generator->addCell($generator);
        }
    }
}
