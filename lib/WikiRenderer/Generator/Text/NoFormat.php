<?php

/**
 * @author Laurent Jouanneau
 * @copyright 2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */
namespace WikiRenderer\Generator\Text;

class NoFormat implements \WikiRenderer\Generator\InlineRawWordsInterface
{
    protected $content = array();

    public function __construct(\WikiRenderer\Generator\Config $config) {

    }

    public function init($words = '')
    {
        if ($words == '') {
            return;
        }
        $this->content[] = $words;
    }

    public function addRawContent($string)
    {
        $this->content[] = $string;
    }

    public function addContent(\WikiRenderer\Generator\InlineWordsInterface $words)
    {
        $this->content[] = $words->generate();
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
