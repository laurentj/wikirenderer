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

    /**
     * In some wiki system, some links are specials. You should override this method
     * to transform this specific links to real URL.
     *
     * @param string $url  the url as written into the wiki content
     * @param string $tagName  can be
     *      'link': for a tag that generates a link
     *      'image': for a tag that generates an image
     *      'inlineurl': for url found into text, outside a tag
     * @return array First item is the url, second item is an alternate label.
     */
    public function processLink($url, $tagName = '');

}
