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

interface BlockTitleInterface extends BlockGeneratorInterface
{
    /**
     * Level of the title. Lower is bigger.
     * @param integer $level
     * @return
     */
    public function setLevel($level);

    /**
     * @return integer Level of the title
     */
    public function getLevel();

    /**
     * content of the title.
     * @param InlineGeneratorInterface $content
     * @return
     */
    public function addLine(InlineGeneratorInterface $content);
}
