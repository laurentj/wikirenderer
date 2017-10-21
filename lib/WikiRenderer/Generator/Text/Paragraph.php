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

class Paragraph implements \WikiRenderer\Generator\BlockParagraphInterface
{
    protected $lines = array();

    protected $id = '';

    public function __construct(\WikiRenderer\Generator\Config $config) {
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

    public function generate()
    {
        $text = '';

        foreach ($this->lines as $k => $generator) {
            if ($k > 0) {
                $text .= "\n";
            }
            $text .= $this->indentation.$generator->generate();
        }

        return $text;
    }

    public $indentation = '';
}
