<?php

/**
 * Trac syntax.
 *
 * @author Laurent Jouanneau
 * @copyright 2006-2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */
namespace WikiRenderer\Markup\Trac;

/**
 * Parser for a strong and normal emphasys inline tag.
 */
class StrongEm extends \WikiRenderer\Tag
{
    protected $name = 'strongem';
    protected $generatorName = 'em';
    public $beginTag = "'''''";
    public $endTag = "'''''";

    public function getContent()
    {
        parent::getContent();
        $generator = $this->documentGenerator->getInlineGenerator('strong');
        $generator->addContent($this->generator);

        return $generator;
    }
}
