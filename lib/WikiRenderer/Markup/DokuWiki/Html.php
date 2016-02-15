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
 * Parser for file content.
 */
class Html extends NoWiki
{
    public $type = 'html';
    protected $tagName = 'html';

    public function validateDetectedLine()
    {
        $this->generator->addLine($this->_detectMatch);
    }
}
