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
class Footnote extends \WikiRenderer\TagXhtml
{
    protected $name = 'footnote';
    public $beginTag = '$$';
    public $endTag = '$$';

    public function getContent()
    {
        $number = count($this->config->footnotes) + 1;
        $id = 'footnote-'.$this->config->footnotesId.'-'.$number;
        $this->config->footnotes[] = "<p>[<a href=\"#rev-$id\" name=\"$id\" id=\"$id\">$number</a>] ".$this->contents[0].'</p>';

        return "<span class=\"footnote-ref\">[<a href=\"#$id\" name=\"rev-$id\" id=\"rev-$id\">$number</a>]</span>";
    }
}
