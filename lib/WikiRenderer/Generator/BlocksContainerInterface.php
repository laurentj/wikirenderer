<?php

/**
 * @author Laurent Jouanneau
 * @copyright 2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */
namespace WikiRenderer\Generator;

interface BlocksContainerInterface extends GeneratorInterface
{
    public function addBlock(BlockGeneratorInterface $block);

    /**
     * @return BlockGeneratorInterface
     */
    public function getPreviousBlock();

    /**
     * @return BlockGeneratorInterface
     */
    public function getCurrentBlock();

    /**
     * @return BlockGeneratorInterface
     */
    public function getFirstBlock();

}
