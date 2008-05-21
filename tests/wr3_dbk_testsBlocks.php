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
require_once(WR_DIR.'rules/wr3_to_docbook.php');

class WR3DBKTestsBlocks extends WikiRendererUnitTestCase {

    var $listblocks = array(
        'b1'=>0,
        'b2'=>0,
        'wr3_list1'=>0,
        'wr3_pre'=>0,
        'wr3_footnote'=>0,
    );

    function testBlock() {

        $wr = new WikiRenderer(new wr3_to_docbook());
        foreach($this->listblocks as $file=>$nberror){
            $sourceFile = 'datasblocks/'.$file.'.src';
            $resultFile = 'datasblocks/dbk_'.$file.'.res';

            $handle = fopen($sourceFile, "r");
            $source = fread($handle, filesize($sourceFile));
            fclose($handle);

            $handle = fopen($resultFile, "r");
            $result = fread($handle, filesize($resultFile));
            fclose($handle);

            $res = $wr->render($source);

            if(!$this->assertEqual($res,$result, "error on $file")){
                $this->_showDiff($result,$res);
            }
            if(!$this->assertEqual(count($wr->errors),$nberror, "Errors detected by wr ! (%s)")){
                $this->dump($wr->errors);
            }
        }
    }

    var $listblocks2 = array(
        'dbk_wr3_section'=>0,
        'dbk_wr3_section2'=>0,
        'dbk_wr3_section3'=>0,
    );

    function testBlock2() {

        $wr = new WikiRenderer(new wr3_to_docbook());
        foreach($this->listblocks2 as $file=>$nberror){
            $sourceFile = 'datasblocks/'.$file.'.src';
            $resultFile = 'datasblocks/'.$file.'.res';

            $handle = fopen($sourceFile, "r");
            $source = fread($handle, filesize($sourceFile));
            fclose($handle);

            $handle = fopen($resultFile, "r");
            $result = fread($handle, filesize($resultFile));
            fclose($handle);

            $res = $wr->render($source);

            if(!$this->assertEqual($res,$result, "error on $file")){
                $this->_showDiff($result,$res);
            }
            if(!$this->assertEqual(count($wr->errors),$nberror, "Errors detected by wr ! (%s)")){
                $this->dump($wr->errors);
            }
        }
    }


}

$test = &new WR3DBKTestsBlocks();
$test->run(new HtmlReporter2());



?>