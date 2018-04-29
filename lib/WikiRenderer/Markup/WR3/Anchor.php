<?php

/**
 * wikirenderer3 (wr3) syntax.
 *
 * @author Laurent Jouanneau
 * @copyright 2003-2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */
namespace WikiRenderer\Markup\WR3;

/**
 * Parse anchor inline tag.
 */
class Anchor extends \WikiRenderer\InlineTag
{
    protected $name = 'anchor';
    protected $generatorName = 'anchor';
    protected $beginTag = '~~';
    protected $endTag = '~~';
    protected $attribute = array('name');
    protected $separators = array('|');

    public function getContent()
    {
        $this->generator->setAttribute('anchor', $this->wikiContentArr[0]);

        return $this->generator;
    }
}
