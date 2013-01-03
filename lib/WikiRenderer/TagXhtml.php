<?php
/**
 * Wikirenderer is a wiki text parser. It can transform a wiki text into xhtml or other formats
 * @package WikiRenderer
 * @author Laurent Jouanneau
 * @copyright 2003-2010 Laurent Jouanneau
 * @link http://wikirenderer.jelix.org
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public 2.1
 * License as published by the Free Software Foundation.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 *
 */
namespace WikiRenderer;

/**
 * Base class for wiki inline tag, to generate XHTML element.
 * @package     WikiRenderer
 * @subpackage  core
 */
abstract class TagXhtml extends Tag
{
    /** ??? */
    protected $additionnalAttributes = array();
    /** Sometimes, an attribute could not correspond to something in the target format so we could indicate it. */
    protected $ignoreAttribute = array();

    /**
     * ???
     * @return  ??? ???
     */
    public function getContent()
    {
        $attr = '';
        $cntattr = count($this->attribute);
        $count = ($this->separatorCount >= $cntattr) ? ($cntattr - 1) : $this->separatorCount;
        $content = '';

        for ($i = 0; $i <= $count; $i++) {
            if (in_array($this->attribute[$i], $this->ignoreAttribute))
                continue;
            if ($this->attribute[$i] != '$$')
                $attr.= ' ' . $this->attribute[$i] . '="' . htmlspecialchars($this->wikiContentArr[$i]) . '"';
            else
                $content = $this->contents[$i];
        }

        foreach ($this->additionnalAttributes as $name => $value) {
            $attr .= ' ' . $name . '="' . htmlspecialchars($value) . '"';
        }

        return '<' . $this->name . $attr . '>' . $content . '</' . $this->name . '>';
    }

    /**
     * ???
     * @param   string  $string ???
     * @return  string  ???
     */
    protected function _doEscape($string)
    {
        return htmlspecialchars($string);
    }
}

