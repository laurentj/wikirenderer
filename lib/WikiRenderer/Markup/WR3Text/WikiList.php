<?php

/**
 * wikirenderer3 syntax to plain text.
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

namespace WikiRenderer\Markup\WR3Text;

/**
 * ???
 */
class WikiList extends \WikiRenderer\Block
{
    public $type = 'list';
    protected $regexp = "/^\s*([\*#-]+)(.*)/";

    public function validateDetectedLine()
    {
        $this->text[] = $this->_detectMatch[1].$this->_renderInlineTag($this->_detectMatch[2]);
    }
}
