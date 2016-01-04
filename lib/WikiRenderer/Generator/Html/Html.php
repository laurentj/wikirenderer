<?php
/**
 * html generator for WikiRenderer.
 *
 * @author Laurent Jouanneau
 * @copyright 2015 Laurent Jouanneau
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
 
 class Html implements \WikiRenderer\Generator\GlobalGeneratorInterface {

    /**
     * @var Config
     */
    protected $config;
 
    public function __construct(\WikiRenderer\Generator\Config $config)
    {
        $this->config = $config;
    }
 
    public function getInlineGenerator($type) {
        if (isset($this->config->inlineGenerators[$type])) {
            $class = $this->config->inlineGenerators[$type];
            return new $class();
        }
        throw new \Exception('unknown inline generator '.$type);
    }

    public function getBlockGenerator($type) {
        if (isset($this->config->blockGenerators[$type])) {
            $class = $this->config->blockGenerators[$type];
            return new $class();
        }
        throw new \Exception('unknown block generator '.$type);
    }
 }
 