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
        $linkonly = false;

        $m = array('', '', '', '', '', '', '', '');
        if (preg_match("/^(\s*)([^\s\?]+)(\?[a-zA-Z0-9]+)?(\s*)$/", $href, $m)) {
            if ($m[1] != '' && $m[4] != '') {
                $align = 'center';
            } elseif ($m[1] != '') {
                $align = 'right';
            } elseif ($m[4] != '') {
                $align = 'left';
            }
            $href = $m[2];
            if ($m[3]) {
                if (preg_match("/^\?(\d+)(x(\d+))?$/", $m[3], $m2)) {
                    $width = $height = $m2[1];
                    if (isset($m2[2])) {
                        $height = $m2[3];
                    }
                }
                else if ($m[3] == '?linkonly') {
                    $linkonly = true;
                }
            }
        }
        list($href, $label) = $this->config->processLink($href, $this->name);
        if ($linkonly) {
            $this->generator = $this->documentGenerator->getInlineGenerator('link');
            $this->generator->setAttribute('href', $href);
            $this->generator->setRawContent(($title?:$label));
            return $this->generator;
        }
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
