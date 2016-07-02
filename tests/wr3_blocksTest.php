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
            array('para1',0),
            array('para2',0),
            array('wr3/wr3_title',0),
            array('wr3/wr3_list1',0),
            array('wr3/wr3_pre',0),
            array('wr3/wr3_hr',0),
            array('wr3/wr3_blockquote',0),
            array('wr3/wr3_definition',0),
            array('wr3/wr3_table',0),
            /*
            array('wr3/wr3_bug12894',0)*/
        );
    }

    /**
     * @dataProvider getListblocks
     */
    function testBlock($file, $nberror) {
        $genConfig = new \WikiRenderer\Generator\Html\Config();
        $generator = new \WikiRenderer\Generator\Html\Document($genConfig);
        $markupConfig = new \WikiRenderer\Markup\WR3\Config();
        $wr = new \WikiRenderer\Renderer($generator, $markupConfig);

        $sourceFile = 'datasblocks/'.$file.'.src';
        $resultFile = 'datasblocks/'.$file.'.res';

        $source = file_get_contents($sourceFile);

        $result = file_get_contents($resultFile);

        $res = $wr->render($source);

        $this->assertEquals($result, $res);
        $this->assertEquals($nberror, count($wr->errors));
    }


    function testFootnotes() {
        $genConfig = new \WikiRenderer\Generator\Html\Config();
        $generator = new \WikiRenderer\Generator\Html\Document($genConfig);
        $markupConfig = new \WikiRenderer\Markup\WR3\Config();
        $wr = new \WikiRenderer\Renderer($generator, $markupConfig);

        $sourceFile = 'datasblocks/wr3/wr3_footnote.src';
        $resultFile = 'datasblocks/wr3/wr3_footnote.res';

        $source = file_get_contents($sourceFile);
        $result = file_get_contents($resultFile);
        $res = $wr->render($source);
        $res .= $generator->getMetaData('footnotes')->generate();

        $res = preg_replace("/footnote\-(\d+)\-(\d+)/", 'footnote-XXX-$2', $res);
        $this->assertEquals($result, $res);
    }

    function testOther() {

        $genConfig = new \WikiRenderer\Generator\Html\Config();
        $generator = new \WikiRenderer\Generator\Html\Document($genConfig);
        $markupConfig = new \WikiRenderer\Markup\WR3\Config();
        $wr = new \WikiRenderer\Renderer($generator, $markupConfig);

        $source = '<code>foo</code>';
        $expected = "<pre>foo\n</pre>";

        $result = $wr->render($source);
        $this->assertEquals($expected, $result);
        $this->assertEquals(0, count($wr->errors));

        $source = "<code>foo</code>
__bar__";
        $expected = "<pre>foo
</pre>
<p><strong>bar</strong></p>";

        $result = $wr->render($source);
        $this->assertEquals($expected, $result);
        $this->assertEquals(0, count($wr->errors));

        $source = '';
        $expected = '';
        $source = "__bar__
<code>foo</code>";
        $expected = "<p><strong>bar</strong></p>
<pre>foo
</pre>";

        $result = $wr->render($source);
        $this->assertEquals($expected, $result);
        $this->assertEquals(0, count($wr->errors));

    }
}
