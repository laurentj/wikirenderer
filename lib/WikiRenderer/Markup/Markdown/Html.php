<?php
/**
 * Markdown (CommonMark) syntax.
 *
 * @author Laurent Jouanneau
 * @copyright 2017 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */
namespace WikiRenderer\Markup\Markdown;


/**
 */
class Html extends \WikiRenderer\Block
{
    public $type = 'html';

    protected $lineContent = '';

    protected $endCondition = 0;

    protected $endTag = '';

    protected $closeTagDetected = false;

    const TAG_COND6 = array('address', 'article', 'aside', 'base', 'basefont', 'blockquote', 'body', 'caption', 'center', 'col', 'colgroup', 'dd', 'details', 'dialog', 'dir', 'div', 'dl', 'dt', 'fieldset', 'figcaption', 'figure', 'footer', 'form', 'frame', 'frameset', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'head', 'header', 'hr', 'html', 'iframe', 'legend', 'li', 'link', 'main', 'menu', 'menuitem', 'meta', 'nav', 'noframes', 'ol', 'optgroup', 'option', 'p', 'param', 'section', 'source', 'summary', 'table', 'tbody', 'td', 'tfoot', 'th', 'thead', 'title', 'tr', 'track', 'ul');

    public function isStarting($line)
    {
        if (preg_match("/^( {0,3})<(script|pre|style)( |>|$)(.*)/", $line, $m)) {
            $this->endCondition = 1;
            if ($m[3] != '' && $m[4] != '') {
                if (preg_match("/<\\/(script|pre|style)>\s*$/",$m[4])) {
                    $this->_closeNow = true;
                    $this->closeTagDetected = true;
                }
            }
        }
        else if (preg_match("/^ {0,3}<!--(.*)/", $line, $m)) {
            $this->endCondition = 2;
            if (preg_match("/-->/",$m[1])) {
                $this->_closeNow = true;
                $this->closeTagDetected = true;
            }
        }
        else if (preg_match("/^ {0,3}<\\?(.*)/", $line, $m)) {
            $this->endCondition = 3;
            if (preg_match("/\\?>/",$m[1])) {
                $this->_closeNow = true;
                $this->closeTagDetected = true;
            }
        }
        else if (preg_match("/^ {0,3}<![A-Z](.*)/", $line, $m)) {
            $this->endCondition = 4;
            if (preg_match("/>/",$m[1])) {
                $this->_closeNow = true;
                $this->closeTagDetected = true;
            }
        }
        else if (preg_match("/^ {0,3}<!\\[CDATA\\[(.*)/", $line, $m)) {
            $this->endCondition = 5;
            if (preg_match("/\\]\\]>/",$m[1])) {
                $this->_closeNow = true;
                $this->closeTagDetected = true;
            }
        }
        else if (preg_match("/^( {0,3})(<\\/?)([a-zA-Z]+)( |>|\\/>|$)(.*)/", $line, $m)) {
            $tag = $m[3];
            $this->endCondition = 6;
            if (in_array(strtolower($tag), self::TAG_COND6) ||
                ($m[4] == '>' && trim($m[5]) == '') || // html block type 7
                ($m[4] == ' ' && $m[5] !== '' && preg_match("/^[^>]*>\\s*$/", $m[5], $m2))
            ) {
                $this->lineContent = $line;
                return true;
            }
            else if ($m[4] == '>' && $m[5] !== '' && preg_match("/(<\\/$tag>\s*)$/", $m[5], $m2)) {
                $this->_closeNow = true;
                $this->closeTagDetected = true;
                $this->generator = $this->documentGenerator->getBlockGenerator('para');
                $words = $this->documentGenerator->getInlineGenerator('words');
                $words->addGeneratedContent($m[1].$m[2].$m[3].$m[4]);
                $words->addGeneratedContent($this->parseInlineContent(substr($m[5], 0, - strlen($m2[1])))->generate());
                $words->addGeneratedContent($m2[1]);
                $this->generator->addLine($words);
                $this->lineContent = null;
                return true;
            }
            return false;
        }
        else {
            return false;
        }
        $this->lineContent = $line;
        return true;
    }

    public function open()
    {
        $this->closeTagDetected = false;
        $this->engine->getConfig()->emptyLineCloseParagraph = false;
    }

    public function isAccepting($line)
    {
        if ($this->closeTagDetected) {
            return false;
        }
        $ok = true;
        switch($this->endCondition) {
            case 1:
                if (preg_match("/<\\/(script|pre|style)>\s*$/", $line)) {
                    $this->closeTagDetected = true;
                }
                break;
            case 2:
                if (preg_match("/-->/", $line)) {
                    $this->closeTagDetected = true;
                }
                break;
            case 3:
                if (preg_match("/\\?>/", $line)) {
                    $this->closeTagDetected = true;
                }
                break;
            case 4:
                if (preg_match("/>/", $line)) {
                    $this->closeTagDetected = true;
                }
                break;
            case 5:
                if (preg_match("/\\]\\]>/", $line)) {
                    $this->closeTagDetected = true;
                }
                break;
            case 6:
                $ok = ($line !== '');
                break;
        }
        if (!$ok) {
            $this->lineContent = null;
            return false;
        }
        $this->lineContent = $line;
        return true;
    }

    public function validateLine()
    {
        if ($this->lineContent !== null) {
            $this->generator->addLine($this->lineContent);
        }
    }
}

