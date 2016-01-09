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

class Image extends \WikiRenderer\TagXhtml
{
    protected $name = 'image';
    public $beginTag = '{{';
    public $endTag = '}}';
    protected $attribute = array('fileref', 'title');
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
        $tag = '<img src="'.$href.'"';
        if ($width != '') {
            $tag .= ' width="'.$width.'"';
        }
        if ($height != '') {
            $tag .= ' height="'.$height.'"';
        }
        if ($align != '') {
            $tag .= ' align="'.$align.'"';
        }
        if ($title != '') {
            $tag .= ' title="'.htmlspecialchars($title).'"';
        }

        return $tag.' />';
    }
}
