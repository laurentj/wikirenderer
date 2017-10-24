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

class Html implements \WikiRenderer\Generator\BlockOfRawLinesInterface
{
    protected $htmlTagName = 'div';

    protected $lines = array();

    protected $id = '';

    public function __construct(\WikiRenderer\Generator\Config $config) {
        if (!$config->htmlEncloseContent) {
            $this->htmlTagName = '';
        }
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
        if ($this->htmlTagName) {
            if ($this->id) {
                $text = '<'.$this->htmlTagName.' id="'.htmlspecialchars($this->id).'">';
            } else {
                $text = '<'.$this->htmlTagName.'>';
            }
        }
        else {
            $text = '';
        }

        foreach ($this->lines as $k => $line) {
            if ($k > 0) {
                $text .= "\n";
            }
            $text .= $line;
        }
        if ($this->htmlTagName) {
            $text .= '</' . $this->htmlTagName . '>';
        }
        return $text;
    }
}
