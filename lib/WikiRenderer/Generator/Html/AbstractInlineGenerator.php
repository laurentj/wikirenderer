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

abstract class AbstractInlineGenerator implements \WikiRenderer\Generator\InlineComplexGeneratorInterface {

    protected $htmlTagName = '';

    protected $supportedAttributes = array();
    
    protected $content = array();

    protected $attributes = array();

    public function addRawContent($string) {
        $g = new Words();
        $g->addRawContent($string);
        $this->content[] = $g;
    }

    public function addContent(\WikiRenderer\Generator\InlineGeneratorInterface $content) {
        $this->content[] = $content;
    }

    public function setAttribute($name, $value) {
        if (in_array($name, $this->supportedAttributes)) {
            $this->attributes[$name] = $value;
        }
    }

    public function getAttribute($name) {
        if (isset($this->attributes[$name])) {
            return $this->attributes[$name];
        }
        return null;
    }

    /**
     * @return string
     */
    public function generate() {
        $html = '';
        foreach($this->content as $content) {
            $html .= $content->generate();
        }

        $attr = '';
        foreach ($this->attributes as $name => $value) {
            $attr .= ' '.$name.'="'.htmlspecialchars($value).'"';
        }

        return '<'.$this->htmlTagName.$attr.'>'.$html.'</'.$this->htmlTagName.'>';
    }

    public function getChildGenerators() {
        return $this->content;
    }
}
