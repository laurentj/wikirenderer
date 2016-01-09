<?php

/**
 * dokuwiki syntax to docbook 5.0.
 *
 * @author Laurent Jouanneau
 * @copyright 2008 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer\Markup\DokuDocBook;

class Pre extends \WikiRenderer\Block
{
    public $type = 'pre';
    protected $_openTag = '<literallayout>';
    protected $_closeTag = '</literallayout>';

    public function detect($string, $inBlock = false)
    {
        if ($string == '') {
            return false;
        }
        if (preg_match("/^(\s{2,}[^\s\*\-\=\|\^>;<=~].*)/", $string)) {
            $this->_detectMatch = array($string,$string);

            return true;
        }

        return false;
    }
}
