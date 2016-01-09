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

class Strong extends \WikiRenderer\TagXml
{
    protected $name = 'emphasis';
    public $beginTag = '**';
    public $endTag = '**';
    protected $additionnalAttributes = array('role' => 'strong');
}
