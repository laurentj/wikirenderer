<?php

/**
 * class transforming arrows using typography
 *
 * @author Laurent Jouanneau
 * @copyright 2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer\SimpleTag;


class Arrows extends AbstractSimpleTag {

    protected $regexpSubPattern = "<->|<=>|->|<-|=>|<=|>>|<<|---|--";

    function getPossibleTags() {
        return array('->', '<-', '<->', '=>', '<=', '<=>', '>>', '<<', '--', '---');
    }

    protected $arrows = array('->' => '→', '<-' => '←', '<->' => '↔',
                              '=>' => '⇒', '<=' => '⇐', '<=>' => '⇔',
                              '>>' => '»', '<<' => '«', '--' => '–', '---' => '—');

    public function getContent(\WikiRenderer\Generator\DocumentGeneratorInterface $documentGenerator, $token) {
        $word = $documentGenerator->getInlineGenerator('words');
        $word->addRawContent($this->arrows[$token]);
        return $word;
    }
}