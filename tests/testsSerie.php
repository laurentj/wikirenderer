<?php
/**
 * Tests unitaires
 *
 * @package wikirenderer
 * @subpackage tests
 * @author Laurent Jouanneau
 * @copyright 2003-2006 Laurent Jouanneau
 */

require_once('common.php');
require_once(WR_DIR.'rules/classicwr_to_xhtml.php');

class WikiRendererTestsSerie extends WikiRendererUnitTestCase {

    function testSerie() {

        include('datasSerie.php');
        $wr= new WikiRenderer('classicwr_to_xhtml');
        foreach($list as $k=> $t){

            $res =$wr->render($t[0]);
            if(!$this->assertTrue($res == $t[2])){
                $this->sendMessage("<hr>test $k");
                $this->sendMessage("wiki:");
                $this->dump($t[0]);
                /*$this->sendMessage("Attendu:");
                $this->dump($t[2]);
                $this->sendMessage("Obtenu:");
                $this->dump($res);*/
                $this->_showDiff($t[2], $res);
            }

        }
    }

}


$test = &new WikiRendererTestsSerie();
$test->run(new HtmlReporter2());

?>
