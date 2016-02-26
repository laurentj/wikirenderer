<?php
/**
 * @package wikirenderer
 * @subpackage tests
 * @author Laurent Jouanneau
 * @copyright 2016 Laurent Jouanneau
 */

class dokuwiki_textTest extends PHPUnit_Framework_TestCase {


    function getListblocks () {
        return array(
            array('para',0),
            array('blockquote',0),
            array('general', 0),
            array('list', 0),
            array('preformat', 0),
            array('table', 0),
        );
    }

    /**
     * @dataProvider getListblocks
     */
    function testBlock($file, $nberror) {
        $genConfig = new \WikiRenderer\Generator\Text\Config();
        $generator = new \WikiRenderer\Generator\Text\Document($genConfig);
        $markupConfig = new \WikiRenderer\Markup\DokuWiki\Config();
        $wr = new \WikiRenderer\Renderer($generator, $markupConfig);

        $sourceFile = 'datasblocks/dokuwiki_text/'.$file.'.src';
        $resultFile = 'datasblocks/dokuwiki_text/'.$file.'.res';

        $source = file_get_contents($sourceFile);
        $expected = file_get_contents($resultFile);

        $result = $wr->render($source);

        if ($file == 'general') {
            $result .= $generator->getMetaData('footnotes')->generate();
        }
        $this->assertEquals($expected, $result);
        $this->assertEquals($nberror, count($wr->errors));
    }
}

