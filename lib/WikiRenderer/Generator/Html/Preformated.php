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

class Preformated implements \WikiRenderer\Generator\BlockOfRawLinesInterface
{
    protected $htmlTagName = 'pre';

    protected $lines = array();

    protected $id = '';

    public function __construct(\WikiRenderer\Generator\Config $config) {
    }

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
        if ($this->id) {
            $text = '<'.$this->htmlTagName.' id="'.htmlspecialchars($this->id).'">';
        } else {
            $text = '<'.$this->htmlTagName.'>';
        }

        foreach ($this->lines as $k => $line) {
            $text .= htmlspecialchars($line)."\n";
        }
        $text .= '</'.$this->htmlTagName.'>';

        return $text;
    }
}
