<?php

/**
 * classic wikirenderer syntax to Wikirenderer 3 syntax.
 *
 * @author Laurent Jouanneau
 * @copyright 2003-2014 Laurent Jouanneau
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

namespace WikiRenderer\Markup\WRWR3;

class Config extends \WikiRenderer\Config
{
    public $defaultTextLineContainer = '\WikiRenderer\TextLine';

    public $textLineContainers = array(
            '\WikiRenderer\TextLine' => array(
                '\WikiRenderer\Markup\WRWR3\Strong',
                '\WikiRenderer\Markup\WRWR3\Em',
                '\WikiRenderer\Markup\WRWR3\Code',
                '\WikiRenderer\Markup\WRWR3\Q',
                '\WikiRenderer\Markup\WRWR3\Cite',
                '\WikiRenderer\Markup\WRWR3\Acronym',
                '\WikiRenderer\Markup\WRWR3\Link',
                '\WikiRenderer\Markup\WRWR3\Image',
                '\WikiRenderer\Markup\WRWR3\Anchor',
            ),
        );

    /**
     * liste des balises de type bloc reconnus par WikiRenderer.
     */
    public $blocktags = array(
        '\WikiRenderer\Markup\WRWR3\Title',
        '\WikiRenderer\Markup\WRWR3\WikiList',
        '\WikiRenderer\Markup\WRWR3\Pre',
        '\WikiRenderer\Markup\WRWR3\Hr',
        '\WikiRenderer\Markup\WRWR3\Blockquote',
        '\WikiRenderer\Markup\WRWR3\Definition',
        '\WikiRenderer\Markup\WRWR3\Table',
        '\WikiRenderer\Markup\WRWR3\P', );

    public $simpletags = array('%%%' => "\n");

    public $outputEscapeChar = true;
}
