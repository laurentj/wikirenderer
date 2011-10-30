<?php
/**
 * Tests unitaires
 *
 * @package wikirenderer
 * @subpackage tests
 * @author Laurent Jouanneau
 * @copyright 2006 Laurent Jouanneau
 */
require_once('common.php');
require_once(WR_DIR.'rules/classicwr_to_xhtml.php');

define('ALL_TESTS', true);

$test = &new GroupTest('All tests');

$test->run(new HtmlReporter2());
