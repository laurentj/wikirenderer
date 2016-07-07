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
class PreSpace extends \WikiRenderer\Block
{
    public $type = 'syntaxhighlight';

    protected $closeTagDetected = false;

    public function isStarting($string)
    {
        return preg_match("/^( {4,}|\t| +\t)\s*(.*)/", $string, $this->_detectMatch);
    }

    public function isAccepting($string)
    {
        return preg_match("/^( {4,}|\t)\s*(.*)/", $string, $this->_detectMatch);
    }

    public function validateLine()
    {
        $this->generator->addLine($this->_detectMatch[2]);
    }
}

