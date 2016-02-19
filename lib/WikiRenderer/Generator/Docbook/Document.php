<?php
/**
 * Docbook generator for WikiRenderer.
 *
 * @author Laurent Jouanneau
 * @copyright 2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */
namespace WikiRenderer\Generator\Docbook;

class Document extends \WikiRenderer\Generator\AbstractDocumentGenerator
{
    public function getDefaultBlock()
    {
        return $this->config->blockGenerators['para'];
    }

    protected $containersStack = array();

    public function addBlock(\WikiRenderer\Generator\BlockGeneratorInterface $block)
    {
        if ($block instanceof \WikiRenderer\Generator\BlockTitleInterface) {
            $level = $block->getLevel();
            if (count($this->containersStack)) {
                $otherTitle = end($this->containersStack)->getFirstBlock();
                if ($otherTitle && $otherTitle instanceof \WikiRenderer\Generator\BlockTitleInterface) {
                    $previousLevel = $otherTitle->getLevel();
                    if ($previousLevel > $level) {
                        $this->popContainer();
                        $this->popContainer();
                        $this->pushContainer(new Section());
                    }
                    elseif ($previousLevel < $level) {
                        $this->pushContainer(new Section());
                    }
                    else {
                        $this->popContainer();
                        $this->pushContainer(new Section());
                    }
                }
            }
            else {
                $this->pushContainer(new Section());
            }
        }
        if (count($this->containersStack)) {
            end($this->containersStack)->addBlock($block);
        }
        else {
            parent::addBlock($block);
        }
    }

    /**
     * @return \WikiRenderer\Generator\BlockGeneratorInterface
     */
    public function getFirstBlock()
    {
        if (count($this->containersStack)) {
            return end($this->containersStack)->getFirstBlock();
        }
        return parent::getFirstBlock();
    }

    /**
     * @return \WikiRenderer\Generator\BlockGeneratorInterface
     */
    public function getPreviousBlock()
    {
        if (count($this->containersStack)) {
            return end($this->containersStack)->getPreviousBlock();
        }
        return parent::getPreviousBlock();
    }

    /**
     * @return \WikiRenderer\Generator\BlockGeneratorInterface
     */
    public function getCurrentBlock()
    {
        if (count($this->containersStack)) {
            return end($this->containersStack)->getCurrentBlock();
        }
        return parent::getCurrentBlock();
    }

    /**
     * @param  \WikiRenderer\Generator\BlocksContainerInterface $container
     */
    public function pushContainer(\WikiRenderer\Generator\BlocksContainerInterface $container) {
        $this->addBlock($container);
        $this->containersStack[] = $container;
    }

    /**
     * @return  \WikiRenderer\Generator\BlocksContainerInterface
     */
    public function popContainer() {
        return array_pop($this->containersStack);
    }

}
