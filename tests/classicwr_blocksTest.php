<?php
/**
 * Tests unitaires
 *
 * @package wikirenderer
 * @subpackage tests
 * @author Laurent Jouanneau
 * @copyright 2006-2011 Laurent Jouanneau
 */

require_once(WR_DIR.'rules/classicwr_to_xhtml.php');

class classicwr_blocksTest extends PHPUnit_Framework_TestCase {

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
            $this->assertEquals($result, $res);
            $this->assertEquals($nberror, count($wr->errors), "Erreurs détéctées par wr ! (%s)");
        }
    }
}
