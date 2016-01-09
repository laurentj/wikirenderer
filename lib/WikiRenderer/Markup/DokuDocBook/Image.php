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

class Image extends \WikiRenderer\TagXml
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
        $tag = '<inlinemediaobject><imageobject><imagedata fileref="'.htmlspecialchars($href, ENT_NOQUOTES).'"';
        if ($width != '') {
            $tag .= ' contentwidth="'.$width.'px"';
        }
        if ($height != '') {
            $tag .= ' contentdepth="'.$height.'px"';
        }
        if ($align != '') {
            $tag .= ' align="'.$align.'"';
        }

        $tag .= '/></imageobject>';
        if ($title != '') {
            $tag .= '<textobject><phrase>'.htmlspecialchars($title, ENT_NOQUOTES).'</phrase></textobject>';
        }

        return $tag.'</inlinemediaobject>';
    }
}
