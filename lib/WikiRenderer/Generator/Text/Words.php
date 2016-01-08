<?php

/**
 * Configuration for an HTML generator
 *
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

namespace WikiRenderer\Generator\Text;

class Words implements \WikiRenderer\Generator\InlineWordsInterface {

    protected $content = '';

    public function __construct($words = '') {
        $this->content = $words;
    }
    
    public function addRawContent($string) {
        $this->content .= $string;
    }

    public function addGeneratedContent($string) {
        $this->content .= $string;
    }

    /**
     * @return string
     */
    public function generate() {
        return $this->content;
    }
}
