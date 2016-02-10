<?php

/**
 * 
 *
 * @author Laurent Jouanneau
 * @copyright 2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer\LinkProcessor;


interface LinkProcessorInterface {

    public function processLink($url, $tagName = '');

}
