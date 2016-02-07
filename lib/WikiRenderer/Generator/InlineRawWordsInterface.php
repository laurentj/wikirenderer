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

interface InlineRawWordsInterface extends InlineGeneratorInterface {

    /**
     * @param string $words  initial words
     */
    public function __construct($words = '');

    /**
     * add original content from the wiki text
     * This content may certainly escaped or something like that
     */
    function addRawContent($words);

    /**
     *
     */
    function addContent(InlineWordsInterface $words);
}
