<?php
/**
 * Tests unitaires
 *
 * @package wikirenderer
 * @subpackage tests
 * @author Laurent Jouanneau 
 * @copyright 2003-2008 Laurent Jouanneau
 */
error_reporting(E_ALL);
require_once('simpletest/unit_tester.php');
require_once('simpletest/reporter.php');

define('WR_DIR',realpath(dirname(__FILE__).'/wikirenderer/').'/');
require_once('wikirenderer/WikiRenderer.lib.php');
require_once('diff_php5/diffhtml.php');

if(!defined('WIKIRENDERER_VERSION')) define('WIKIRENDERER_VERSION','');


class WikiRendererUnitTestCase extends UnitTestCase {

    function _showDiff($attendu, $result){

        $diff = new Diff(explode("\n",$attendu),explode("\n",$result));

        if($diff->isEmpty()) {
            $this->sendMessage("Well, diff lib says there are no difference...");
        }else{
            $fmt = new HtmlUnifiedDiffFormatter();
            $this->sendMessage($fmt->format($diff));
        }

    }

}

class HtmlReporter2 extends HtmlReporter{
    function paintHeader($test_name) {
        $this->sendNoCacheHeaders();
        ?>
<html><head><title><?php echo $test_name;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo  $this->_character_set?>">
<style type="text/css"><?php echo $this->_getCss()?>
</style>
</head>
<body>
<div class="header">
Unit tests on WikiRenderer <?php echo WIKIRENDERER_VERSION;?> (PHP <?php echo phpversion() ?>)
<ul>
 <li>classicwr : <a href="index.php">internal tests</a> |
    <a href="testsInlineParser.php">inline parser</a> |
    <a href="testsInlines.php">inlines</a> |
    <a href="testsInlinesCamelCase.php">inlines wikiword</a> |
    <a href="testsBlocks.php">blocks</a> |
    <a href="testsSerie.php">Big tests</a></li>
 <li>wr3 : <a href="wr3_primaires.php">tags</a> |
    <a href="wr3_testsInlineParser.php">parser inline</a> |
    <a href="wr3_testsInlines.php">inlines</a> |
    <a href="wr3_testsBlocks.php">blocks</a> </li>
 <li>wr3 to docbook : <a href="wr3_dbk_primary.php">tags</a> |
    <a href="wr3_dbk_testsInlines.php">inlines</a> |
    <a href="wr3_dbk_testsBlocks.php">blocks</a>
 </li>
 <li>dokuwiki to docbook :
    <a href="dokuwiki_docbook_inlines.php">inlines</a> |
    <a href="dokuwiki_docbook_blocks.php">blocks</a>
 </li>
 <li>trac syntax:
    <a href="wr3_testsInlines.php">inlines</a> |
    <a href="wr3_testsBlocks.php">blocks</a> </li>
</ul>
</div>
<h1><?php echo $test_name?></h1>
        <?php
        flush();
    }

    function _getCss() {
        return "

        .header { border-bottom:2px solid #ddd; background-color:#beeee2;}

        div.fail { margin-top:4px; margin-bottom:4px; padding-left:5px; border-left: 4px solid #d993a5; }
        div.fail p { font-size:0.9em; }
        div.fail strong { color: red; }

        div.exception { margin-top:4px; margin-bottom:4px;
            background-color: #ff9186;
            border: 1px solid red; }

        div.exception strong {color: red;}
        div.exception p { font-size:0.9em; }

        pre { background-color: lightgray; }

        .diff { background: white; border: 1px solid black; }
        .diff .block { background: #ccc; padding-left: 1em; }
        .diff .context { background: white; border: none; }
        .diff .block tt { font-weight: normal;  font-family: monospace;  color: black;
                margin-left: 0;  border: none; }
        .diff del, .diff ins {  font-weight: bold; text-decoration: none; }
        .diff .original, .diff .deleted,
        .diff .final, .diff .added {  background: white; }
        .diff .original, .diff .deleted {  background: #fcc;  border: none; }
        .diff .final, .diff .added {  background: #cfc; border: none; }
        .diff del { background: #f99; }
        .diff ins { background: #9f9; }
        ";
    }

    function paintFail($message) {
        SimpleReporter::paintFail($message);
        print '<div class="fail"><strong>Fail</strong>: ';
        $breadcrumb = $this->getTestList();
        array_shift($breadcrumb);
        print implode(" -&gt; ", $breadcrumb);
        print '<p class="message">' . $this->_htmlEntities($message) . "</p></div>\n";
    }


    function paintError($message) {
        SimpleReporter::paintError($message);
        print '<div class="exception"><strong>Exception</strong>: ';
        $breadcrumb = $this->getTestList();
        array_shift($breadcrumb);
        print implode(" -&gt; ", $breadcrumb);
        print "<p>" . $this->_htmlEntities($message) . "</p></div>\n";
    }


    function paintMessage($message) {
        echo '<div>'.$message.'</div>';
    }
}


function dump($str){
   // echo $str.'<br/>';
}

?>