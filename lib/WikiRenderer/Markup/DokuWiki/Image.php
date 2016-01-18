<?php

/**
 * DokuWiki syntax
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
 * Parser for an image inline tag
 */
class Image extends \WikiRenderer\TagNG
{
    protected $name = 'image';
    protected $generatorName = 'image';
    public $beginTag = '{{';
    public $endTag = '}}';
    protected $attribute = array('filesrc', 'title');
    public $separators = array('|');

    public function getContent()
    {
        $contents = $this->wikiContentArr;
        if (count($contents) == 1) {
            $href = $contents[0];
            $title = '';
        } else {
            $href = $contents[0];
            $title = $contents[1];
        }

        $align = '';
        $width = '';
        $height = '';

        $m = array('', '', '', '', '', '', '', '');
        if (preg_match("/^(\s*)([^\s\?]+)(\?(\d+)(x(\d+))?)?(\s*)$/", $href, $m)) {
            if ($m[1] != '' && $m[7] != '') {
                $align = 'center';
            } elseif ($m[1] != '') {
                $align = 'right';
            } elseif ($m[7] != '') {
                $align = 'left';
            }
            if ($m[3]) {
                $width = $height = $m[4];
                if ($m[5]) {
                    $height = $m[6];
                }
            }
            $href = $m[2];
        }
        list($href, $label) = $this->config->processLink($href, $this->name);
        $this->generator->setAttribute('src', $href);       
        if ($width != '') {
            $this->generator->setAttribute('width', $width);
        }
        if ($height != '') {
            $this->generator->setAttribute('height', $height);
        }
        if ($align != '') {
            $this->generator->setAttribute('align', $align);
        }
        if ($title != '') {
            $this->generator->setAttribute('alt', $title);
        }

        return $this->generator;
    }
}
