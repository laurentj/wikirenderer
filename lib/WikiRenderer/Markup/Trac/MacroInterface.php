<?php

/**
 * Trac syntax.
 *
 * @author Laurent Jouanneau
 * @copyright 2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */
namespace WikiRenderer\Markup\Trac;

/**
 * interface for Trac macro links.
 */
interface MacroInterface
{
    /**
     * @param string $wikiContent
     * @return bool true if the given wiki content is the macro
     */
    public function match($wikiContent);

    /**
     * returns the generator corresponding to the macro.
     *
     * @param Config $config
     * @param \WikiRenderer\Generator\DocumentGeneratorInterface $generator
     * @param string $wikiContent
     * @return \WikiRenderer\Generator\InlineGeneratorInterface
     */
    public function getContent(\WikiRenderer\Markup\Trac\Config $config,
                        \WikiRenderer\Generator\DocumentGeneratorInterface $generator,
                        $wikiContent);
}
