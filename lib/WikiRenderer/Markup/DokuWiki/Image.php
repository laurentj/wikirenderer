<?php

/**
 * DokuWiki syntax.
 *
 * @author Laurent Jouanneau
 * @copyright 2008-2018 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */
namespace WikiRenderer\Markup\DokuWiki;

/**
 * Parser for an image inline tag.
 */
class Image extends \WikiRenderer\InlineTagWithSeparator
{
    protected $name = 'image';
    protected $generatorName = 'image';
    protected $beginTag = '{{';
    protected $endTag = '}}';
    protected $attribute = array('filesrc', 'title');
    protected $separators = array('|');

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
                } elseif ($m[3] == '?linkonly') {
                    $linkonly = true;
                }
            }
        }
        list($href, $label) = $this->config->getLinkProcessor()->processLink($href, $this->name);
        if ($linkonly) {
            $this->generator = $this->documentGenerator->getInlineGenerator('link');
            $this->generator->setAttribute('href', $href);
            $this->generator->setRawContent(($title ?: $label));

            return $this->generator;
        }

        $type = 0;
        if (preg_match('/\.([a-zA-Z0-9]+)$/', $href, $m)) {
            $ext = $m[1];
            switch ($ext) {
                case 'mp4' :
                case 'webm':
                case 'ogv':
                    $this->generator = $this->documentGenerator->getInlineGenerator('video');
                    $type = 1;
                    break;
                case 'mp3':
                case 'ogg':
                case 'wav':
                    $this->generator = $this->documentGenerator->getInlineGenerator('audio');
                    $type = 2;
                    break;
                case 'swf':
                    $this->generator = $this->documentGenerator->getInlineGenerator('flash');
                    $type = 3;
                    break;
            }
        }

        $this->generator->setAttribute('src', $href);
        if ($type != 2) {
            if ($width != '') {
                $this->generator->setAttribute('width', $width);
            }
            if ($height != '') {
                $this->generator->setAttribute('height', $height);
            }
        }
        if ($align != '') {
            $this->generator->setAttribute('align', $align);
        }
        if ($title != '') {
            if ($type == 0) {
                $this->generator->setAttribute('alt', $title);
            } else {
                $this->generator->setAttribute('title', $title);
            }
        }

        return $this->generator;
    }
}
