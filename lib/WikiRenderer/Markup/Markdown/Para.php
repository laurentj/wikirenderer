<?php
/**
 * Markdown (CommonMark) syntax.
 *
 * @author Laurent Jouanneau
 * @copyright 2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */
namespace WikiRenderer\Markup\Markdown;

/**
 */
class Para extends \WikiRenderer\Block
{
    public $type = 'para';

    protected $lines = array();

    protected $hasEmptyLineBeforeAfter = false;

    public function isStarting($line)
    {
        if ($line == '') {
            return false;
        }

        if (preg_match("/^( {0,3})[\\w\\s`].*/u", $line)) {
            $this->_detectMatch = array($line, $line);
            return true;
        }
        return false;
    }

    public function open()
    {
        $this->hasEmptyLineBeforeAfter = $this->engine->getConfig()->emptyLineCloseParagraph;
        $this->engine->getConfig()->emptyLineCloseParagraph = false;
    }

    public function isAccepting($line)
    {
        if ($line == '') {
            $this->engine->getConfig()->emptyLineCloseParagraph = true;
            $this->hasEmptyLineBeforeAfter = true;
            return false;
        }

        if (preg_match("/^( {0,3})[\\w\\s`].*/u", $line)) {
            $this->_detectMatch = array($line, $line);
            return true;

        }
        return false;
    }

    public function validateLine()
    {
        $this->lines [] = $this->_renderInlineTag(trim($this->_detectMatch[1]));;
    }

    public function close($reason) {
        if ($this->engine->inASubBlock() &&
            !$this->hasEmptyLineBeforeAfter &&
            count($this->lines) == 1) {
            $block = new \WikiRenderer\Generator\SingleLineBlock();
            $block->setLineAsString($this->lines[0]);
            return $block;
        }
        foreach($this->lines as $line) {
            $this->generator->addLine($line);
        }
        return $this->generator;
    }
}

