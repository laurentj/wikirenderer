<?php
/**
 * Tests unitaires
 *
 * @package wikirenderer
 * @subpackage tests
 * @author Laurent Jouanneau
 * @copyright 2008-2016 Laurent Jouanneau
 */

class TracTestsBlocks extends PHPUnit_Framework_TestCase {

    public function listblocks() {
       return array(
          array('trac_title', 0 ),
          array('trac_list', 0 ),
          array('trac_definition', 0 ),
          array('trac_blockquote', 0 ),
          array('trac_table', 0 ),
          array('trac_hr', 0 ),
          array('trac_pre', 0 ),
          //array('trac_demo', 0 ),
       );
    }

    /**
     * @dataProvider listblocks
     */
    function testBlock($file, $nberror) {
        $genConfig = new \WikiRenderer\Generator\Html\Config();
        $generator = new \WikiRenderer\Generator\Html\Document($genConfig);
        $markupConfig = new \WikiRenderer\Markup\Trac\Config();
        $wr = new \WikiRenderer\RendererNG($generator, $markupConfig);

        $sourceFile = 'datasblocks/'.$file.'.src';
        $resultFile = 'datasblocks/'.$file.'.res';

        $source = file_get_contents($sourceFile);
        $expected = file_get_contents($resultFile);
        
        $res = $wr->render($source);

        if ($file == 'wr3_footnote') {
            $conf = $wr->getConfig();
            $res = str_replace('-'.$conf->footnotesId.'-', '-XXX-',$res);
        }

        $this->assertEquals($expected, $res);
        $this->assertEquals($nberror, count($wr->errors));
    }
}

