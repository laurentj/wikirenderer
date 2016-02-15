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

class SyntaxHighlighting implements \WikiRenderer\Generator\BlockSyntaxHighlightingInterface
{
    protected $lines = array();

    protected $id = '';

    public function setId($id)
    {
        $this->id = $id;
    }

    protected $syntax = '';

    protected $filename = '';

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
            $text = '<programlisting xml:id="'.htmlspecialchars($this->id, ENT_XML1).'"';
        } else {
            $text = '<programlisting';
        }

        if ($this->syntax) {
            $text .= ' language="'.$this->syntax.'"';
        }
        $text .= '>';
        if ($this->filename) {
            $text .= '<filename>'.htmlspecialchars($this->filename, ENT_XML1)."</filename>\n";
        }
        foreach ($this->lines as $k => $line) {
            if ($k > 0) {
                $text .= "\n";
            }
            $text .= htmlspecialchars($line, ENT_XML1);
        }
        $text .= '</programlisting>';

        return $text;
    }
}
