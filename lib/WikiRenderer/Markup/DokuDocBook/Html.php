<?php

/**
 * dokuwiki syntax to docbook 5.0.
 *
 * @author Laurent Jouanneau
 * @copyright 2008 Laurent Jouanneau
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

namespace WikiRenderer\Markup\DokuDocBook;

/**
 * parse html blocks, but do not generate content for docbook
 */
class Html extends \WikiRenderer\Block
{
    public $type = 'html';
    protected $isOpen = false;
    protected $dktag = 'html';
    protected $closeTagDetected = false;

    public function open()
    {
        $this->isOpen = true;
        $this->closeTagDetected = false;
        $this->text = array();
    }

    public function close()
    {
        $this->isOpen = false;
        return '';
    }

    public function validateDetectedLine()
    {
    }

    public function detect($string, $inBlock = false)
    {
        if ($this->closeTagDetected) {
            return false;
        }
        if ($this->isOpen) {
            if (preg_match('/(.*)<\/'.$this->dktag.'>\s*$/', $string, $m)) {
                $this->isOpen = false;
                $this->closeTagDetected = true;
            }

            return true;
        } else {
            if (preg_match('/^\s*<'.$this->dktag.'>(.*)/', $string, $m)) {
                if (preg_match('/(.*)<\/'.$this->dktag.'>\s*$/', $string, $m)) {
                    $this->closeTagDetected = true;
                    $this->_closeNow = true;
                } else {
                    $this->_closeNow = false;
                }

                return true;
            } else {
                return false;
            }
        }
    }
}
