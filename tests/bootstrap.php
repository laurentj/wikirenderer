<?php
/**
 * Tests unitaires
 *
 * @package wikirenderer
 * @subpackage tests
 * @author Laurent Jouanneau
 * @copyright 2003-2011 Laurent Jouanneau
 */

define('WR_DIR',realpath(dirname(__FILE__).'/wikirenderer/').'/');
require_once('wikirenderer/WikiRenderer.lib.php');

if(!defined('WIKIRENDERER_VERSION')) define('WIKIRENDERER_VERSION','');


class WRConfigTest extends WikiRendererConfig { }

// we use an inherited inline parser to access to some protected data, to verify them
class WikiInlineParserTest extends WikiInlineParser {

    function getSplitPattern(){ return $this->textLineContainers[$this->config->defaultTextLineContainer]->pattern; }
    function getListTag(){ return $this->textLineContainers[$this->config->defaultTextLineContainer]->allowedTags; }
}
