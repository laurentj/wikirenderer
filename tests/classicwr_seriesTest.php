<?php
/**
 * Tests unitaires
 *
 * @package wikirenderer
 * @subpackage tests
 * @author Laurent Jouanneau
 * @copyright 2003-2016 Laurent Jouanneau
 */


class classicwr_seriesTest extends PHPUnit_Framework_TestCase {

    function testSerie() {

        include('dataSeries.php');
        $genConfig = new \WikiRenderer\Generator\Html\Config();
        $generator = new \WikiRenderer\Generator\Html\Document($genConfig);
        $markupConfig = new \WikiRenderer\Markup\ClassicWR\Config();
        $wr = new \WikiRenderer\Renderer($generator, $markupConfig);
        foreach($list as $k=> $t){
            $res = $wr->render($t[0]);
            $this->assertEquals($t[2], $res, 'test '.$k);
        }
    }

}
