<?php
/**
 * @author Laurent Jouanneau
 * @copyright 2014 Laurent Jouanneau
 */

class MdTestsBlocks extends PHPUnit_Framework_TestCase {
/*
    function testParagraph() {
        $genConfig = new \WikiRenderer\Generator\Html\Config();
        $generator = new \WikiRenderer\Generator\Html\Document($genConfig);
        $markupConfig = new \WikiRenderer\Markup\Markdown\Config();
        $wr = new \WikiRenderer\Renderer($generator, $markupConfig);

        $source = 'foo';
        $expected = '<p>foo</p>';

        $result = $wr->render($source);
        $this->assertEquals($expected, $result);
        $this->assertEquals(0, count($wr->errors));

    }

    function test2Paragraph() {
        $genConfig = new \WikiRenderer\Generator\Html\Config();
        $generator = new \WikiRenderer\Generator\Html\Document($genConfig);
        $markupConfig = new \WikiRenderer\Markup\Markdown\Config();
        $wr = new \WikiRenderer\Renderer($generator, $markupConfig);

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
        $this->assertEquals(0, count($wr->errors));
    }
*/
    function getTestsList() {
        $list = array();
        for($i=1; $i <= 8; $i++) {
            $list[] = array('test_'.$i.'.json');
        }
        return $list;
    }

    /**
     * @dataProvider getTestsList
     */
    function testAllSeries($file) {

        $genConfig = new \WikiRenderer\Generator\Html\Config();
        $generator = new \WikiRenderer\Generator\Html\Document($genConfig);
        $markupConfig = new \WikiRenderer\Markup\Markdown\Config();
        $wr = new \WikiRenderer\Renderer($generator, $markupConfig);

        list($md, $html) = json_decode(file_get_contents(__DIR__.'/md_spec/'.$file));
        $result = $wr->render($md);
        $this->assertEquals($html, $result, 'test '.$file."\n`````\n".$md."\n````\n");
    }
}
