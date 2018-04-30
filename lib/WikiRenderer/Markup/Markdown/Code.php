<?php

/**
 * Markdown syntax.
 *
 * @author Laurent Jouanneau
 * @copyright 2008-2017 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */
namespace WikiRenderer\Markup\Markdown;

/**
 * Parse code inline tag.
 */
class Code extends \WikiRenderer\InlineTag
{
    protected $name = 'code';
    protected $generatorName = 'code';
    protected $beginTag = '```';
    protected $endTag = '```';

    public function isOtherTagAllowed()
    {
        return false;
    }

    public function getContent()
    {
        $this->generator->setRawContent(trim($this->wikiContent));

        return $this->generator;
    }

}
