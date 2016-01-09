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

interface InlineWordsInterface extends InlineGeneratorInterface {

    /**
     * add original content from the wiki text
     * This content may certainly escaped or something like that
     */
    function addRawContent($words);

    /**
     * Add content that is ready to output
     */
    function addGeneratedContent($words);
}
