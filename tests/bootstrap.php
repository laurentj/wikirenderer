<?php
/**
 * Tests unitaires
 *
 * @package wikirenderer
 * @subpackage tests
 * @author Laurent Jouanneau
 * @copyright 2003-2023 Laurent Jouanneau
 */

define('WR_DIR',realpath(__DIR__.'/../src/').'/');
require_once(__DIR__.'/../src/WikiRenderer.lib.php');

class WRConfigTest extends WikiRendererConfig { }

// we use an inherited inline parser to access to some protected data, to verify them
class WikiInlineParserTest extends WikiInlineParser {

    function getSplitPattern(){ return $this->textLineContainers[$this->config->defaultTextLineContainer]->pattern; }
    function getListTag(){ return $this->textLineContainers[$this->config->defaultTextLineContainer]->allowedTags; }
}
