<?php

/**
 * word converter for inlined URLS
 *
 * @author Laurent Jouanneau
 * @copyright 2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer\WordConverter;
use \WikiRenderer\Generator\DocumentGeneratorInterface;

class URLConverter extends AbstractWordConverter {

    protected $regexp = '/^[a-z]+\:\/\/.+$/';

    /**
     * @var \WikiRenderer\LinkProcessor\LinkProcessorInterface
     */
    protected $urlProcessor;

    /**
     * @param \WikiRenderer\LinkProcessor\LinkProcessorInterface $urlProcessor process url
     */
    function __construct(\WikiRenderer\LinkProcessor\LinkProcessorInterface $urlProcessor) {
        $this->urlProcessor = $urlProcessor;
    }

    public function getContent(\WikiRenderer\Generator\DocumentGeneratorInterface $documentGenerator, $word) {
        list($href, $label) = $this->urlProcessor->processLink($word, 'inlineurl');
        $link = $documentGenerator->getInlineGenerator('link');
        $link->addRawContent($label);
        $link->setAttribute('href', $href);
        return $link;
    }
}
