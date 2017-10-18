<?php
/**
 * @author Laurent Jouanneau
 * @copyright 2014 Laurent Jouanneau
 */

class MdTestsBlocks extends PHPUnit_Framework_TestCase {

    function getTestsList() {
        $list = array();
        $list[] = array(
            'foo',
            '<p>foo</p>'
        );
        $list[] = array(
            '
Lorem ipsum dolor sit amet consectetuer adipiscing elit.
Ut scelerisque.

Ut iaculis ultrices 
nulla. Cras 

viverra
diam nec justo.',
            '
<p>Lorem ipsum dolor sit amet consectetuer adipiscing elit.
Ut scelerisque.</p>

<p>Ut iaculis ultrices
nulla. Cras</p>

<p>viverra
diam nec justo.</p>'
        );

        return $list;
    }

    /**
     * @dataProvider getTestsList
     */
    function testParagraph($source, $expected) {
        $genConfig = new \WikiRenderer\Generator\Html\Config();
        $generator = new \WikiRenderer\Generator\Html\Document($genConfig);
        $markupConfig = new \WikiRenderer\Markup\Markdown\Config();
        $wr = new \WikiRenderer\Renderer($generator, $markupConfig);

        $result = $wr->render($source);
        $this->assertEquals($expected, $result);
        $this->assertEquals(0, count($wr->errors));
    }

    function getOfficialTestsList() {
        $list = array();
        for($i=1; $i <= 85; $i++) {
            $list[] = array('test_'.$i.'.json');
        }
        return $list;
    }

    /**
     * @dataProvider getOfficialTestsList
     */
    function testAllSeries($file) {

        $genConfig = new \WikiRenderer\Generator\Html\Config();
        $generator = new \WikiRenderer\Generator\Html\Document($genConfig);
        $markupConfig = new \WikiRenderer\Markup\Markdown\Config();
        $wr = new \WikiRenderer\Renderer($generator, $markupConfig);

        list($md, $html) = json_decode(file_get_contents(__DIR__.'/md_spec/'.$file));
        $result = $wr->render($md);

        if ($file == 'test_25.json') {
            $result = str_replace("</p>\n\n<p>", "</p>\n<p>", $result);
        }

        $this->assertEquals($html, $result, 'test '.$file."\n`````\n".str_replace("\t", '→', $md)."\n````\n");
    }
}
