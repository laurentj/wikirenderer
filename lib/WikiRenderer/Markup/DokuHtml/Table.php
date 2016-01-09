<?php

/**
 * dokuwiki syntax to xhtml.
 *
 * @author Laurent Jouanneau
 * @copyright 2008-2012 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer\Markup\DokuHtml;

/**
 * traite les signes de types table.
 */
class Table extends \WikiRenderer\Block
{
    public $type = 'table';
    protected $regexp = "/^\s*(\||\^)(.*)/";
    protected $_openTag = '<table>';
    protected $_closeTag = '</table>';

    protected $_colcount = 0;

    public function open()
    {
        $this->engine->getConfig()->defaultTextLineContainer = 'dkxhtml_table_row';

        parent::open();
    }

    public function close()
    {
        $this->engine->getConfig()->defaultTextLineContainer = 'WikiHtmlTextLine';

        return parent::close();
    }

    public function validateDetectedLine()
    {
        $this->text[] = $this->engine->inlineParser->parse($this->_detectMatch[1].$this->_detectMatch[2]);
    }
}
