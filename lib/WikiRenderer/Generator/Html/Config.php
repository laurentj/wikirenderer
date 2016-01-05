<?php

/**
 * Configuration for an HTML generator
 *
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

/**
 * Base class for the configuration.
 */
class Config extends \WikiRenderer\Generator\Config
{
    public $inlineGenerators = array(
        'textline' => '\WikiRenderer\Generator\Html\TextLine',
        'strong'   => '\WikiRenderer\Generator\Html\Strong',
        'em'       => '\WikiRenderer\Generator\Html\Em',
        'code'     => '\WikiRenderer\Generator\Html\Code',
        'quote'    => '\WikiRenderer\Generator\Html\Quote',
        'cite'     => '\WikiRenderer\Generator\Html\Cite',
        'acronym'  => '\WikiRenderer\Generator\Html\Acronym',
        'link'     => '\WikiRenderer\Generator\Html\Link',
        'image'    => '\WikiRenderer\Generator\Html\Image',
        'anchor'   => '\WikiRenderer\Generator\Html\Anchor',
    );

    public $blockGenerators = array(
        'title'      => '\WikiRenderer\Generator\Html\Title',
        'list'       => '\WikiRenderer\Generator\Html\HtmlList',
        'pre'        => '\WikiRenderer\Generator\Html\Preformated',
        'blockquote' => '\WikiRenderer\Generator\Html\BlockQuote',
        'hr'         => '\WikiRenderer\Generator\Html\Hr',
        'para'       => '\WikiRenderer\Generator\Html\Paragraph',
        'definition' => '\WikiRenderer\Generator\Html\Definition',
        'table'      => '\WikiRenderer\Generator\Html\Table',
    );
}