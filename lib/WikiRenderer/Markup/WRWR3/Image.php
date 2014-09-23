<?php
/**
 * classic wikirenderer syntax to Wikirenderer 3 syntax
 *
 * @package WikiRenderer
 * @subpackage rules
 * @author Laurent Jouanneau
 * @copyright 2003-2014 Laurent Jouanneau
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
namespace WikiRenderer\Markup\WRWR3;

class Image extends \WikiRenderer\Tag {
    public $beginTag='((';
    public $endTag='))';
    protected $attribute=array('src','alt','align','longdesc');
    public $separators=array('|');

    public function getContent(){
        if($this->separatorCount == 0)
            return '(('.$this->wikiContentArr[0].'))';
        elseif($this->separatorCount == 1)
            return '(('.$this->wikiContentArr[0].'|'.$this->wikiContentArr[1].'))';
        elseif($this->separatorCount == 2)
            return '(('.$this->wikiContentArr[0].'|'.$this->wikiContentArr[1].'|'.$this->wikiContentArr[2].'))';
        else
            return '(('.$this->wikiContentArr[0].'|'.$this->wikiContentArr[1].'|'.$this->wikiContentArr[2].'|'.$this->wikiContentArr[3].'))';
    }
}
