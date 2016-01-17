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

    protected $glue;

    /**
     * @param InlineGeneratorInterface[]
     */
    public function __construct($glue = '', $list=array()) {
        $this->genList = $list;
        $this->glue = $glue;
    }
    
    public function addGenerator(InlineGeneratorInterface $generator) {
        $this->genList[] = $generator;
    }

    public function getGeneratorCount() {
        return count($this->genList);
    }

    public function getGenerators() {
        return $this->genList;
    }

    public function isEmpty() {
        return count($this->genList) == 0;
    }

    /**
     * @return string
     */
    public function generate() {
        $content = '';
        foreach($this->genList as $k => $generator) {
            if ($k > 0) {
                $content .= $this->glue;
            }
            $content .= $generator->generate();
        }
        return $content;
    }
}
