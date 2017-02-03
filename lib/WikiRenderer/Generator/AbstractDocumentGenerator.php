<?php
/**
 * @author Laurent Jouanneau
 * @copyright 2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */
namespace WikiRenderer\Generator;

abstract class AbstractDocumentGenerator implements \WikiRenderer\Generator\DocumentGeneratorInterface
{
    use BlocksContainerTrait;

    /**
     * @var Config
     */
    protected $config;

    public function __construct(\WikiRenderer\Generator\Config $config)
    {
        $this->config = $config;
    }

    public function getConfig()
    {
        return $this->config;
    }

    public function getInlineGenerator($type)
    {
        if (isset($this->config->inlineGenerators[$type])) {
            $class = $this->config->inlineGenerators[$type];

            if ($type == 'footnotelink') {
                $footnotes = $this->getMetaData('footnotes');
                if (!$footnotes) {
                    $footnotes = $this->getBlockGenerator('footnotes');
                    $this->setMetaData('footnotes', $footnotes);
                }
                return new $class($footnotes);
            }
            else {
                return new $class();
            }
        }
        throw new \Exception('unknown inline generator '.$type);
    }

    public function getBlockGenerator($type)
    {
        if (isset($this->config->blockGenerators[$type])) {
            $class = $this->config->blockGenerators[$type];

            if ($type == 'footnotes') {
                return new $class($this->config->footnotesIdPrefix);
            }
            else {
                return new $class();
            }
        }
        throw new \Exception('unknown block generator '.$type);
    }

    public function getDefaultBlock(InlineGeneratorInterface $inlineContent)
    {
        return null;
    }

    public function clear()
    {
        $this->headers = array();
        $this->footers = array();
        $this->blocksList = array();
    }

    protected $metadata = array();

    public function getMetaData($name) {
        if (isset($this->metadata[$name])) {
            return $this->metadata[$name];
        }
        return null;
    }

    /**
     * store meta data readed by parsers
     * @param string $name
     * @param mixed value
     */
    public function setMetaData($name, $value) {
        $this->metadata[$name] = $value;
    }

    /**
     * @var GeneratorInterface[]
     */
    protected $headers = array();

    /**
     * Add content to the header. May be used by a parser.
     * @param GeneratorInterface $header
     */
    public function addHeader(GeneratorInterface $header)
    {
        $this->headers[] = $header;
    }

    /**
     * @var GeneratorInterface[]
     */
    protected $footers = array();

    /**
     * Add content to the footer. May be used by a parser.
     * example: footnotes.
     * @param GeneratorInterface $header
     */
    public function addFooter(GeneratorInterface $header)
    {
        $this->footers[] = $footer;
    }

    /**
     * Generate the header.
     *
     * @return string
     */
    public function generateHeader()
    {
        return $this->generateBlocks($this->headers);
    }

    /**
     * Generate the footer.
     *
     * @return string
     */
    public function generateFooter()
    {
        return $this->generateBlocks($this->footers);
    }

    protected function generateBlocks($list)
    {
        return implode('', array_map(function ($generator) {
            return $generator->generate();
        }, $list));
    }
}
