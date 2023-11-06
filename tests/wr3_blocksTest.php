<?php
/**
 * Tests unitaires
 *
 * @package wikirenderer
 * @subpackage tests
 * @author Laurent Jouanneau
 * @copyright 2006-2023 Laurent Jouanneau
 */

require_once(WR_DIR.'rules/wr3_to_xhtml.php');


class YellowTag extends WikiTag {

    public $beginTag='&&';

    public $endTag='&&';

    public $attribute = array('$$');

    public function getContent()
    {
        return '<code>'.json_encode($this->contents).'</code>';
    }
}


class WR3TestsBlocks extends PHPUnit\Framework\TestCase {

    var $listblocks = array(
        'b1'=>0,
        'b2'=>0,
        'wr3_list1'=>0,
        'wr3_pre'=>0,
        'wr3_footnote'=>0,
        'wr3_bug12894'=>0
    );

    function testBlock() {

        $wr = new WikiRenderer(new wr3_to_xhtml());
        foreach($this->listblocks as $file=>$nberror){
            $sourceFile = 'datasblocks/'.$file.'.src';
            $resultFile = 'datasblocks/'.$file.'.res';

            $source = file_get_contents($sourceFile);

            $result = file_get_contents($resultFile);

            $res = $wr->render($source);

            if($file=='wr3_footnote'){
                $conf = $wr->getConfig();
                $res=str_replace('-'.$conf->footnotesId.'-', '-XXX-',$res);
            }
            $this->assertEquals($result, $res, "error on $file");
            $this->assertEquals($nberror, count($wr->errors), "Errors detected by wr!");
        }
    }

    function testOther() {

        $wr = new WikiRenderer(new wr3_to_xhtml());

        $source = '<code>foo</code>';
        $expected = '<pre>foo</pre>';

        $result = $wr->render($source);
        $this->assertEquals($expected, $result);
        $this->assertEquals(0, count($wr->errors),"Errors detected by wr !");

        $source = "<code>foo</code>
__bar__";
        $expected = "<pre>foo</pre>
<p><strong>bar</strong></p>";

        $result = $wr->render($source);
        $this->assertEquals($expected, $result);
        $this->assertEquals(0, count($wr->errors),"Errors detected by wr !");

        $source = '';
        $expected = '';
        $source = "__bar__
<code>foo</code>";
        $expected = "<p><strong>bar</strong></p>
<pre>foo</pre>";

        $result = $wr->render($source);
        $this->assertEquals($expected, $result);
        $this->assertEquals(0, count($wr->errors),"Errors detected by wr !");

    }

    function testYellowTag()
    {
        $config = new wr3_to_xhtml();
        $config->textLineContainers['WikiHtmlTextLine'][] = 'YellowTag';
        $wr = new WikiRenderer($config);

        $source = 'Hello __world__, this is a &&jaune&& tag';
        $expected = '<p>Hello <strong>world</strong>, this is a <code>["jaune"]</code> tag</p>';

        $result = $wr->render($source);
        $this->assertEquals($expected, $result);
        $this->assertEquals(0, count($wr->errors),"Errors detected by wr !");
    }
}
