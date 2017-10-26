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

use WikiRenderer\StringUtils;

/**
 * Parse blockquote block.
 *
 *
 */
class Blockquote extends \WikiRenderer\Block
{
    public $type = 'blockquote';
    protected $regexp = "/^( {0,3})(\\>)( ?)(.*)$/";

    protected $_allowChild = true;

    protected $lineContent = '';

    public function isStarting($line)
    {
        $line = StringUtils::tabExpand($line);
        if (preg_match($this->regexp, $line, $m)) {
            $this->lineContent = $m[4];
            return true;
        }
        return false;
    }

    public function open()
    {
        $this->engine->getConfig()->emptyLineCloseParagraph = false;
    }

    public function isAccepting($line)
    {
        $line = StringUtils::tabExpand($line);
        if (preg_match($this->regexp, $line, $m)) {
            $this->lineContent = $m[4];
            return true;
        }
        return false;
    }

    public function isAcceptingForSubBlocks($line)
    {
        $line = StringUtils::tabExpand($line);
        if (preg_match("/^(\\s*)(\\w|=+)/", $line, $m)) {
            $this->lineContent = $line;
            return true;
        }
        if (preg_match($this->regexp, $line, $m)) {
            $this->lineContent = $m[4];
            return true;
        }
        return false;

    }

    public function getLineContentForSubBlocks()
    {
        return $this->lineContent;
    }

    public function addChildBlock(\WikiRenderer\Generator\GeneratorInterface $child)
    {
        $this->generator->addContent($child);
    }

    public function getAuthorizedChildBlocks()
    {
        return array('blockquote', 'list', 'pre', 'syntaxhighlight', 'html', 'para');
    }

    public function validateLine()
    {
        $this->generator->addContent($this->parseInlineContent($this->lineContent));
    }

}
