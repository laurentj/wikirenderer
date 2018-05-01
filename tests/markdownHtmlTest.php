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
        $genConfig->syntaxClassPattern = 'language-%s';
        $generator = new \WikiRenderer\Generator\Html\Document($genConfig);
        $markupConfig = new \WikiRenderer\Markup\Markdown\Config();
        $wr = new \WikiRenderer\Renderer($generator, $markupConfig);

        $result = $wr->render($source);
        $this->assertEquals($expected, $result);
        $this->assertEquals(0, count($wr->errors));
    }

    function getOfficialTestsList() {
        $list = array();
        $skipped = array(
            166 => 'definition of links at bottom not supported',
            167 => 'definition of links at bottom not supported',
            169 => 'url encoding of utf-8 chars not supported',
            171 => 'definition of links: label on multiline is not ignored',
            177 => 'definition of links at bottom not supported',
            179 => 'definition of links at bottom not supported',
        );
        for($i=1; $i <= 179; $i++) { //618
            if (isset($skipped[$i])) {
                $list[] = array(false, $skipped[$i]);
            }
            else {
                $list[] = array('test_'.$i.'.json', null);
            }
        }
        return $list;
    }

    /**
     * @dataProvider getOfficialTestsList
     */
    function testAllSeries($file, $reason) {

        $genConfig = new \WikiRenderer\Generator\Html\Config();
        $genConfig->syntaxClassPattern = 'language-%s';
        $genConfig->htmlEncloseContent = false;
        $generator = new \WikiRenderer\Generator\Html\Document($genConfig);
        $markupConfig = new \WikiRenderer\Markup\Markdown\Config();
        $wr = new \WikiRenderer\Renderer($generator, $markupConfig);

        if ($file === false) {
            $this->markTestSkipped($reason);
            return;
        }

        list($md, $html) = json_decode(file_get_contents(__DIR__.'/md_spec/'.$file));
        $result = $wr->render($md);

        if (preg_match('/^test_(\d+)\.json$/', $file, $num)) {
            //$num = $num[1];
            $html = preg_replace("/<\\/([a-z]+)>\s+<([a-z]+)>/m", "</$1>\n<$2>", $html);
            $result = preg_replace("/<\\/([a-z]+)>\s+<([a-z]+)>/m", "</$1>\n<$2>", $result);
            //if ($num >= 157 && $num <= 179) {
                $result = preg_replace("/^(\s+)/", "", $result);
                $html = preg_replace("/^(\s+)/", "", $html);
            //}
        }

        $this->assertEquals($html, $result, 'test '.$file."\n----------------->8--\n".str_replace("\t", '→', $md)."\n----------------->8--\n");
    }
}
