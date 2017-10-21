<?php

/**
 * Configuration for an TEXT generator.
 *
 * @author Laurent Jouanneau
 * @copyright 2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */
namespace WikiRenderer\Generator\Text;

class Words implements \WikiRenderer\Generator\InlineWordsInterface
{
    protected $content = '';

    public function __construct(\WikiRenderer\Generator\Config $config) {

    }

    public function init($words = '', $raw = true)
    {
        $this->content = $words;
    }

    public function addRawContent($string)
    {
        $this->content .= $string;
    }

    public function addGeneratedContent($string)
    {
        $this->content .= $string;
    }

    public function isEmpty()
    {
        return $this->content === '';
    }

    /**
     * @return string
     */
    public function generate()
    {
        return $this->content;
    }
}
