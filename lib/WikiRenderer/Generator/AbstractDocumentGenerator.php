<?php
/**
 *
 * @author Laurent Jouanneau
 * @copyright 2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

 namespace WikiRenderer\Generator;
 use \WikiRenderer\Generator\GeneratorInterface;
 
 abstract class AbstractDocumentGenerator implements \WikiRenderer\Generator\DocumentGeneratorInterface {
    use BlocksContainerTrait;

    /**
     * @var Config
     */
    protected $config;
 
    public function __construct(\WikiRenderer\Generator\Config $config)
    {
        $this->config = $config;
    }

    public function getConfig() {
        return $this->config;
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

    public function getDefaultBlock() {
        return null;
    }

    function clear() {
        $this->headers = array();
        $this->footers = array();
        $this->blocksList = array();
    }

    /**
     * @var GeneratorInterface[]
     */
    protected $headers = array();

    /**
     * Add content to the header. May be used by a parser.
     *
     */
    public function addHeader(GeneratorInterface $header) {
        $this->headers[] = $header;
    }

    /**
     * @var GeneratorInterface[]
     */
    protected $footers = array();

    /**
     * Add content to the footer. May be used by a parser.
     * example: footnotes
     *
     */
    public function addFooter(GeneratorInterface $header) {
        $this->footers[] = $footer;
    }

    /**
     * Generate the header
     * @return string
     */
    public function generateHeader() {
        return $this->generateBlocks($this->headers);
    }

    /**
     * Generate the footer
     * @return string
     */
    public function generateFooter() {
        return $this->generateBlocks($this->footers);
    }

    protected function generateBlocks($list) {
        return implode("", array_map(function($generator) {
            return $generator->generate();
        }, $list));
    }
 }
 