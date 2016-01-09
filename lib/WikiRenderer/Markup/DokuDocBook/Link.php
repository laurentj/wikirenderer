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

class Link extends \WikiRenderer\TagXml
{
    protected $name = 'link';
    public $beginTag = '[[';
    public $endTag = ']]';
    protected $attribute = array('href', '$$');
    public $separators = array('|');

    public function getContent()
    {
        $cntattr = count($this->attribute);
        $cnt = (($this->separatorCount + 1) > $cntattr) ? $cntattr : ($this->separatorCount + 1);
        list($href, $label) = $this->config->processLink($this->wikiContentArr[0], $this->name);
        if ($cnt == 1) {
            $label = htmlspecialchars($label, ENT_NOQUOTES);
        } else {
            $label = $this->contents[1];
        }
        if ($href == '#' || $href == '') {
            return $label;
        }
        if (preg_match("/^\#(.+)$/", $href, $m)) {
            return '<link linkend="'.htmlspecialchars(trim($m[1])).'">'.$label.'</link>';
        } else {
            return '<link xlink:href="'.htmlspecialchars(trim($href)).'">'.$label.'</link>';
        }
    }
}
