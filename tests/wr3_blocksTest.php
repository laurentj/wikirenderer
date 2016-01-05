<?php
/**
 * @package wikirenderer
 * @subpackage tests
 * @author Laurent Jouanneau
 * @copyright 2006-2016 Laurent Jouanneau
 */

class WR3TestsBlocks extends PHPUnit_Framework_TestCase {

    function getListblocks () {
        return array(
            array('b1',0),
            array('b2',0),
            array('wr3_title',0),
            array('wr3_list1',0),
            array('wr3_pre',0),
            /*array('wr3_footnote',0),
            array('wr3_bug12894',0)*/
        );
    }

    /**
     * @dataProvider getListblocks
     */
    function testBlock($file, $nberror) {
        $genConfig = new \WikiRenderer\Generator\Html\Config();
        $generator = new \WikiRenderer\Generator\Html\Html($genConfig);
        $markupConfig = new \WikiRenderer\Markup\WR3\Config();
        $wr = new \WikiRenderer\RendererNG($generator, $markupConfig);

        $sourceFile = 'datasblocks/'.$file.'.src';
        $resultFile = 'datasblocks/'.$file.'.res';

        $source = file_get_contents($sourceFile);

        $result = file_get_contents($resultFile);

        $res = $wr->render($source);

        if($file=='wr3_footnote'){
            $conf = & $wr->getConfig();
            $res=str_replace('-'.$conf->footnotesId.'-', '-XXX-',$res);
        }
        $this->assertEquals($result, $res, "error on $file");
        $this->assertEquals($nberror, count($wr->errors), "Errors detected by wr!");
    }
/*
    function testOther() {

        $genConfig = new \WikiRenderer\Generator\Html\Config();
        $generator = new \WikiRenderer\Generator\Html\Html($genConfig);
        $markupConfig = new \WikiRenderer\Markup\WR3\Config();
        $wr = new \WikiRenderer\RendererNG($generator, $markupConfig);

        $source = '<code>foo</code>';
        $expected = '<pre>foo</pre>';

        $result = $wr->render($source);
        $this->assertEquals($expected, $result);
        $this->assertEquals(0, count($wr->errors));

        $source = "<code>foo</code>
__bar__";
        $expected = "<pre>foo</pre>
<p><strong>bar</strong></p>";

        $result = $wr->render($source);
        $this->assertEquals($expected, $result);
        $this->assertEquals(0, count($wr->errors));

        $source = '';
        $expected = '';
        $source = "__bar__
<code>foo</code>";
        $expected = "<p><strong>bar</strong></p>
<pre>foo</pre>";

        $result = $wr->render($source);
        $this->assertEquals($expected, $result);
        $this->assertEquals(0, count($wr->errors));

    }*/
}
