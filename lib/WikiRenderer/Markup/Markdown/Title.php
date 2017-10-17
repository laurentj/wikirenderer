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
 * Parse a title block.
 */
class Title extends \WikiRenderer\Block
{
    public $type = 'title';
    protected $regexp = "/^\s*(#+)(\s+(.*)|\s*$)/";
    protected $_closeNow = true;
    protected $_minlevel = 1;

    public function isStarting($blockLine)
    {
        $found = preg_match($this->regexp, $blockLine, $this->_detectMatch);
        if ($found && strlen($this->_detectMatch[1]) > 6 ) {
            return false;
        }
        return $found;
    }

    public function validateLine()
    {
        $hx = $this->_minlevel + strlen($this->_detectMatch[1]) - 1;
        $this->generator->setLevel($hx);
        $text = isset($this->_detectMatch[3])?$this->_detectMatch[3]:'';
        if (preg_match("/(\s+|\s+#+\s*|^#+\s*)$/", $text, $m)) {
            $text = substr($text, 0, - strlen($m[1]));
        }
        $this->generator->addLine($this->_renderInlineTag($text));
    }
}
