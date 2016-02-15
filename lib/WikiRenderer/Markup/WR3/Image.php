<?php

/**
 * wikirenderer3 (wr3) syntax.
 *
 * @author Laurent Jouanneau
 * @copyright 2003-2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */
namespace WikiRenderer\Markup\WR3;

/**
 * Parser for an image inline tag.
 */
class Image extends \WikiRenderer\Tag
{
    protected $name = 'image';
    protected $generatorName = 'image';
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
        if ($cnt >= 3) {
            if ($contents[2] == 'l' || $contents[2] == 'L' || $contents[2] == 'g' || $contents[2] == 'G') {
                $this->wikiContentArr[2] = 'left';
            } elseif ($contents[2] == 'r' || $contents[2] == 'R' || $contents[2] == 'd' || $contents[2] == 'D') {
                $this->wikiContentArr[2] = 'right';
            } else {
                $this->wikiContentArr[2] = '';
            }
        }

        list($href, $label) = $this->config->getLinkProcessor()->processLink($contents[0], $this->generatorName);
        $this->wikiContentArr[0] = $href;
        if ($cnt == 1 && $href != $label) {
            $this->wikiContentArr[1] = $label;
            ++$this->separatorCount;
        }

        return parent::getContent();
    }
}
