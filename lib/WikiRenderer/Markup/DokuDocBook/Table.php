<?php

/**
 * dokuwiki syntax to docbook 5.0.
 *
 * @author Laurent Jouanneau
 * @copyright 2008 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer\Markup\DokuDocBook;

/**
 * traite les signes de types table.
 */
class Table extends \WikiRenderer\Block
{
    public $type = 'table';
    protected $regexp = "/^\s*(\||\^)(.*)/";
    protected $_openTag = '<table><caption></caption>';
    protected $_closeTag = '</table>';
    protected $_colcount = 0;

    public function open()
    {
        $this->engine->getConfig()->defaultTextLineContainer = '\WikiRenderer\Markup\DokuDocBook\TableRow';
    }

    public function close()
    {
        $this->engine->getConfig()->defaultTextLineContainer = '\WikiRenderer\XmlTextLine';

        return parent::close();
    }

    public function validateDetectedLine()
    {
        $this->text[] = $this->engine->inlineParser->parse($this->_detectMatch[1].$this->_detectMatch[2]);
    }
}
