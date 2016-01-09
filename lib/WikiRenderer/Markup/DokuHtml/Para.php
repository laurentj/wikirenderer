<?php

/**
 * dokuwiki syntax to xhtml.
 *
 * @author Laurent Jouanneau
 * @copyright 2008-2012 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer\Markup\DokuHtml;

/**
 * traite les signes de type paragraphe.
 */
class Para extends \WikiRenderer\Block
{
    public $type = 'para';
    protected $_openTag = '<p>';
    protected $_closeTag = '</p>';

    public function detect($string, $inBlock = false)
    {
        if ($string == '') {
            return false;
        }
        if (preg_match("/^\s+[\*\-\=\|\^>;<=~]/", $string)) {
            return false;
        }
        if (preg_match("/^\s*((\*\*|[^\*\-\=\|\^>;<=~]).*)/", $string, $m)) {
            $this->_detectMatch = array($m[1], $m[1]);

            return true;
        }

        return false;
    }
}
