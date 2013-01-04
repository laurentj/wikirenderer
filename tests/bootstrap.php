<?php
/**
 * Tests unitaires
 *
 * @package wikirenderer
 * @subpackage tests
 * @author Laurent Jouanneau
 * @copyright 2003-2013 Laurent Jouanneau
 */

define('WR_DIR',realpath(__DIR__.'/../lib/').'/');
require_once(WR_DIR.'SplClassLoader.php');
$classLoader = new SplClassLoader('WikiRenderer', WR_DIR);
$classLoader->register();

class WRConfigTest extends \WikiRenderer\Config { }

// we use an inherited inline parser to access to some protected data, to verify them
class WikiInlineParserTest extends \WikiRenderer\InlineParser {

    function getSplitPattern(){ return $this->textLineContainers[$this->config->defaultTextLineContainer]->pattern; }
    function getListTag(){ return $this->textLineContainers[$this->config->defaultTextLineContainer]->allowedTags; }
}


function testlog($str) {
    error_log($str."\n", 3, __DIR__.'/log.txt');
}