<?php
/**
 * Tests unitaires
 *
 * @package wikirenderer
 * @subpackage tests
 * @author Laurent Jouanneau
 * @copyright 2006 Laurent Jouanneau
 */

require_once('common.php');
require_once(WR_DIR.'rules/dokuwiki_to_docbook.php');

class dokuwiki_docbook_blocks extends WikiRendererUnitTestCase {


    protected $data = array(
0=>array(
'',
'',
0
),

1=>array(
'<code> machin </code>',
'<programlisting> machin </programlisting>',
0
),

2=>array(
'<code> machin
truc </code>',
'<programlisting> machin
truc </programlisting>',
0
),


3=>array(
'<code bidule> machin
truc3 </code>',
'<programlisting> machin
truc3 </programlisting>',
0
),

    );
    public function testBlocks() {
        $wr = new WikiRenderer(new dokuwiki_to_docbook());
        foreach($this->data as $k=>$test){
            list($source, $result, $nberror) = $test;
            $res = $wr->render($source);

            $this->assertEqualOrDiff($result, $res, "error on $k th test");

            if(!$this->assertEqual(count($wr->errors), $nberror, "Errors detected by wr ! (%s)")){
                $this->dump($wr->errors);
            }
        }
    }


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

    function testBlockFiles() {

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

            $this->assertEqualOrDiff($res,$result, "error on $file");

            if(!$this->assertEqual(count($wr->errors),$nberror, "Errors detected by wr ! (%s)")){
                $this->dump($wr->errors);
            }
        }
    }
}

if(!defined('ALL_TESTS')) {
    $test = new dokuwiki_docbook_blocks();
    $test->run(new HtmlReporter2());
}
