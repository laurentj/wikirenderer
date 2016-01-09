<?php

/**
 * wikirenderer3 (wr3) syntax to docbook 5.
 *
 * @author Laurent Jouanneau
 * @copyright 2014 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer\Markup\WR3DocBook;

/**
 *
 */
class DefaultBlock extends \WikiRenderer\Block
{
    public $type = 'default';
    protected $_openTag = '<para>';
    protected $_closeTag = '</para>';

    public function detect($string, $inBlock = false)
    {
        $this->_detectMatch = array($string, $string);

        return true;
    }
}
