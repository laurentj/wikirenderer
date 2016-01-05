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

class BlockQuote implements \WikiRenderer\Generator\BlockBlockQuoteInterface {

    protected $lines = array();

    public function addContent(\WikiRenderer\Generator\GeneratorInterface $content) {
        $this->lines[] = $content;
    }

    public function generate() {

        $text = '<blockquote>';
        $currentPara = null;
        foreach($this->lines as $generator) {
            if ($generator instanceof \WikiRenderer\Generator\BlockGeneratorInterface) {
                if ($currentPara) {
                    $text .= $currentPara->generate()."\n";
                    $currentPara = null;
                }
                $text .= $generator->generate()."\n";
            }
            else if ($currentPara) {
                $currentPara->addLine($generator);
            }
            else {
                $currentPara = new Paragraph();
                $currentPara->addLine($generator);
            }
        }
        if ($currentPara) {
            $text .= $currentPara->generate();
        }
        $text .= '</blockquote>';
        return $text;
    }
}