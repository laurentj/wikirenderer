<?php
/**
 * Tests unitaires
 *
 * @package wikirenderer
 * @subpackage tests
 * @author Laurent Jouanneau
 * @copyright 2003-2011 Laurent Jouanneau
 */


class classicwr_seriesTest extends PHPUnit_Framework_TestCase {

    function testSerie() {

        include('dataSeries.php');
        $conf = new \WikiRenderer\Markup\WRHtml\Config();
        $wr = new \WikiRenderer\Renderer($conf);
        foreach($list as $k=> $t){
            $res = $wr->render($t[0]);
            $this->assertEquals($t[2], $res);
        }
    }

}
