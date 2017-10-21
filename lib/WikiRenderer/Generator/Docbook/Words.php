<?php

/**
 * @author Laurent Jouanneau
 * @copyright 2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */
namespace WikiRenderer\Generator\Docbook;

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
            $this->content[] = htmlspecialchars($words, ENT_XML1);
        } else {
            $this->content[] = $words;
        }
    }

    public function addRawContent($string)
    {
        $this->content[] = htmlspecialchars($string, ENT_XML1);
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
