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
    public $type = 'pre';

    protected $closeTagDetected = false;

    public function isStarting($string)
    {
        if (preg_match('/^\s*```(.*)/', $string, $m)) {
            if (preg_match('/(.*)```\s*$/', $m[1], $m2)) {
                $this->_closeNow = true;
                $this->_detectMatch = $m2[1];
                $this->closeTagDetected = true;
            } else {
                $this->_closeNow = false;
                $this->_detectMatch = $m[1];
                $this->closeTagDetected = false;
            }
            return true;
        } else {
            return false;
        }
    }

    public function isAccepting($string)
    {
        if ($this->closeTagDetected) {
            return false;
        }
        if (preg_match('/(.*)```\s*$/', $string, $m)) {
            $this->_detectMatch = $m[1];
            $this->closeTagDetected = true;
        } else {
            $this->_detectMatch = $string;
        }

        return true;
    }

    public function validateLine()
    {
        $this->generator->addLine($this->_detectMatch);
    }
}

