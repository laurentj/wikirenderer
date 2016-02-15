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
 * Parse code inline tag.
 */
class NoWikiInline extends \WikiRenderer\Tag
{
    protected $name = 'nowiki';
    protected $generatorName = 'noformat';
    public $beginTag = '%%';
    public $endTag = '%%';
    protected $convertWordsIn = array();

    public function isOtherTagAllowed()
    {
        return false;
    }
}
