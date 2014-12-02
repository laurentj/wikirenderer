<?php
/**
 * @author Laurent Jouanneau
 * @copyright 2014 Laurent Jouanneau
 */

class MdHtmlTestsBlocks extends PHPUnit_Framework_TestCase {

    function testParagraph() {
        $wr = new \WikiRenderer\Renderer(new \WikiRenderer\Markup\MarkdownHtml\Config());
        $source = 'foo';
        $expected = '<p>foo</p>';

        $result = $wr->render($source);
        $this->assertEquals($expected, $result);
        $this->assertEquals(0, count($wr->errors),"Errors detected by wr !");

    }

    function test2Paragraph() {
        $wr = new \WikiRenderer\Renderer(new \WikiRenderer\Markup\MarkdownHtml\Config());
        $source = '
Lorem ipsum dolor sit amet consectetuer adipiscing elit.
Ut scelerisque.

Ut iaculis ultrices nulla. Cras viverra
diam nec justo.';
        $expected = '
<p>Lorem ipsum dolor sit amet consectetuer adipiscing elit.
Ut scelerisque.</p>

<p>Ut iaculis ultrices nulla. Cras viverra
diam nec justo.</p>';

        $result = $wr->render($source);
        $this->assertEquals($expected, $result);
        $this->assertEquals(0, count($wr->errors),"Errors detected by wr !");
    }

    function testAllSeries() {
        $wr = new \WikiRenderer\Renderer(new \WikiRenderer\Markup\MarkdownHtml\Config());
        for($i=1; $i < 509; $i++) {
            list($md, $html) = json_decode(file_get_contents(__DIR__.'/md_spec/test_'.$i.'.json'));
            $result = $wr->render($md);
            $this->assertEquals($html, $result, 'test '.$i);
        }
    }
}
