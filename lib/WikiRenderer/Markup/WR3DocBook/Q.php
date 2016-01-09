<?php

/**
 * wikirenderer3 (wr3) syntax to docbook 5.0.
 *
 * @author Laurent Jouanneau
 * @contributor  Amaury Bouchard
 *
 * @copyright 2003-2013 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer\Markup\WR3DocBook;

/**
 * ???
 */
class Q extends \WikiRenderer\TagXhtml
{
    protected $name = 'quote';
    public $beginTag = '^^';
    public $endTag = '^^';
    protected $attribute = array('$$', 'lang', 'cite');
    protected $ignoreAttribute = array('cite');
    public $separators = array('|');
}
