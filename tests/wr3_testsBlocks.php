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
require_once(WR_DIR.'rules/wr3_to_xhtml.php');

class WR3TestsBlocks extends WikiRendererUnitTestCase {

    var $listblocks = array(
        'b1'=>0,
        'b2'=>0,
        'wr3_list1'=>0,
        'wr3_pre'=>0,
        'wr3_footnote'=>0,
        'wr3_bug12894'=>0
    );

    function testBlock() {

        $wr = new WikiRenderer(new wr3_to_xhtml());
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
    $test = new WR3TestsBlocks();
    $test->run(new HtmlReporter2());
}
