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

class SyntaxHighlighting implements \WikiRenderer\Generator\BlockSyntaxHighlightingInterface
{
    protected $htmlTagName = 'pre';

    protected $lines = array();

    protected $id = '';

    protected $syntax = '';

    protected $syntaxClass = 'syntax-%s';

    protected $filename = '';

    public function __construct(\WikiRenderer\Generator\Config $config) {
        $this->syntaxClass = $config->syntaxClassPattern;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function addLine($content)
    {
        $this->lines[] = $content;
    }

    public function setSyntaxType($type)
    {
        $this->syntax = $type;
    }

    public function getSyntaxType()
    {
        return $this->syntax;
    }

    public function setFileName($filename)
    {
        $this->filename = $filename;
    }

    public function getFileName()
    {
        return $this->filename;
    }

    public function isEmpty()
    {
        return count($this->lines) == 0;
    }

    public function generate()
    {
        if ($this->id) {
            $text = '<pre id="'.htmlspecialchars($this->id).'">';
        } else {
            $text = '<'.$this->htmlTagName.'>';
        }
        if ($this->filename) {
            $text .= '<span class="code-filename">'.htmlspecialchars($this->filename)."</span><br/>\n";
        }
        $text .= '<code';
        if ($this->syntax) {
            $text .= ' class="'.sprintf($this->syntaxClass, $this->syntax).'"';
        }
        $text .= '>';
        foreach ($this->lines as $k => $line) {
            $text .= htmlspecialchars($line)."\n";
        }
        $text .= '</code></pre>';

        return $text;
    }
}
