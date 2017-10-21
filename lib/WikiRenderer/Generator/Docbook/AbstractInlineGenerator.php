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

abstract class AbstractInlineGenerator implements \WikiRenderer\Generator\InlineComplexGeneratorInterface
{
    protected $dbTagName = '';

    protected $supportedAttributes = array('id');

    protected $content = array();

    protected $attributes = array();

    /**
     * @var null|\WikiRenderer\Generator\Config
     */
    protected $config = null;

    public function __construct(\WikiRenderer\Generator\Config $config) {
        $this->config = $config;
    }

    public function addRawContent($string)
    {
        $g = new Words($this->config);
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

        return null;
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
        $html = '';
        foreach ($this->content as $content) {
            $html .= $content->generate();
        }

        $attr = '';
        foreach ($this->attributes as $name => $value) {
            if ($name == 'id') {
                $name = 'xml:id';
            }
            $attr .= ' '.$name.'="'.htmlspecialchars($value, ENT_XML1).'"';
        }

        return '<'.$this->dbTagName.$attr.'>'.$html.'</'.$this->dbTagName.'>';
    }

    public function getChildGenerators()
    {
        return $this->content;
    }
}
