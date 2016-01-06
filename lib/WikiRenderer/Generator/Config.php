<?php

/**
 * Configuration for a generator
 *
 * @author Laurent Jouanneau
 * @contributor  Amaury Bouchard
 *
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

namespace WikiRenderer\Generator;

/**
 * Base class for the configuration.
 */
abstract class Config
{
    /**
     * Indicate to WikiRenderer to generate directly the header and the footer
     * after the parsing. Set to false if you want to call yourself
     * methods generateHeader() and generateFooter() on the document generator
     *
     * @var boolean
     */
    public $generateHeaderFooter = true;

    public $inlineGenerators = array();

    public $blockGenerators = array();
}
