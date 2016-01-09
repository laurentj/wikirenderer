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

class Superscript extends \WikiRenderer\TagXml
{
    protected $name = 'superscript';
    public $beginTag = '<sup>';
    public $endTag = '</sup>';
}
