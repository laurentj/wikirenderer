<?php
/**
 * Tests unitaires
 *
 * @package wikirenderer
 * @subpackage tests
 * @author Laurent Jouanneau
 * @copyright 2003-2023 Laurent Jouanneau
 */

require_once(WR_DIR.'rules/classicwr_to_xhtml.php');

class classicwr_seriesTest extends PHPUnit\Framework\TestCase {

    function testSerie() {

        include('dataSeries.php');
        $wr= new WikiRenderer('classicwr_to_xhtml');
        $wr->getConfig()->charset = 'ISO-8859-1';
        foreach($list as $k=> $t){
            $res = $wr->render($t[0]);
            $this->assertEquals($t[2], $res);
        }
    }

}
