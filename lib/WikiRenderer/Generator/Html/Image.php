<?php

/**
 * @author Laurent Jouanneau
 *
 * @copyright 2016 Laurent Jouanneau
 *
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
 */

namespace WikiRenderer\Generator\Html;

class Image extends AbstractInlineGenerator {

    protected $htmlTagName = 'img';

    protected $supportedAttributes = array('src', 'alt', 'align', 'longdesc');

    public function generate() {
        $attr = ' src="'.htmlspecialchars($this->getAttribute('src')).'"';
        $attr .= ' alt="'.htmlspecialchars($this->getAttribute('alt')).'"';

        $desc = $this->getAttribute('longdesc');
        if ($desc) {
            $attr .= ' longdesc="'.htmlspecialchars($desc).'"';
        }

        $align = $this->getAttribute('align');
        if ($align) {
            $attr .= ' style="float:'.htmlspecialchars($align).';"';
        }

        return '<'.$this->htmlTagName.$attr.'/>';
    }
}