<?php
/**
 *
 * @package wikirenderer
 * @subpackage tests
 * @author Laurent Jouanneau
 * @copyright 2006-2016 Laurent Jouanneau
 */

class WR3_NGTestsBlocks extends PHPUnit_Framework_TestCase {

    function testInlineParser() {
        $genConfig = new \WikiRenderer\Generator\Html\Config();
        $generator = new \WikiRenderer\Generator\Html\Html($genConfig);
        $markupConfig = new \WikiRenderer\Markup\WR3\Config();
        $parser = new \WikiRenderer\InlineParserNG($markupConfig, $generator);
        $textline = $parser->parse('lorem ipsum');

        $this->assertEquals('WikiRenderer\Generator\Html\TextLine', get_class($textline));

        $result = $textline->generate();
        $this->assertEquals('lorem ipsum', $result);
    }

    function testTagAttributesParser() {
        $genConfig = new \WikiRenderer\Generator\Html\Config();
        $generator = new \WikiRenderer\Generator\Html\Html($genConfig);
        $markupConfig = new \WikiRenderer\Markup\WR3\Config();
        $parser = new \WikiRenderer\InlineParserNG($markupConfig, $generator);
        $textline = $parser->parse('Lorem ^^ipsum|foo|bar^^ ');

        $this->assertEquals('WikiRenderer\Generator\Html\TextLine', get_class($textline));
        $contents = $textline->getChildGenerators();
        $qhtml = $contents[1];
        $this->assertEquals('WikiRenderer\Generator\Html\Quote', get_class($qhtml));
        $this->assertEquals('foo', $qhtml->getAttribute('lang'));
        $this->assertEquals('bar', $qhtml->getAttribute('cite'));
        $result = $qhtml->generate();
        $this->assertEquals('<q lang="foo" cite="bar">ipsum</q>', $result);
    }

    function testParaBlock() {
        $genConfig = new \WikiRenderer\Generator\Html\Config();
        $generator = new \WikiRenderer\Generator\Html\Html($genConfig);
        $markupConfig = new \WikiRenderer\Markup\WR3\Config();
        $wr = new \WikiRenderer\RendererNG($generator, $markupConfig);

        $block = new \WikiRenderer\Markup\WR3\P($wr, $generator);

        $this->assertTrue($block->detect('lorem ipsum'));
        $block->open();
        $block->validateDetectedLine();
        $generator = $block->close();

        $this->assertEquals('WikiRenderer\Generator\Html\Paragraph', get_class($generator));
        $this->assertEquals("<p>lorem ipsum</p>", $generator->generate());
    }

    var $listblocks = array(
        'b1'=>0,
        'b2'=>0,
        'wr3_title'=>0,
/*        'wr3_list1'=>0,
        'wr3_pre'=>0,
        'wr3_footnote'=>0,
        'wr3_bug12894'=>0*/
    );

    function testBlock() {
        $genConfig = new \WikiRenderer\Generator\Html\Config();
        $generator = new \WikiRenderer\Generator\Html\Html($genConfig);
        $markupConfig = new \WikiRenderer\Markup\WR3\Config();
        $wr = new \WikiRenderer\RendererNG($generator, $markupConfig);

        foreach($this->listblocks as $file=>$nberror){
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
    }
}
