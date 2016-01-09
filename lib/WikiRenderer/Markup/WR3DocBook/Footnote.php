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
class Footnote extends \WikiRenderer\TagXhtml
{
    protected $name = 'footnote';
    public $beginTag = '$$';
    public $endTag = '$$';

    public function getContent()
    {
        return '<footnote><para>'.$this->contents[0].'</para></footnote>';
    }
}
