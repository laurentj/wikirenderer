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
 * Parse acronym inline tag.
 */
class Acronym extends \WikiRenderer\InlineTag
{
    protected $name = 'acronym';
    protected $generatorName = 'acronym';
    protected $beginTag = '??';
    protected $endTag = '??';
    protected $attribute = array('$$','title');
    protected $separators = array('|');

    public function getContent()
    {
        $title = $this->getAttributeValue('title');
        if ($title) {
            $this->generator->setTitle($title);
        }

        return $this->generator;
    }
}
