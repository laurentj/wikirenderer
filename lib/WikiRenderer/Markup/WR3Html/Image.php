<?php

/**
 * wikirenderer3 (wr3) syntax to xhtml.
 *
 * @author Laurent Jouanneau
 * @copyright 2003-2006 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer\Markup\WR3Html;

/**
 * ???
 */
class Image extends \WikiRenderer\TagXhtml
{
    protected $name = 'image';
    public $beginTag = '((';
    public $endTag = '))';
    protected $attribute = array('src', 'alt', 'align', 'longdesc');
    public $separators = array('|');

    public function getContent()
    {
        $contents = $this->wikiContentArr;
        $cnt = count($contents);
        $attribut = '';
        if ($cnt > 4) {
            $cnt = 4;
        }
        switch ($cnt) {
            case 4:
                $attribut .= ' longdesc="'.$contents[3].'"';
            case 3:
                if ($contents[2] == 'l' || $contents[2] == 'L' || $contents[2] == 'g' || $contents[2] == 'G') {
                    $attribut .= ' style="float:left;"';
                } elseif ($contents[2] == 'r' || $contents[2] == 'R' || $contents[2] == 'd' || $contents[2] == 'D') {
                    $attribut .= ' style="float:right;"';
                }
            case 2:
                $attribut .= ' alt="'.$contents[1].'"';
            case 1:
            default:
                list($href, $label) = $this->config->processLink($contents[0], $this->name);
                $attribut .= ' src="'.htmlspecialchars($href).'"';
                if ($cnt == 1) {
                    $attribut .= ' alt=""';
                }
        }

        return '<img'.$attribut.'/>';
    }
}
