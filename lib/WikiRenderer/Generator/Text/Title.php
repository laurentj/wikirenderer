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

class Title implements \WikiRenderer\Generator\BlockTitleInterface
{
    protected $htmlTagName = 'h';

    protected $lines = array();

    protected $level = 1;

    protected $id = '';

    public function __construct(\WikiRenderer\Generator\Config $config) {
    }

    public function setLevel($level)
    {
        $this->level = $level;
    }

    public function getLevel()
    {
        return $this->level;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function addLine(\WikiRenderer\Generator\InlineGeneratorInterface $content)
    {
        $this->lines[] = $content;
    }

    public function isEmpty()
    {
        return count($this->lines) == 0;
    }

    public $motif = array('=', '*', ':', '-', '.', '.');

    public function generate()
    {
        $text = $this->indentation;

        foreach ($this->lines as $k => $generator) {
            $text .= $generator->generate();
        }

        return $text."\n".$this->indentation.str_repeat($this->motif[$this->level - 1], strlen($text));
    }

    public $indentation = '';
}
