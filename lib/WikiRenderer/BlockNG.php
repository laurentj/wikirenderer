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

namespace WikiRenderer;

/**
 * Base class to parse block elements.
 */
abstract class BlockNG extends Block
{

    /**
     * @var \WikiRenderer\Generator\BlockGeneratorInterface
     */
    protected $generator;

    /**
     * @var \WikiRenderer\Generator\DocumentGeneratorInterface
     */
    protected $documentGenerator;

    public function __construct(Renderer $wr, \WikiRenderer\Generator\DocumentGeneratorInterface $generator)
    {
        $this->engine = $wr;
        $this->generator = $generator->getBlockGenerator($this->type);
        $this->documentGenerator = $generator;
    }

    public function validateDetectedLine()
    {
        $this->generator->addContent($this->_renderInlineTag($this->_detectMatch[1]));
    }

    public function close()
    {
        return $this->generator;
    }

    public function __clone() {
        $this->generator = clone $this->generator;
    }

}