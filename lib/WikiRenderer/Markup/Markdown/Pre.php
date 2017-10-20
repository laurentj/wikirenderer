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
class Pre extends \WikiRenderer\Block
{
    public $type = 'syntaxhighlight';

    protected $closeTagDetected = false;

    protected $emptyLinesAtStart = false;

    protected $emptyLines = array();

    protected $startCodeFence = '';

    protected $startIndent = '';

    public function isStarting($string)
    {
        if (preg_match('/^(\s{0,3})(```+|~~~+)(.*)/', $string, $m)) {
            $this->startCodeFence = $m[2];
            $this->startIndent = $m[1];
            if (preg_match('/([^`~]*)(```+|~~~+)\s*$/', $m[3], $m2)) {
                return false;
            } else {
                $this->_closeNow = false;
                // ignore first line, it supposed to indicate type
                $this->_detectMatch = null;
                $this->emptyLinesAtStart = true;
                if (preg_match("/^\\s*([^\s]+)/", $m[3], $type)) {
                    $this->generator->setSyntaxType($type[1]);
                }
                $this->closeTagDetected = false;
            }
            return true;
        } else {
            return false;
        }
    }

    public function open()
    {
        $this->engine->getConfig()->emptyLineCloseParagraph = false;
    }

    public function isAccepting($string)
    {
        if ($this->closeTagDetected) {
            return false;
        }
        $this->_detectMatch = $string;
        if (preg_match('/(\s*)(```+|~~~+)\s*$/', $string, $m)&&
            strlen($m[2]) >= strlen($this->startCodeFence) &&
            strpos($m[2] , $this->startCodeFence) === 0 // ~ and ` cannot be mixed
        ) {
            if (strlen($m[1]) < 4) {
                $this->closeTagDetected = true;
                $this->_detectMatch = null;
                return true;
            }
        }

        if (preg_match("/^(\\s*)(.*)$/", $this->_detectMatch, $m)) {
            if ($m[2] == '') {
                $this->emptyLines[] = $this->_detectMatch;
                $this->_detectMatch = null;
                return true;
            }
            if ($this->startIndent && $m[1]) {
                if (strlen($this->startIndent) < strlen($m[1])) {
                    $this->_detectMatch = substr($this->_detectMatch, strlen($this->startIndent));
                }
                else {
                    $this->_detectMatch = $m[2];
                }
            }
        }

        if (!$this->emptyLinesAtStart) {
            // do not include blank line that are at start
            foreach($this->emptyLines as $line) {
                $this->generator->addLine($line);
            }
        }
        else if (count($this->emptyLines)) {
            $this->generator->addLine('');
        }
        $this->emptyLinesAtStart = false;
        $this->emptyLines = array();
        return true;
    }

    public function validateLine()
    {
        if ($this->_detectMatch !== null) {
            $this->generator->addLine($this->_detectMatch);
        }
    }

    public function close($reason)
    {
        if ($this->emptyLinesAtStart) {
            // include blank line that are at start if no content
            foreach($this->emptyLines as $line) {
                $this->generator->addLine($line);
            }
        }
        return $this->generator;
    }
}

