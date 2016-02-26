<?php
/**
 * Tests unitaires
 *
 * @package wikirenderer
 * @subpackage tests
 * @author Laurent Jouanneau
 * @copyright 2009-2011 Laurent Jouanneau
 */

class DokuWikiXhtmlTestsBlocks extends PHPUnit_Framework_TestCase {

    function getListblocks() {
        return array(
0=>array(
'',
'',
0
),
/*
1=>array(
'<code> machin </code>',
'<pre><code> machin </code></pre>',
0
),

2=>array(
'<code> machin
truc </code>',
'<pre><code> machin
truc </code></pre>',
0
),

3=>array(
'<code bidule> machin
truc3 </code>',
'<pre><code class="language-bidule"> machin
truc3 </code></pre>',
0
),*/
        );
    }

    /**
     * @dataProvider getListblocks
     */
    public function testBlocks($source, $result, $nberror) {
        $genConfig = new \WikiRenderer\Generator\Html\Config();
        $generator = new \WikiRenderer\Generator\Html\Document($genConfig);
        $markupConfig = new \WikiRenderer\Markup\DokuWiki\Config();
        $wr = new \WikiRenderer\Renderer($generator, $markupConfig);
        $res = $wr->render($source);
        $this->assertEquals($result, $res);
        $this->assertEquals($nberror, count($wr->errors));
    }

    function getListblockFiles() {
        return array(
            array('dokuwiki/general',0),
            array('para2',0),
            array('dokuwiki/list',0),
            array('dokuwiki/blockquote',0),
            array('dokuwiki/table',0),
            //array('doku_xhtml_section',0),
            array('dokuwiki/section2',0),
            //array('doku_xhtml_section3',0),
            array('dokuwiki/preformat',0),
        );
    }

    /**
     * @dataProvider getListblockFiles
     */
    function testBlockFiles($file, $nberror) {
        $genConfig = new \WikiRenderer\Generator\Html\Config();
        $generator = new \WikiRenderer\Generator\Html\Document($genConfig);
        $markupConfig = new \WikiRenderer\Markup\DokuWiki\Config();
        $markupConfig->macros['hello'] = function($name, $arg) {
            return '<p>This is the '.$name.' macro with: '.$arg.'</p>';
        };
        $wr = new \WikiRenderer\Renderer($generator, $markupConfig);

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

    function testFootnotes() {
        $genConfig = new \WikiRenderer\Generator\Html\Config();
        $generator = new \WikiRenderer\Generator\Html\Document($genConfig);
        $markupConfig = new \WikiRenderer\Markup\DokuWiki\Config();
        $wr = new \WikiRenderer\Renderer($generator, $markupConfig);

        $sourceFile = 'datasblocks/dokuwiki/footnote.src';
        $resultFile = 'datasblocks/dokuwiki/footnote.res';

        $source = file_get_contents($sourceFile);
        $result = file_get_contents($resultFile);
        $res = $wr->render($source);
        $res .= $generator->getMetaData('footnotes')->generate();

        $res = preg_replace("/footnote\-(\d+)\-(\d+)/", 'footnote-XXX-$2', $res);
        $this->assertEquals($result, $res);
    }
}

