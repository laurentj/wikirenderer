<?php
/**
 * @package wikirenderer
 * @subpackage tests
 * @author Laurent Jouanneau
 * @copyright 2009-2016 Laurent Jouanneau
 */

class jWikiBlocksTest extends PHPUnit_Framework_TestCase {

    function getListblockFiles() {
        return array(
            array('para2',0),
            array('jwiki/list',0),
            array('jwiki/blockquote',0),
            array('jwiki/table',0),
            array('jwiki/section2',0),
            array('jwiki/preformat',0),
        );
    }

    /**
     * @dataProvider getListblockFiles
     */
    function testBlockFiles($file, $nberror) {
        $genConfig = new \WikiRenderer\Generator\Html\Config();
        $generator = new \WikiRenderer\Generator\Html\Document($genConfig);
        $markupConfig = new \WikiRenderer\Markup\JWiki\Config();
        $wr = new \WikiRenderer\RendererNG($generator, $markupConfig);

        $sourceFile = 'datasblocks/'.$file.'.src';
        $resultFile = 'datasblocks/'.$file.'.res';

        $source = file_get_contents($sourceFile);
        $expected = file_get_contents($resultFile);

        $res = $wr->render($source);
        if($file=='general'){
            $conf = & $wr->getConfig();
            $res=str_replace('-'.$conf->footnotesId.'-', '-XXX-',$res);
        }
        $this->assertEquals($expected, $res);
        $this->assertEquals($nberror, count($wr->errors));
    }
}

