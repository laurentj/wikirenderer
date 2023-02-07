<?php
/**
 * Tests unitaires
 *
 * @package wikirenderer
 * @subpackage tests
 * @author Laurent Jouanneau
 * @copyright 2008-2023 Laurent Jouanneau
 */

require_once(WR_DIR.'rules/trac_to_xhtml.php');

class TracTestsBlocks extends PHPUnit\Framework\TestCase {

/*
TODO :

   test with {{{ }}} as inline code and block code


*/
    var $listblocks = array(
      'trac_demo'=>0,
    );

    function testBlock() {

        $wr = new WikiRenderer(new trac_to_xhtml());
        foreach($this->listblocks as $file=>$nberror){
            $sourceFile = 'datasblocks/'.$file.'.src';
            $resultFile = 'datasblocks/'.$file.'.res';

            $handle = fopen($sourceFile, "r");
            $source = fread($handle, filesize($sourceFile));
            fclose($handle);

            $handle = fopen($resultFile, "r");
            $result = fread($handle, filesize($resultFile));
            fclose($handle);

            $res = $wr->render($source);

            if($file=='wr3_footnote'){
                $conf = $wr->getConfig();
                $res=str_replace('-'.$conf->footnotesId.'-', '-XXX-',$res);
            }
            $this->assertEquals($result, $res, "erreur sur $file");
            $this->assertEquals($nberror, count($wr->errors),"Errors detected by wr");
        }
    }
}
