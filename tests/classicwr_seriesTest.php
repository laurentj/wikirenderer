<?php
/**
 * Tests unitaires
 *
 * @package wikirenderer
 * @subpackage tests
 * @author Laurent Jouanneau
 * @copyright 2003-2011 Laurent Jouanneau
 */

require_once(WR_DIR.'rules/classicwr_to_xhtml.php');

class classicwr_seriesTest extends PHPUnit_Framework_TestCase {

    function testSerie() {

        include('datasSerie.php');
        $wr= new WikiRenderer('classicwr_to_xhtml');
        foreach($list as $k=> $t){
            $res = $wr->render($t[0]);
            $this->assertEquals($t[2], $res);
        }
    }

}
