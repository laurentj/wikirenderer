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

namespace WikiRenderer\Generator\Html;

class words implements \WikiRenderer\Generator\InlineGeneratorInterface {

    protected $content = '';

    public function addRawContent($string) {
        $this->content .= $string;
    }

    public function addContent(InlineGeneratorInterface $content) {
        throw new \Exception("not supported");
    }

    public function addAttribute($name, $value) {
        throw new \Exception("not supported");
    }

    /**
     * @return string
     */
    public function generate() {
        return htmlspecialchars($this->content);
    }
}
