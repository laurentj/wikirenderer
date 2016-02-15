<?php

/**
 * class transforming trademark signs using typography.
 *
 * @author Laurent Jouanneau
 * @copyright 2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */
namespace WikiRenderer\SimpleTag;

class Trademark extends AbstractSimpleTag
{
    protected $regexpSubPattern = '\\((?:tm|c|r)\\)';

    public function getPossibleTags()
    {
        return array('(tm)', '(c)', '(r)');
    }

    protected $marks = array('(c)' => '©', '(tm)' => '™', '(r)' => '®');

    public function getContent(\WikiRenderer\Generator\DocumentGeneratorInterface $documentGenerator, $token)
    {
        $word = $documentGenerator->getInlineGenerator('words');
        $word->addRawContent($this->marks[$token]);

        return $word;
    }
}
