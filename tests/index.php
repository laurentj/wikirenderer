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

require_once('dokuwiki_docbook_inlines.php');
$test->addTestCase(new dokuwiki_docbook_inlines());

require_once('dokuwiki_docbook_blocks.php');
$test->addTestCase(new dokuwiki_docbook_blocks());

require_once('dokuwiki_xhtml_blocks.php');
$test->addTestCase(new dokuwiki_xhtml_blocks());

require_once('trac_testsInlines.php');
$test->addTestCase(new TracTestsInlines());

require_once('trac_testsBlocks.php');
$test->addTestCase(new TracTestsBlocks());

require_once('phpwiki_dokuwiki_inlines.php');
$test->addTestCase(new phpwiki_dokuwiki_inlines());

require_once('phpwiki_dokuwiki_blocks.php');
$test->addTestCase(new phpwiki_dokuwiki_blocks());

$test->run(new HtmlReporter2());
