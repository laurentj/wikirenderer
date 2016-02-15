<?php

/**
 * jWiki syntax.
 *
 * @author Laurent Jouanneau
 * @copyright 2003-2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */
namespace WikiRenderer\Markup\JWiki;

/**
 * Parser for definitions block.
 */
class Definition extends \WikiRenderer\Markup\WR3\Definition
{
    public function close()
    {
        $this->engine->getConfig()->defaultTextLineContainer = '\WikiRenderer\Markup\DokuWiki\TextLine';

        return parent::close();
    }
}
