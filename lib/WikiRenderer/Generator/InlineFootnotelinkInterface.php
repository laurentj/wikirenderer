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

interface InlineFootnotelinkInterface extends InlineComplexGeneratorInterface
{
    /**
     * generate the content of the footnote, that will be insert into the footer
     * @return string
     */
    public function generateFootnote();
}
