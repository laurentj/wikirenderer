<?php

/**
 * Trac syntax.
 *
 * @author Laurent Jouanneau
 * @copyright 2006-2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */
namespace WikiRenderer\Markup\Trac;

/**
 * Parse a title block.
 *
 * @FIXME support nested sections
 */
class Title extends \WikiRenderer\Block
{
    public $type = 'title';
    protected $regexp = "/^\s*(\={1,6})\s*([^=]+)\s*(\={1,6})?(.*)$/";
    protected $_closeNow = true;

    public function validateLine()
    {
        $level = strlen($this->_detectMatch[1]);
        $h = $this->engine->getConfig()->startHeaderNumber - 1 + $level;
        if ($h > 5) {
            $h = 5;
        } elseif ($h < 1) {
            $h = 1;
        }

        $this->generator->setLevel($h);

        $title = $this->_detectMatch[2];
        if ($this->_detectMatch[3]) {
            if (preg_match("/(\s+#([\w\-_]+)\s*)$/", $this->_detectMatch[4], $m)) {
                $this->generator->setId($m[2]);
            }
            $title = rtrim($title);
        } else {
            if (preg_match("/(\s+#([\w\-_]+)\s*)$/", $title, $m)) {
                $title = substr($title, 0, -strlen($m[1]));
                $this->generator->setId($m[2]);
            } else {
                $title = rtrim($title);
            }
        }
        $this->generator->addLine($this->parseInlineContent($title));
    }
}
