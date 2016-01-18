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

    function getListblocks() {
        return array(
            array('para1','dbk_para1',0),
            array('para2','dbk_para2',0),
            array('wr3/wr3_list1',   'dbk_wr3_list1',0),
            array('wr3/wr3_pre',     'dbk_wr3_pre',0),
            array('wr3/wr3_footnote','dbk_wr3_footnote',0),
        );
    }

    /**
     * @dataProvider getListblocks
     */
    function testBlock($file, $file2, $nberror) {

        $wr = new \WikiRenderer\Renderer(new \WikiRenderer\Markup\WR3DocBook\Config());
        $sourceFile = 'datasblocks/'.$file.'.src';
        $resultFile = 'datasblocks/'.$file2.'.res';

        $source = file_get_contents($sourceFile);
        $expected = file_get_contents($resultFile);

        $res = $wr->render($source);

        $this->assertEquals($expected, $res);
        $this->assertEquals($nberror, count($wr->errors));
    }

    function getListblocks2() {
        return array(
            array('dbk_wr3_section',0),
            array('dbk_wr3_section2',0),
            array('dbk_wr3_section3',0),
        );
    }

    /**
     * @dataProvider getListblocks2
     */
    function testBlock2($file, $nberror) {

        $wr = new \WikiRenderer\Renderer(new \WikiRenderer\Markup\WR3DocBook\Config());
        $sourceFile = 'datasblocks/'.$file.'.src';
        $resultFile = 'datasblocks/'.$file.'.res';

        $source = file_get_contents($sourceFile);
        $expected = file_get_contents($resultFile);

        $res = $wr->render($source);

        $this->assertEquals($expected, $res);
        $this->assertEquals($nberror, count($wr->errors));
    }


}
