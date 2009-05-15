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
if (! defined('SIMPLE_TEST')) {
    define('SIMPLE_TEST', 'simpletest/');
}

require_once(SIMPLE_TEST . 'unit_tester.php');
require_once(SIMPLE_TEST . 'reporter.php');


define('WR_DIR',realpath(dirname(__FILE__).'/wikirenderer/').'/');
require_once('wikirenderer/WikiRenderer.lib.php');
require_once('diff_php5/diffhtml.php');

if(!defined('WIKIRENDERER_VERSION')) define('WIKIRENDERER_VERSION','');


class WRConfigTest extends WikiRendererConfig { }

// we use an inherited inline parser to access to some protected data, to verify them
class WikiInlineParserTest extends WikiInlineParser {

    function getSplitPattern(){ return $this->textLineContainers[$this->config->defaultTextLineContainer]->pattern; }
    function getListTag(){ return $this->textLineContainers[$this->config->defaultTextLineContainer]->allowedTags; }
}

class WikiRendererUnitTestCase extends UnitTestCase {

    /**
    *    show difference between two strings
    *    @param string $stringA  the first string
    *    @param string $stringB  the second string
    *    @param string $message        Message to send.
    */
    function diff($stringA, $stringB, $message='') {
        if (! isset($this->_reporter)) {
            trigger_error('Can only show diff within test methods');
        }
        if($message != '')
            $this->_reporter->paintMessage($message);
        $this->_reporter->paintDiff($stringA, $stringB);
    }

    /**
    *    like assertEqual, but shows difference between two given strings
    *    if it the test fail.
    *    @param mixed $first  the first value
    *    @param mixed $second  the second value
    *    @param string $message        Message to send if it fail
    *    @return boolean true if the test pass
    */
    function assertEqualOrDiff($first, $second, $message = "%s"){
        $ret = $this->assertEqual($first, $second, $message);
        if(!$ret){
            if(is_string($first) && is_string($second))
                $this->diff($first, $second);
            else
                $this->diff(var_export($first,true), var_export($second,true));
        }
        return $ret;
    }




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
    function __construct($character_set = 'UTF-8') {
        parent::HtmlReporter($character_set);
    }
    function paintHeader($test_name) {
        $this->sendNoCacheHeaders();
        ?>
<html><head><title><?php echo $test_name;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo  $this->_character_set?>">
<link rel="stylesheet" type="text/css" href="diff_php5/diff.css" />
<style type="text/css"><?php echo $this->_getCss()?>
</style>
</head>
<body>
<div class="header">
Unit tests on WikiRenderer <?php echo WIKIRENDERER_VERSION;?> (PHP <?php echo phpversion() ?>)
<ul>
 <li><a href="index.php">All tests</a></li>
 <li>classicwr : <a href="tests_internals.php">internal tests</a> |
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
 <li>phpwiki to dokuwiki:
    <a href="phpwiki_dokuwiki_inlines.php">inlines</a> |
    <a href="phpwiki_dokuwiki_blocks.php">blocks</a>
 </li>

 <li>trac syntax:
    <a href="trac_testsInlines.php">inlines</a> |
    <a href="trac_testsBlocks.php">blocks</a> </li>
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

   function paintDiff($stringA, $stringB){
        $diff = new Diff(explode("\n",$stringA),explode("\n",$stringB));
        if($diff->isEmpty()) {
            echo '<p>Erreur diff : bizarre, aucune différence d\'aprés la difflib...</p>';
        }else{
            $fmt = new HtmlUnifiedDiffFormatter();
            echo $fmt->format($diff);
        }
   }
   
    function paintMessage($message) {
        echo '<div>'.$message.'</div>';
    }
}


function dump($str){
   // echo $str.'<br/>';
}

?>