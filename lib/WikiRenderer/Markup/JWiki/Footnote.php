<?php

/**
 * JWiki syntax.
 * 
 * @author Laurent Jouanneau
 * @copyright 2008-2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */
namespace WikiRenderer\Markup\JWiki;

/**
 * Parser for footnote inline tag.
 */
class Footnote extends \WikiRenderer\InlineTag
{
    protected $name = 'footnote';
    protected $generatorName = 'footnotelink';
    protected $beginTag = '$$';
    protected $endTag = '$$';

    public function __construct(\WikiRenderer\Config $config, \WikiRenderer\Generator\DocumentGeneratorInterface $generator)
    {
        parent::__construct($config, $generator);

        $footnotes = $generator->getMetaData('footnotes');
        if (!$footnotes) {
            $footnotes = $generator->getBlockGenerator('footnotes');
            $generator->setMetaData('footnotes', $footnotes);
        }
        $this->generator->setFootNotes($footnotes);
    }

}
