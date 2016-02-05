<?php

/**
 * @author Laurent Jouanneau
 *
 * @copyright 2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer\Generator\Docbook;
use \WikiRenderer\Generator\BlockDefinitionInterface;

class Definition implements BlockDefinitionInterface {

    protected $items = array();

    protected $id = '';

    public function setId($id) {
        $this->id = $id;
    }

    public function addDefinition(\WikiRenderer\Generator\InlineGeneratorInterface $term,
                                  \WikiRenderer\Generator\GeneratorInterface $definition) {
        $this->items[] = array($term, $definition);
    }

    public function isEmpty() {
        return count($this->items) == 0;
    }

    public function generate() {
        if ($this->id) {
            $text = '<dl xml:id="'.htmlspecialchars($this->id, ENT_XML1).'">';
        }
        else {
            $text = '<dl>';
        }

        foreach($this->items as $k=>$generators) {
            list($term, $definition) = $generators;
            $text .= "<dt>".$term->generate()."</dt>\n";
            $text .= "<dd>".$definition->generate()."</dd>\n";
        }
        $text .= '</dl>';
        return $text;
    }
}