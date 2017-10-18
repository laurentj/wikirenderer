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

    protected $isSetextHeading = false;

    public function isStarting($line)
    {
        if ($line == '') {
            return false;
        }

        if (preg_match("/^( {0,3})[\\S].*/u", $line)) {
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

        if ($this->isSetextHeading) {
            return false;
        }

        if (!$this->engine->inASubBlock() &&
            preg_match("/^( {0,3})((\\-{2,})|(=+))\\s*$/", $line, $m)
        ) {
            $this->isSetextHeading = $m[2][0];
            return true;
        }
        if (preg_match('/^( {0,3})((\\-\\s*){3,}|(_\\s*){3,}|(\\*\\s*){3,})$/', $line)) {
            return false;
        }
        if (preg_match("/^( {0,3})(\\d{1,9}[\\.\\)])(\\s+)(.*)/", $line)) {
            return false;
        }
        if (preg_match('/^\s*```(.*)/', $line)) {
            return false;
        }
        if (preg_match("/^( {0,3})([\\-\\+\\*\\>#])(\\s+)(.*)/", $line)) {
            return false;
        }
        if (preg_match("/^( *)[\\S].*/u", $line)) {
            $this->_detectMatch = array($line, $line);
            return true;

        }
        return false;
    }

    public function validateLine()
    {
        if (!$this->isSetextHeading) {
            $this->lines [] = trim($this->_detectMatch[1]);
        }
    }

    public function close($reason) {
        if ($this->isSetextHeading) {
            $this->generator = $this->documentGenerator->getBlockGenerator('title');
            if ($this->isSetextHeading == '-') {
                $this->generator->setLevel(2);
            }
            else {
                $this->generator->setLevel(1);
            }
        }
        else if (!$this->hasEmptyLineBeforeAfter &&
            count($this->lines) == 1 &&
            $this->engine->inASubBlock() &&
            !($this->engine->getParentBlock() instanceof Blockquote)
        ) {
            $this->generator = new \WikiRenderer\Generator\SingleLineBlock();
            $this->generator->setLineAsString($this->_renderInlineTag($this->lines[0]));
            return $this->generator;
        }

        $lines = $this->_renderInlineTag(implode("\n", $this->lines));
        $this->generator->addLine($lines);
        return $this->generator;
    }
}

