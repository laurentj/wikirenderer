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

interface InlineWordsInterface extends InlineGeneratorInterface
{
    /**
     * @param string $words initial words
     * @param bool   $raw   false if given words ar generated content,
     *                      false if given words should be escaped
     */
    public function __construct($words = '', $raw = true);

    /**
     * add original content from the wiki text
     * This content may certainly escaped or something like that.
     *
     * @param string $words
     */
    public function addRawContent($words);

    /**
     * Add content that is ready to output.
     *
     * @param string $words
     */
    public function addGeneratedContent($words);
}
