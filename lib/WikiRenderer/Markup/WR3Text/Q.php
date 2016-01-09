<?php

/**
 * wikirenderer3 syntax to plain text.
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

namespace WikiRenderer\Markup\WR3Text;

/**
 * ???
 */
class Q extends \WikiRenderer\Tag
{
    public $beginTag = '^^';
    public $endTag = '^^';
    protected $attribute = array('$$','lang','cite');
    public $separators = array('|');

    public function getContent()
    {
        if ($this->separatorCount > 1) {
            return '"'.$this->contents[0].'" ('.$this->contents[2].')';
        } else {
            return '"'.$this->contents[0].'"';
        }
    }
}
