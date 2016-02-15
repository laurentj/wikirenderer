<?php
/**
 * Docbook generator for WikiRenderer.
 *
 * @author Laurent Jouanneau
 * @copyright 2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */
namespace WikiRenderer\Generator\Docbook;

class Document extends \WikiRenderer\Generator\AbstractDocumentGenerator
{
    public function getDefaultBlock()
    {
        return $this->config->blockGenerators['para'];
    }
}
