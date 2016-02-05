<?php
/**
 * Tests unitaires
 *
 * @package wikirenderer
 * @subpackage tests
 * @author Laurent Jouanneau
 * @copyright 2006-2016 Laurent Jouanneau
 */

class DokuWikiDocbookTestBlocks extends PHPUnit_Framework_TestCase {
/*
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

4=>array(
'   <p> lorem ipsum {bla bla}</p>',
'<para>   &lt;p&gt; lorem ipsum {bla bla}&lt;/p&gt;</para>',
0
),
    );
    public function testBlocks() {
        $genConfig = new \WikiRenderer\Generator\Dockbook\Config();
        $generator = new \WikiRenderer\Generator\Dockbook\Document($genConfig);
        $markupConfig = new \WikiRenderer\Markup\DokuWiki\Config();
        $wr = new \WikiRenderer\RendererNG($generator, $markupConfig);

        foreach($this->data as $k=>$test){
            list($source, $result, $nberror) = $test;
            $res = $wr->render($source);
            $this->assertEquals($result, $res, "error on $k th test");
            $this->assertEquals($nberror, count($wr->errors), "Errors detected by wr");
        }
    }
*/

    function getListblocks () {
        return array(
            array('para',0),
            array('para2',0),
            //array('list',0),
            //array('quote',0),
            //array('table',0),
            //array('section',0),
            //array('section2',0),
            //array('section3',0),
            //array('pre',0),
        );
    }

    /**
     * @dataProvider getListblocks
     */
    function testBlockFiles($file, $nberror) {

        $genConfig = new \WikiRenderer\Generator\Dockbook\Config();
        $generator = new \WikiRenderer\Generator\Dockbook\Document($genConfig);
        $markupConfig = new \WikiRenderer\Markup\DokuWiki\Config();
        $wr = new \WikiRenderer\RendererNG($generator, $markupConfig);

        $sourceFile = 'datasblocks/dokuwiki_docbook/doku_dbk_'.$file.'.src';
        $resultFile = 'datasblocks/dokuwiki_docbook/doku_dbk_'.$file.'.res';

        $source = file_get_contents($sourceFile);
        $result = file_get_contents($resultFile);

        $res = $wr->render($source);

        $this->assertEquals($result, $res);
        $this->assertEquals($nberror, count($wr->errors));
    }
}

