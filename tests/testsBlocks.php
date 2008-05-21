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

class WikiRendererTestsBlocks extends WikiRendererUnitTestCase {

    var $listblocks = array(
        'b1'=>0,
        'b2'=>0,
        'demo'=>0,
        'list1'=>0,
        'list2'=>0,

    );

    function testBlock() {
        $wr = new WikiRenderer('classicwr_to_xhtml');
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
            if(!$this->assertEqual($res,$result, "erreur sur $file")){
                $this->_showDiff($result,$res);
            }
            if(!$this->assertEqual(count($wr->errors),$nberror, "Erreurs détéctées par wr ! (%s)")){
                $this->dump($wr->errors);
            }
        }
    }



}

$test = &new WikiRendererTestsBlocks();
$test->run(new HtmlReporter2());



?>