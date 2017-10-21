<?php

/**
 * @author Laurent Jouanneau
 * @copyright 2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */
namespace WikiRenderer\Generator\Html;

class Words implements \WikiRenderer\Generator\InlineWordsInterface
{
    protected $content = array();

    public function __construct(\WikiRenderer\Generator\Config $config) {

    }

    public function init($words = '', $raw = true)
    {
        if ($words == '') {
            return;
        }
        if ($raw) {
            $this->content[] = htmlspecialchars($words);
        } else {
            $this->content[] = $words;
        }
    }

    public function addRawContent($string)
    {
        $this->content[] = htmlspecialchars($string);
    }

    public function addGeneratedContent($string)
    {
        $this->content[] = $string;
    }

    public function isEmpty()
    {
        return count($this->content) == 0;
    }

    /**
     * @return string
     */
    public function generate()
    {
        return implode('', $this->content);
    }
}
