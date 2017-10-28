<?php

/**
 * Wikirenderer is a wiki text parser. It can transform a wiki text into xhtml or other formats.
 *
 * @author Laurent Jouanneau
 * @copyright 2003-2008 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */
namespace WikiRenderer;

/**
 * ???
 */
class TextLineContainer
{
    /** @var \WikiRenderer\InlineTag */
    public $tag = null;

    /**
     * List of string tags that starts allowed inline tags.
     *
     * Filled automatically when InlineParser is processing the configuration.
     */
    public $allowedTags = array();

    /**
     * The regexp used to split a line between all start/end string tags.
     *
     * Filled automatically when InlineParser is processing the configuration.
     */
    public $pattern = '';
}
