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

interface DocumentGeneratorInterface extends BlocksContainerInterface
{
    public function __construct(Config $config);

    /**
     * @return Config
     */
    public function getConfig();

    /**
     * Returns a new instance of the generator corresponding to the given type.
     *
     * supported standard types: textline, strong, em,c ode, quote, cite,
     * acronym, link, image, anchor
     *
     * @param string $type
     * @return InlineGeneratorInterface
     */
    public function getInlineGenerator($type);

    /**
     * Returns a new instance of the generator corresponding to the given type.
     *
     * supported standard types : title, list, pre, blockquote, hr, para,
     * definition, table
     *
     * @param string $type
     * @return BlockGeneratorInterface
     */
    public function getBlockGenerator($type);

    /**
     * return the default block. It is used when the parser don't find
     * a block corresponding to the line that it parses. May return null.
     *
     * @param InlineGeneratorInterface $inlineContent
     * @return BlockGeneratorInterface
     */
    public function getDefaultBlock(InlineGeneratorInterface $inlineContent);

    /**
     * retrieve meta data stored by parsers
     * @param string $name
     * @return mixed the meta data
     */
    public function getMetaData($name);

    /**
     * store meta data readed by parsers
     * @param string $name
     * @param mixed $value
     */
    public function setMetaData($name, $value);

    /**
     * Add content to the header. May be used by a parser.
     * @param GeneratorInterface $header
     * @return
     */
    public function addHeader(GeneratorInterface $header);

    /**
     * Add content to the footer. May be used by a parser.
     * example: footnotes.
     * @param GeneratorInterface $header
     * @return
     */
    public function addFooter(GeneratorInterface $header);

    /**
     * Generate the header.
     *
     * @return string
     */
    public function generateHeader();

    /**
     * Generate the footer.
     *
     * @return string
     */
    public function generateFooter();

    /**
     * reset all the content of the document.
     */
    public function clear();
}
