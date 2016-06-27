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
 * Parse a title block.
 */
class Macro extends \WikiRenderer\Block
{
    public $type = 'macro';
    protected $regexp = "/^\s*~~([^~]*)~~\s*$/";
    protected $_closeNow = true;

    protected $content = '';

    public function __construct(\WikiRenderer\Renderer $wr, \WikiRenderer\Generator\DocumentGeneratorInterface $generator)
    {
        $this->engine = $wr;
        $this->documentGenerator = $generator;
    }

    public function validateLine()
    {
        if (preg_match('/^\s*(\w+)(?:\:?\s*(.+))?\s*$/', $this->_detectMatch[1], $m)) {
            $macroName = strtolower($m[1]);
            $macroArg = isset($m[2]) ? $m[2] : '';
            $macros = $this->engine->getConfig()->macros;
            if (isset($macros[$macroName]) && is_callable($macros[$macroName])) {
                $this->content = call_user_func($macros[$macroName], $macroName, $macroArg);

                return;
            }
        }
        $this->content = $this->_detectMatch[0];
    }

    public function close()
    {
        $block = new \WikiRenderer\Generator\SingleLineBlock();
        $block->setLineAsString($this->content);

        return $block;
    }

    public function __clone()
    {
    }
}
