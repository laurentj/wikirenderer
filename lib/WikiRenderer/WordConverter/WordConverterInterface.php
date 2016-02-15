<?php

/**
 * word converter interface.
 *
 * @author Laurent Jouanneau
 * @copyright 2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */
namespace WikiRenderer\WordConverter;

interface WordConverterInterface
{
    /**
     * @param string $word the word
     *
     * @return bool true if the word can be converted by this word converter
     */
    public function isMatching($word);

    /**
     * @param \WikiRenderer\Generator\DocumentGeneratorInterface $documentGenerator
     * @param string                                             $word              the word to convert
     *
     * @return \WikiRenderer\Generator\InlineGeneratorInterface
     */
    public function getContent(\WikiRenderer\Generator\DocumentGeneratorInterface $documentGenerator,
                               $word);
}
