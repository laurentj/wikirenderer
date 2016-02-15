<?php

/**
 * Configuration for a generator.
 *
 * @author Laurent Jouanneau
 * @contributor  Amaury Bouchard
 *
 * @copyright 2003-2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */
namespace WikiRenderer\Generator;

/**
 * Base class for the configuration.
 */
abstract class Config
{
    /**
     * Indicate to WikiRenderer to generate directly the header and the footer
     * after the parsing. Set to false if you want to call yourself
     * methods generateHeader() and generateFooter() on the document generator.
     *
     * @var bool
     */
    public $generateHeaderFooter = true;

    public $inlineGenerators = array();

    public $blockGenerators = array();
}
