<?php
/**
 * Tests unitaires
 *
 * @package wikirenderer
 * @subpackage tests
 * @author Laurent Jouanneau <jouanneau@netcourrier.com>
 * @copyright 2006 Laurent Jouanneau
 */

require_once('common.php');
require_once(WR_DIR.'rules/dokuwiki_to_docbook.php');

class dokuwiki_docbook_blocks extends WikiRendererUnitTestCase {

    var $listblocks = array(
        'para'=>0,
        'para2'=>0,
        'list'=>0,
        'quote'=>0,
        'table'=>0,
        'section'=>0,
        'section2'=>0,
        'section3'=>0,
        'pre'=>0,
    );

    function testBlock() {

        $wr = new WikiRenderer(new dokuwiki_to_docbook());
        foreach($this->listblocks as $file=>$nberror){
            $sourceFile = 'datasblocks/doku_dbk_'.$file.'.src';
            $resultFile = 'datasblocks/doku_dbk_'.$file.'.res';

            $handle = fopen($sourceFile, "r");
            $source = fread($handle, filesize($sourceFile));
            fclose($handle);

            $handle = fopen($resultFile, "r");
            $result = fread($handle, filesize($resultFile));
            fclose($handle);

            $res = $wr->render($source);

            if(!$this->assertEqual($res,$result, "error on $file")){
                $this->_showDiff($result,$res);
            }
            if(!$this->assertEqual(count($wr->errors),$nberror, "Errors detected by wr ! (%s)")){
                $this->dump($wr->errors);
            }
        }
    }
}

$test = &new dokuwiki_docbook_blocks();
$test->run(new HtmlReporter2());



?>