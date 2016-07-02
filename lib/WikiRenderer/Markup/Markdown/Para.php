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

    public function isStarting($line)
    {
        return $this->isAccepting($line);
    }

    public function isAccepting($string)
    {
        if ($string == '') {
            return false;
        }
        if (preg_match("/^\s*[^\\w].*/u", $string)) {
            return false;
        }
        $this->_detectMatch = array($string, $string);
        return true;
    }

    public function validateLine()
    {
        $this->generator->addLine($this->_renderInlineTag($this->_detectMatch[1]));
    }
}

