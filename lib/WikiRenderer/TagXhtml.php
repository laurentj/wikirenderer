<?php

/**
 * Wikirenderer is a wiki text parser. It can transform a wiki text into xhtml or other formats.
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

namespace WikiRenderer;

/**
 * Base class for wiki inline tag, to generate XHTML element.
 */
abstract class TagXhtml extends Tag
{
    /** ??? */
    protected $additionnalAttributes = array();
    /** Sometimes, an attribute could not correspond to something in the target format so we could indicate it. */
    protected $ignoreAttribute = array();

    /**
     * ???
     *
     * @return ??? ???
     */
    public function getContent()
    {
        $attr = '';
        $cntattr = count($this->attribute);
        $count = ($this->separatorCount >= $cntattr) ? ($cntattr - 1) : $this->separatorCount;
        $content = '';

        for ($i = 0; $i <= $count; ++$i) {
            if (in_array($this->attribute[$i], $this->ignoreAttribute)) {
                continue;
            }
            if ($this->attribute[$i] != '$$') {
                $attr .= ' '.$this->attribute[$i].'="'.htmlspecialchars($this->wikiContentArr[$i]).'"';
            } else {
                $content = $this->contents[$i];
            }
        }

        foreach ($this->additionnalAttributes as $name => $value) {
            $attr .= ' '.$name.'="'.htmlspecialchars($value).'"';
        }

        return '<'.$this->name.$attr.'>'.$content.'</'.$this->name.'>';
    }

    /**
     * ???
     *
     * @param string $string ???
     *
     * @return string ???
     */
    protected function _doEscape($string)
    {
        return htmlspecialchars($string);
    }
}
