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

interface InlineRawWordsInterface extends InlineGeneratorInterface
{
    /**
     * @param string $words initial words
     */
    public function init($words = '');

    /**
     * add original content from the wiki text
     * This content may certainly escaped or something like that.
     * @param string $words
     * @return
     */
    public function addRawContent($words);

    /**
     * @param InlineWordsInterface $words
     * @return
     */
    public function addContent(InlineWordsInterface $words);
}
