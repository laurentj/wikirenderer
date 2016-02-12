<?php

/**
 * @author Laurent Jouanneau
 *
 * @copyright 2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer\Generator;

trait BlocksContainerTrait {

    protected $blocksList = array();

    public function isEmpty() {
        return !count($this->blocksList);
    }

    public function generate() {
        return implode("\n", array_map(function($generator) {
            return $generator->generate();
        }, $this->blocksList));
    }

    public function addBlock(BlockGeneratorInterface $block) {
        $this->blocksList[] = $block;
    }

    /**
     * @return BlockGeneratorInterface
     */
    public function getPreviousBlock() {
        $c = count($this->blocksList);
        if ($c > 1) {
            return $this->blocksList[$c-2];
        }
        return null;
    }

    /**
     * @return BlockGeneratorInterface
     */
    public function getCurrentBlock() {
        if (count($this->blocksList)) {
            return end($this->blocksList);
        }
        return null;
    }
}
