<?php
/**
 * Tests unitaires
 *
 * @package wikirenderer
 * @subpackage tests
 * @author Laurent Jouanneau
 * @copyright 2014 Laurent Jouanneau
 */

class wr_wr3Test extends PHPUnit_Framework_TestCase {

    var $listblocks = array(
        'demo'=>0,
    );

    function testBlockFiles() {
        $wr = new \WikiRenderer\Renderer(new \WikiRenderer\Markup\WRWR3\Config());
        foreach($this->listblocks as $file=>$nberror){
            $sourceFile = 'datasblocks/wr_wr3_'.$file.'.src';
            $resultFile = 'datasblocks/wr_wr3_'.$file.'.res';

            $handle = fopen($sourceFile, "r");
            $source = fread($handle, filesize($sourceFile));
            fclose($handle);

            $handle = fopen($resultFile, "r");
            $result = fread($handle, filesize($resultFile));
            fclose($handle);

            $res = $wr->render($source);
            $this->assertEquals($result, $res,"error on $file");
            $this->assertEquals($nberror, count($wr->errors), "Errors detected by wr");
        }
    }
}

