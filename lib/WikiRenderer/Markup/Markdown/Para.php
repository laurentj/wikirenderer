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

    public function isAccepting($line)
    {
        if ($line == '') {
            return false;
        }
        if (preg_match("/^\\s*[^\\w\\s].*/u", $line)) {
            return false;
        }
        $this->_detectMatch = array($line, $line);
        return true;
    }

    public function validateLine()
    {
        $this->generator->addLine($this->_renderInlineTag(trim($this->_detectMatch[1])));
    }
}

