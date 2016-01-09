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

interface BlockTitleInterface extends BlockGeneratorInterface {

    /**
     * Level of the title. Lower is bigger
     */
    public function setLevel($level);

    /**
     * content of the title
     */
    public function addLine(InlineGeneratorInterface $content);

}
