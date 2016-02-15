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

use WikiRenderer\Generator\BlockDefinitionInterface;

class Definition implements BlockDefinitionInterface
{
    protected $items = array();

    protected $id = '';

    public function setId($id)
    {
        $this->id = $id;
    }

    public function addDefinition(\WikiRenderer\Generator\InlineGeneratorInterface $term,
                                  \WikiRenderer\Generator\GeneratorInterface $definition)
    {
        $this->items[] = array($term, $definition);
    }

    public function isEmpty()
    {
        return count($this->items) == 0;
    }

    public function generate()
    {
        $text = '';
        foreach ($this->items as $k => $generators) {
            list($term, $definition) = $generators;
            $text .= $this->indentation.$term->generate().":\n";
            $definition->indentation = $this->indentation.'   ';
            $text .= $definition->generate()."\n";
        }

        return $text;
    }

    public $indentation = '';
}
