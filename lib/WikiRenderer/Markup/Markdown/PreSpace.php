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

use WikiRenderer\StringUtils;

/**
 */
class PreSpace extends \WikiRenderer\Block
{
    public $type = 'syntaxhighlight';

    protected $lineContent = '';

    protected $emptyLinesAtStart = false;

    protected $emptyLines = array();

    public function isStarting($line)
    {
        $res =  preg_match("/^( {4,}|\t| +\t)(.*)/", $line, $m);
        if ($res) {
            $expanded = StringUtils::tabExpand($m[1]);
            if (strlen($expanded) > 4) {
                $this->lineContent = substr($expanded, 4).$m[2];
            }
            else {
                $this->lineContent = $m[2];
            }
            if (preg_match("/^\\s*$/", $this->lineContent)) {
                $this->emptyLinesAtStart = true;
                $this->emptyLines[] = $this->lineContent;
                $this->lineContent = null;
            }
        }
        return $res;
    }

    public function open()
    {
        $this->engine->getConfig()->emptyLineCloseParagraph = false;
    }

    public function isAccepting($line)
    {
        if ($line == '') {
            $this->emptyLines[] = '';
            $this->lineContent = null;
            return true;
        }
        $res =  preg_match("/^(\\s+)(.*)/", $line, $m);
        if ($res) {
            $expanded = StringUtils::tabExpand($m[1]);
            $len = strlen($expanded);
            if ($len > 4) {
                $this->lineContent = substr($expanded, 4).$m[2];
            }
            else if ($len < 4 && $m[2] != '') {
                return false;
            }
            else {
                $this->lineContent = $m[2];
            }
            if (preg_match("/^\\s*$/", $this->lineContent)) {
                $this->emptyLines[] = $this->lineContent;
                $this->lineContent = null;
            }
            else {
                if (!$this->emptyLinesAtStart) {
                    // do not include blank line that are at start
                    foreach($this->emptyLines as $line) {
                        $this->generator->addLine($line);
                    }
                }
                $this->emptyLinesAtStart = false;
                $this->emptyLines = array();
            }
        }
        return $res;
    }

    public function validateLine()
    {
        if ($this->lineContent !== null) {
            $this->generator->addLine($this->lineContent);
        }
    }
}

