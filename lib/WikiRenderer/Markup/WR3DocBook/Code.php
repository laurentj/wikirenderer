<?php

/**
 * wikirenderer3 (wr3) syntax to docbook 5.0.
 *
 * @author Laurent Jouanneau
 * @contributor  Amaury Bouchard
 *
 * @copyright 2003-2013 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer\Markup\WR3DocBook;

/**
 * ???
 */
class Code extends \WikiRenderer\TagXhtml
{
    protected $name = 'code';
    public $beginTag = '@@';
    public $endTag = '@@';

    public function getContent()
    {
        $code = $this->wikiContentArr[0];

        return '<code>'.htmlspecialchars($code).'</code>';
    }

    public function isOtherTagAllowed()
    {
        return false;
    }
}
