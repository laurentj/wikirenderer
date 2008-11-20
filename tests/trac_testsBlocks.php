<?php
/**
 * Tests unitaires
 *
 * @package wikirenderer
 * @subpackage tests
 * @author Laurent Jouanneau 
 * @copyright 200 Laurent Jouanneau
 */

require_once('common.php');
require_once(WR_DIR.'rules/trac_to_xhtml.php');

class TracTestsBlocks extends WikiRendererUnitTestCase {

/*
TODO :

   test with {{{ }}} as inline code and block code


*/



    var $listblocks = array(

    );

    function testBlock() {

        $wr = new WikiRenderer(new trac_to_xhtml());
        foreach($this->listblocks as $file=>$nberror){
            $sourceFile = 'datasblocks/'.$file.'.src';
            $resultFile = 'datasblocks/'.$file.'.res';

            $handle = fopen($sourceFile, "r");
            $source = fread($handle, filesize($sourceFile));
            fclose($handle);

            $handle = fopen($resultFile, "r");
            $result = fread($handle, filesize($resultFile));
            fclose($handle);

            $res = $wr->render($source);

            if($file=='wr3_footnote'){
                $conf = & $wr->getConfig();
                $res=str_replace('-'.$conf->footnotesId.'-', '-XXX-',$res);
            }
            $this->assertEqualOrDiff($result, $res, "erreur sur $file");
            if(!$this->assertEqual(count($wr->errors),$nberror, "Errors detected by wr ! (%s)")){
                $this->dump($wr->errors);
            }
        }
    }



}

if(!defined('ALL_TESTS')) {
    $test = new TracTestsBlocks();
    $test->run(new HtmlReporter2());
}
