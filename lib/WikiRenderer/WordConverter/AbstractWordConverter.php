<?php

/**
 * word converter abstract class
 *
 * @author Laurent Jouanneau
 * @copyright 2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer\WordConverter;


abstract class AbstractWordConverter implements WordConverterInterface {

    protected $regexp;

    protected $matches = array();

    public function isMatching($word) {
        return preg_match($this->regexp, $word, $this->matches);
    }

    abstract public function getContent(\WikiRenderer\Generator\DocumentGeneratorInterface $documentGenerator, $word);

}
