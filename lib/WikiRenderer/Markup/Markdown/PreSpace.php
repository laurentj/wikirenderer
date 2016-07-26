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

    protected $lineContent = '';

    public function isStarting($line)
    {
        $res =  preg_match("/^( {4,}|\t| +\t)(.*)/", $line, $m);
        if ($res) {
            $expanded = str_replace("\t", "    ", $m[1]);
            if (strlen($expanded) > 4) {
                $this->lineContent = substr($m[1], 4).$m[2];
            }
            else {
                $this->lineContent = $m[2];
            }
        }
        return $res;
    }

    public function isAccepting($line)
    {
        if ($line == '') {
            $this->lineContent = '';
            return true;
        }
        $res =  preg_match("/^(\\s+)(.*)/", $line, $m);
        if ($res) {
            $expanded = str_replace("\t", "    ", $m[1]);
            if (strlen($expanded) > 4) {
                $this->lineContent = substr($m[1], 4).$m[2];
            }
            else {
                $this->lineContent = $m[2];
            }
        }
        return $res;
    }

    public function validateLine()
    {
        $this->generator->addLine($this->lineContent);
    }
}

