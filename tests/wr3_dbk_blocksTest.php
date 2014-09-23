<?php
/**
 * Tests unitaires
 *
 * @package wikirenderer
 * @subpackage tests
 * @author Laurent Jouanneau
 * @copyright 2006-2013 Laurent Jouanneau
 */

class WR3DBKTestsBlocks extends PHPUnit_Framework_TestCase {

    var $listblocks = array(
        'b1'=>0,
        'b2'=>0,
        'wr3_list1'=>0,
        'wr3_pre'=>0,
        'wr3_footnote'=>0,
    );

    function testBlock() {

        $wr = new \WikiRenderer\Renderer(new \WikiRenderer\Markup\WR3DocBook\Config());
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

            $this->assertEquals($result, $res, "error on $file");
            $this->assertEquals($nberror, count($wr->errors), "Errors detected by wr");
        }
    }

    var $listblocks2 = array(
        'dbk_wr3_section'=>0,
        'dbk_wr3_section2'=>0,
        'dbk_wr3_section3'=>0,
    );

    function testBlock2() {

        $wr = new \WikiRenderer\Renderer(new \WikiRenderer\Markup\WR3DocBook\Config());
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

            $this->assertEquals($result, $res, "error on $file");
            $this->assertEquals($nberror, count($wr->errors),"Errors detected by wr");
        }
    }


}
