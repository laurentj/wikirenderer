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
class Footnote extends \WikiRenderer\Tag
{
    public $beginTag = '$$';
    public $endTag = '$$';

    public function getContent()
    {
        return ' ('.$this->contents[0].')';
    }
}
