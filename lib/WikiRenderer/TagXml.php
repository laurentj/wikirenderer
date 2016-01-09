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
 * ???
 */
class TagXml extends TagXhtml
{
    /**
     * ???
     *
     * @param string $string ???
     *
     * @return string ???
     */
    protected function _doEscape($string)
    {
        return htmlspecialchars($string, ENT_NOQUOTES);
    }
}
