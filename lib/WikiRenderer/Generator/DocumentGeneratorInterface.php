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

namespace WikiRenderer\Generator;

interface DocumentGeneratorInterface {

    public function __construct(Config $config);

    /**
     * @return Config
     */
    public function getConfig();

    /**
     * Returns a generator corresponding to the given type
     *
     * @return InlineGeneratorInterface
     */
    public function getInlineGenerator($type);

    /**
     * Returns a generator corresponding to the given type
     * 
     * @return BlockGeneratorInterface
     */
    public function getBlockGenerator($type);

    /**
     * Add content to the header. May be used by a parser.
     *
     */
    public function addHeader(GeneratorInterface $header);

    /**
     * Add content to the footer. May be used by a parser.
     * example: footnotes
     *
     */
    public function addFooter(GeneratorInterface $header);

    /**
     * Generate the header
     * @return string
     */
    public function generateHeader();

    /**
     * Generate the footer
     * @return string
     */
    public function generateFooter();
}
