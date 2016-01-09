<?php

/**
 * @author Laurent Jouanneau
 *
 * @copyright 2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer;

/**
 * Base class to parse block elements.
 */
abstract class BlockNG extends Block
{

    /**
     * @var \WikiRenderer\Generator\BlockGeneratorInterface
     */
    protected $generator;

    /**
     * @var \WikiRenderer\Generator\DocumentGeneratorInterface
     */
    protected $documentGenerator;

    public function __construct(Renderer $wr, \WikiRenderer\Generator\DocumentGeneratorInterface $generator)
    {
        $this->engine = $wr;
        $this->generator = $generator->getBlockGenerator($this->type);
        $this->documentGenerator = $generator;
    }

    public function validateDetectedLine()
    {
        $this->generator->addContent($this->_renderInlineTag($this->_detectMatch[1]));
    }

    public function close()
    {
        return $this->generator;
    }

    public function __clone() {
        $this->generator = clone $this->generator;
    }

}