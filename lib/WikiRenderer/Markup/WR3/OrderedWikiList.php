<?php

/**
 * wikirenderer3 (wr3) syntax.
 *
 * @author Laurent Jouanneau
 * @copyright 2003-2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */
namespace WikiRenderer\Markup\WR3;

use WikiRenderer\Generator\BlockListInterface;

/**
 * Parse a list block.
 */
class OrderedWikiList extends \WikiRenderer\Block
{
    public $type = 'list';

    protected $regexp = "/^(\\s*#)\\s?(.*)/";

    protected $_allowChild = true;

    public function isStarting($string)
    {
        return preg_match($this->regexp, $string, $this->_detectMatch);
    }

    protected function getTypeList() {
        return BlockListInterface::ORDERED_LIST;
    }

    public function open()
    {
        $this->generator->setListType($this->getTypeList());
        $this->generator->createItem();
    }

    public function isAccepting($string)
    {
        if (!preg_match($this->regexp, $string, $this->_detectMatch)) {
            return false;
        }
        return true;
    }

    public function getLineContentForSubBlocks()
    {
        return $this->_detectMatch[2];
    }

    public function getLinePrefixForSubBlocks()
    {
        return $this->_detectMatch[1];
    }

    public function addChildBlock(\WikiRenderer\Generator\GeneratorInterface $child)
    {
        if (!($child instanceof BlockListInterface)) {
            $this->generator->createItem();
        }
        $this->generator->addContentToItem($child);
    }

    public function getAuthorizedChildBlocks()
    {
        return array('list');
    }

    public function validateLine()
    {
        $this->generator->createItem();
        $this->generator->addContentToItem($this->parseInlineContent($this->_detectMatch[2]));
    }
}
