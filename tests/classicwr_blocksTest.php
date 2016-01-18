<?php
/**
 * Tests unitaires
 *
 * @package wikirenderer
 * @subpackage tests
 * @author Laurent Jouanneau
 * @copyright 2006-2011 Laurent Jouanneau
 */


class classicwr_blocksTest extends PHPUnit_Framework_TestCase {

    function getlistblocks() {
        return array(
            array('para1',0),
            array('para2',0),
            array('classicwr/demo',0),
            array('classicwr/list1',0),
            array('classicwr/list2',0),
        );
    }

    /**
     * @dataProvider getlistblocks
     */
    function testBlock($file, $nberror) {
        $genConfig = new \WikiRenderer\Generator\Html\Config();
        $generator = new \WikiRenderer\Generator\Html\Document($genConfig);
        $markupConfig = new \WikiRenderer\Markup\ClassicWR\Config();
        $wr = new \WikiRenderer\RendererNG($generator, $markupConfig);

        $sourceFile = 'datasblocks/'.$file.'.src';
        $resultFile = 'datasblocks/'.$file.'.res';

        $source = file_get_contents($sourceFile);
        $expected = file_get_contents($resultFile);

        $res = $wr->render($source);
        $this->assertEquals($expected, $res);
        $this->assertEquals($nberror, count($wr->errors));
    }
}
