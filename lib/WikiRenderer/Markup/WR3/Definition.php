<?php

/**
 * wikirenderer3 (wr3) syntax
 *
 * @author Laurent Jouanneau
 * @copyright 2003-2016 Laurent Jouanneau
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

namespace WikiRenderer\Markup\WR3;

/**
 * Parser for definitions block
 */
class Definition extends \WikiRenderer\BlockNG
{
    public $type = 'definition';
    protected $regexp = "/^\s*;(.*) : (.*)/i";

    public function open()
    {
        $this->engine->getConfig()->defaultTextLineContainer = '\WikiRenderer\Markup\WR3\DefinitionTextLine';

        parent::open();
    }

    public function close()
    {
        $this->engine->getConfig()->defaultTextLineContainer = '\WikiRenderer\Markup\WR3\TextLine';
        return parent::close();
    }

    public function validateDetectedLine()
    {
        // $generator is supposed to be a InlineBagGenerator class
        $generator = $this->_renderInlineTag($this->_detectMatch[1]." : ".$this->_detectMatch[2]);
        
        list($term, $definition) = $generator->getGenerators();

        $this->generator->addDefinition($term, $definition);
    }
}
