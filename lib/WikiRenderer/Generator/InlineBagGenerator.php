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
use \WikiRenderer\Generator\InlineGeneratorInterface;

/**
 * a simple bag of inline generator. Useful to carry a list of inline generator
 * that can be produced by a single inline tag parser
 */
class InlineBagGenerator implements InlineGeneratorInterface {

    protected $genList = array();

    public function addGenerator(InlineGeneratorInterface $generator) {
        $this->genList[] = $generator;
    }

    public function getGeneratorCount() {
        return count($this->genList);
    }

    public function getGenerators() {
        return $this->genList;
    }

    /**
     * @return string
     */
    public function generate() {
        $content = '';
        foreach($this->genList as $generator) {
            $content .= $generator->generate();
        }
        return $content;
    }
}
