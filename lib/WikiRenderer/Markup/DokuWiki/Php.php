<?php

/**
 * DokuWiki syntax.
 *
 * @author Laurent Jouanneau
 * @copyright 2008-2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */
namespace WikiRenderer\Markup\DokuWiki;

/**
 * Parser for php content. Executing php is not supported.
 */
class Php extends NoWiki
{
    public $type = 'noformat';
    protected $tagName = 'php';

    public function __construct(\WikiRenderer\Renderer $wr, \WikiRenderer\Generator\DocumentGeneratorInterface $generator)
    {
        parent::__construct($wr, $generator);
        $this->generator = new \WikiRenderer\Generator\DummyBlock($generator->getConfig());
    }

    public function validateLine()
    {
    }
}
