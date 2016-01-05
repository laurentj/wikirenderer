<?php

/**
 * @author Laurent Jouanneau
 *
 * @copyright 2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public 2.1
 * License as published by the Free Software Foundation.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */

namespace WikiRenderer\Generator\Html;
use \WikiRenderer\Generator\BlockDefinitionInterface;

class Definition implements BlockDefinitionInterface {

    protected $items = array();

    public function addDefinition(\WikiRenderer\Generator\InlineGeneratorInterface $term,
                                  \WikiRenderer\Generator\GeneratorInterface $definition) {
        $this->items[] = array($term, $definition);
    }

    public function generate() {
        $text = "<dl>";
        foreach($this->items as $k=>$generators) {
            list($term, $definition) = $generators;
            $text .= "<dt>".$term->generate()."</dt>\n";
            $text .= "<dd>".$definition->generate()."</dd>\n";
        }
        $text .= '</dl>';
        return $text;
    }
}