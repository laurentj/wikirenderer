<?php

/**
 * Original wikirenderer (wr) syntax
 *
 * @author Laurent Jouanneau
 * @copyright 2003-2016 Laurent Jouanneau
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

namespace WikiRenderer\Markup\ClassicWR;

/**
 * Parser for a paragraph block
 */
class P extends \WikiRenderer\BlockNG
{
    public $type = 'para';

    public function detect($string, $inBlock = false)
    {
        if ($string == '') {
            return false;
        }
        if (preg_match('/^={4,} *$/', $string)) {
            return false;
        }

        $c = $string[0];

        if (strpos("*#-!| \t>;", $c) === false) {
            $this->_detectMatch = array($string, $string);
            return true;
        }

        return false;
    }

    public function validateDetectedLine()
    {
        $this->generator->addLine($this->_renderInlineTag($this->_detectMatch[1]));
    }
}