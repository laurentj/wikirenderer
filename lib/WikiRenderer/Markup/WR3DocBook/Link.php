<?php

/**
 * wikirenderer3 (wr3) syntax to docbook 5.0.
 *
 * @author Laurent Jouanneau
 * @contributor  Amaury Bouchard
 *
 * @copyright 2003-2013 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer\Markup\WR3DocBook;

/**
 * ???
 */
class Link extends \WikiRenderer\TagXhtml
{
    protected $name = 'link';
    public $beginTag = '[[';
    public $endTag = ']]';
    protected $attribute = array('$$', 'href', 'hreflang', 'title');
    public $separators = array('|');
    protected $ignoreAttribute = array('hreflang', 'title');

    public function getContent()
    {
        $cntattr = count($this->attribute);
        $cnt = ($this->separatorCount + 1 > $cntattr) ? $cntattr : ($this->separatorCount + 1);
        if ($cnt == 1) {
            list($href, $label) = $this->config->processLink($this->wikiContentArr[0], $this->name);

            if (preg_match("/^\#(.+)$/", $href, $m)) {
                return '<link linkend="'.htmlspecialchars($m[1]).'">'.htmlspecialchars($label).'</link>';
            } else {
                return '<link xlink:href="'.htmlspecialchars($href).'">'.htmlspecialchars($label).'</link>';
            }
        } else {
            list($href, $label) = $this->config->processLink($this->wikiContentArr[1], $this->name);
            if (preg_match("/^\#(.+)$/", $href, $m)) {
                return '<link linkend="'.htmlspecialchars($m[1]).'">'.$this->contents[0].'</link>';
            } else {
                return '<link xlink:href="'.htmlspecialchars($href).'">'.$this->contents[0].'</link>';
            }
        }
    }
}
