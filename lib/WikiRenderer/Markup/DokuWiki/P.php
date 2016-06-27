<?php

/**
 * DokuWiki syntax.
 *
 * @author Laurent Jouanneau
 * @copyright 2008-2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */
namespace WikiRenderer\Markup\DokuWiki;

/**
 * Parser for a paragraph block.
 */
class P extends \WikiRenderer\Block
{
    public $type = 'para';

    public function isStarting($line)
    {
        return $this->detect($line);
    }

    public function detect($string)
    {
        if ($string == '') {
            return false;
        }
        if (preg_match("/^\s+[\*\-\=\|\^>;<=~]/", $string)) {
            return false;
        }
        if (preg_match("/^\s*((\*\*|[^\*\-\=\|\^>;<=~]).*)/", $string, $m)) {
            $this->_detectMatch = array($m[1], $m[1]);

            return true;
        }

        return false;
    }

    public function validateDetectedLine()
    {
        $this->generator->addLine($this->_renderInlineTag($this->_detectMatch[1]));
    }
}
