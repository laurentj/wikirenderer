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

interface BlockDefinitionInterface extends BlockGeneratorInterface {

    /**
     * add a definition
     * 
     * @param InlineGeneratorInterface $term
     * @param GeneratorInterface $definition
     */
    public function addDefinition(InlineGeneratorInterface $term, GeneratorInterface $definition);

}
