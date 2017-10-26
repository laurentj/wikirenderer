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

    protected $content = array();

    protected $hasEmptyLineBeforeAfter = false;

    protected $isSetextHeading = false;

    public function isStarting($line)
    {
        if ($line == '') {
            return false;
        }

        if (preg_match("/^( {0,3})[\\S].*/u", $line)) {
            $this->_detectMatch = array($line, false);
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
        if (preg_match('/^\s{0,3}(```|~~~)(.*)/', $line, $m)) {
            if (!preg_match('/([^`~]*)(```+|~~~+)\s*$/', $m[2])) {
                return false;
            }
            return true;
        }
        if (preg_match("/^( {0,3})([\\-\\+\\*\\>#])(\\s+)(.*)/", $line)) {
            return false;
        }
        if (preg_match("/^( {0,3})<\\/?([a-zA-Z]+)( |>|\\/>|$)(.*)$/", $line, $m)) {
            $tag = $m[2];
            if (!in_array(strtolower($tag), Html::TAG_COND6) &&
                ((($m[3] == '>' || $m[3] == '/>') && trim($m[4]) == '') || // html block type 7
                ($m[3] != '>' &&  $m[3] != '/>' && $m[4] !== '' && preg_match("/^[^>]*>\\s*$/", $m[4], $m2)))
            ) {
                $this->_detectMatch = array($line, true);
                return true;
            }
            return false;
            /*if (!($m[3] == '>' && $m[4] !== '' && preg_match("/(<\\/$tag>\s*)$/", $m[4], $m2))) {
                return false;
            }
            $this->_detectMatch = array($line, $line);
            return true;*/
        }
        if (preg_match("/^( *)[\\S].*/u", $line)) {
            $this->_detectMatch = array($line, false);
            return true;
        }
        return false;
    }

    public function validateLine()
    {
        if (!$this->isSetextHeading) {
            if ($this->_detectMatch[1]) {
                if (count($this->lines)) {
                    $this->content[] = $this->lines;
                    $this->lines = array();
                }
                $this->content[] = trim($this->_detectMatch[0]);
            }
            else {
                $this->lines [] = trim($this->_detectMatch[0]);
            }
        }
    }

    public function close($reason) {
        if (count($this->lines)) {
            $this->content[] = $this->lines;
        }

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
            count($this->content) && is_array($this->content[0]) && count($this->content[0]) == 1 &&
            $this->engine->inASubBlock() &&
            !($this->engine->getParentBlock() instanceof Blockquote)
        ) {
            $this->generator = new \WikiRenderer\Generator\SingleLineBlock($this->documentGenerator->getConfig());
            $line = $this->parseInlineContent($this->content[0][0]);
            $this->generator->setLineAsString($line);
            return $this->generator;
        }

        foreach($this->content as $content) {
            if (is_array($content)) {
                $lines = $this->parseInlineContent(implode("\n", $content));
            }
            else {
                $lines = $this->documentGenerator->getInlineGenerator('words');
                $lines->addGeneratedContent($content);
            }
            $this->generator->addLine($lines);
        }
        return $this->generator;
    }
}

