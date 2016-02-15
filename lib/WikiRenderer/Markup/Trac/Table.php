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
 * Parse a table block.
 */
class Table extends \WikiRenderer\Block
{
    public $type = 'table';
    protected $regexp = "/^\s*\|\|?(.*)/";
    protected $_colcount = 0;

    public function open()
    {
        $this->_colcount = 0;
        $this->engine->getConfig()->defaultTextLineContainer = '\WikiRenderer\Markup\Trac\TableRow';
        parent::open();
    }

    public function close()
    {
        $this->engine->getConfig()->defaultTextLineContainer = '\WikiRenderer\Markup\Trac\TextLine';

        return parent::close();
    }

    public function validateDetectedLine()
    {
        $this->generator->createRow();
        // $generator is supposed to be a InlineBagGenerator class
        $generator = $this->_renderInlineTag($this->_detectMatch[1]);

        $cells = $generator->getGenerators();
        foreach ($cells as $generator) {
            $this->generator->addCell($generator);
        }
    }
}
