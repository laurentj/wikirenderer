<?php

/**
 * wikirenderer3 (wr3) syntax
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
 * Parse acronym inline tag
 */
class Acronym extends \WikiRenderer\Tag
{
    protected $name = 'acronym';
    protected $generatorName = 'acronym';
    public $beginTag = '??';
    public $endTag = '??';
    protected $attribute = array('$$','title');
    public $separators = array('|');

    public function getContent()
    {
        $title = $this->getAttributeValue('title');
        if ($title) {
            $this->generator->setTitle($title);
        }
        return $this->generator;
    }

}
