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

abstract class AbstractInlineGenerator implements \WikiRenderer\Generator\InlineComplexGeneratorInterface
{
    protected $supportedAttributes = array('id');

    protected $content = array();

    protected $attributes = array();

    protected $attributesInsideBrackets = array();

    protected $attributesInsideBracketsSeparator = ', ';

    public function addRawContent($string)
    {
        $g = new Words();
        $g->addRawContent($string);
        $this->content[] = $g;
    }

    public function setRawContent($string)
    {
        $this->content = array();
        $this->addRawContent($string);
    }

    public function addContent(\WikiRenderer\Generator\InlineGeneratorInterface $content)
    {
        $this->content[] = $content;
    }

    public function addContentAtStart(\WikiRenderer\Generator\InlineGeneratorInterface $content)
    {
        array_unshift($this->content, $content);
    }

    public function setContent(\WikiRenderer\Generator\InlineGeneratorInterface $content)
    {
        $this->content = array($content);
    }

    public function setAttribute($name, $value)
    {
        if (in_array($name, $this->supportedAttributes)) {
            $this->attributes[$name] = $value;
        }
    }

    public function getAttribute($name)
    {
        if (isset($this->attributes[$name])) {
            return $this->attributes[$name];
        }

        return;
    }

    public function isEmpty()
    {
        return count($this->content) == 0 && count($this->attributes) == 0;
    }

    /**
     * @return string
     */
    public function generate()
    {
        $text = '';
        foreach ($this->content as $content) {
            $text .= $content->generate();
        }
        if (count($this->attributesInsideBrackets)) {
            $parenthesis = '';
            foreach ($this->attributesInsideBrackets as $k => $attr) {
                if ($k > 0 && trim($parenthesis)) {
                    $parenthesis .= $this->attributesInsideBracketsSeparator;
                }
                $parenthesis .= $this->getAttribute($attr);
            }
            $parenthesis = trim($parenthesis);
            if ($parenthesis) {
                $text .= ' ('.$parenthesis.')';
            }
        }

        return $text;
    }

    public function getChildGenerators()
    {
        return $this->content;
    }
}
