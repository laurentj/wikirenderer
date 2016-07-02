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

class Preformated implements \WikiRenderer\Generator\BlockOfRawLinesInterface
{
    protected $lines = array();

    protected $id = '';

    protected $preformatIndent = '    ';

    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param string $content
     */
    public function addLine($content)
    {
        $this->lines[] = $content;
    }

    public function isEmpty()
    {
        return count($this->lines) == 0;
    }

    public function generate()
    {
        $text = '';

        foreach ($this->lines as $k => $line) {
            $text .= $this->indentation.$this->preformatIndent.$line."\n";
        }

        return $text;
    }

    public $indentation = '';
}
