<?php
/**
 * Tests unitaires
 *
 * @package wikirenderer
 * @subpackage tests
 * @author Laurent Jouanneau <jouanneau@netcourrier.com>
 * @copyright 2003-2006 Laurent Jouanneau
 */
error_reporting(E_ALL);
require_once('simpletest/unit_tester.php');
require_once('simpletest/reporter.php');
require_once('diff/diffhtml.php');

if(version_compare(phpversion(),'5') < 0){
    define('WR_DIR',realpath(dirname(__FILE__).'/../php4/').'/');
    require_once('../php4/WikiRenderer.lib.php');
}else{
    define('WR_DIR',realpath(dirname(__FILE__).'/../php5/').'/');
    require_once('../php5/WikiRenderer.lib.php');
}


class WikiRendererUnitTestCase extends UnitTestCase {

    function _showDiff($attendu, $result){

        $diff = new Diff(explode("\n",$attendu),explode("\n",$result));

        if($diff->isEmpty()) {
            $this->sendMessage("bizarre, aucune différence d'aprés la difflib...");
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
Tests unitaires sur WikiRenderer <?php echo WIKIRENDERER_VERSION;?><br/>

<a href="index.php">Tests internes</a> |
<a href="testsInlineParser.php">Tests parser inline</a> |
<a href="testsInlines.php">Tests inlines</a> |
<a href="testsBlocks.php">Tests blocks</a> |
<a href="testsSerie.php">Grande serie</a>
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