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

require_once('tests_internals.php');
$test->addTestCase(new WikiRendererTestsInternes());

require_once('testsInlineParser.php');
$test->addTestCase(new WikiRendererTestsInlineParser());

require_once('testsInlines.php');
$test->addTestCase(new WikiRendererTestsInlines());

require_once('testsInlinesCamelCase.php');
$test->addTestCase(new WikiRendererTestsInlinesCC());

require_once('testsBlocks.php');
$test->addTestCase(new WikiRendererTestsBlocks());

require_once('testsSerie.php');
$test->addTestCase(new WikiRendererTestsSerie());

require_once('wr3_primaires.php');
$test->addTestCase(new WikiRendererTestsWr3Primaire());

require_once('wr3_testsInlineParser.php');
$test->addTestCase(new WR3TestsInlineParser());

require_once('wr3_testsInlines.php');
$test->addTestCase(new WR3TestsInlines());

require_once('wr3_testsBlocks.php');
$test->addTestCase(new WR3TestsBlocks());

require_once('wr3_dbk_primary.php');
$test->addTestCase(new WikiRendererTestsWr3Docbook());

require_once('wr3_dbk_testsInlines.php');
$test->addTestCase(new WR3DBKTestsInlines());

require_once('wr3_dbk_testsBlocks.php');
$test->addTestCase(new WR3DBKTestsBlocks());

require_once('dokuwiki_docbook_inlines.php');
$test->addTestCase(new dokuwiki_docbook_inlines());

require_once('dokuwiki_docbook_blocks.php');
$test->addTestCase(new dokuwiki_docbook_blocks());

require_once('trac_testsInlines.php');
$test->addTestCase(new TracTestsInlines());

require_once('trac_testsBlocks.php');
$test->addTestCase(new TracTestsBlocks());

$test->run(new HtmlReporter2());




