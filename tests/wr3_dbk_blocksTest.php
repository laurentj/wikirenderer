<?php
/**
 * Tests unitaires
 *
 * @package wikirenderer
 * @subpackage tests
 * @author Laurent Jouanneau
 * @copyright 2006-2013 Laurent Jouanneau
 */

class WR3DBKTestsBlocks extends PHPUnit_Framework_TestCase {

    function getListblocks() {
        return array(
            array('dbk_para1',0),
            array('dbk_para2',0),
            array('dbk_list1',0),
            array('dbk_wr3_pre',0),
            //array('wr3/wr3_footnote',0),
        );
    }

    /**
     * @dataProvider getListblocks
     */
    function testBlock($file, $nberror) {

        $genConfig = new \WikiRenderer\Generator\Docbook\Config();
        $generator = new \WikiRenderer\Generator\Docbook\Document($genConfig);

        $config = new \WikiRenderer\Markup\WR3\Config();

        $wr = new \WikiRenderer\RendererNG($generator, $config);
        $sourceFile = 'datasblocks/wr3_docbook/'.$file.'.src';
        $resultFile = 'datasblocks/wr3_docbook/'.$file.'.res';

        $source = file_get_contents($sourceFile);
        $expected = file_get_contents($resultFile);

        $res = $wr->render($source);

        $this->assertEquals($expected, $res);
        $this->assertEquals($nberror, count($wr->errors));
        $this->validateDocbook($res);
    }

    function getListblocks2() {
        return array(
            array('dbk_wr3_section',0),
            array('dbk_wr3_section2',0),
            array('dbk_wr3_section3',0),
        );
    }

    /**
     * @dataProvider getListblocks2
     */
/*    function testBlock2($file, $nberror) {

        $genConfig = new \WikiRenderer\Generator\Docbook\Config();
        $generator = new \WikiRenderer\Generator\Docbook\Document($genConfig);

        $config = new \WikiRenderer\Markup\WR3\Config();

        $wr = new \WikiRenderer\RendererNG($generator, $config);
        $sourceFile = 'datasblocks/wr3_docbook/'.$file.'.src';
        $resultFile = 'datasblocks/wr3_docbook/'.$file.'.res';

        $source = file_get_contents($sourceFile);
        $expected = file_get_contents($resultFile);

        $res = $wr->render($source);

        $this->assertEquals($expected, $res);
        $this->assertEquals($nberror, count($wr->errors));
        $this->validateDocbook($res);
    }
*/
    protected function validateDocbook($res) {
        $docbook_rng = getenv('DOCBOOK_RNG');
        if ($docbook_rng) {
            $relaxng = '/usr/share/xml/docbook/schema/rng/5.0/docbook.rng';
            if (strpos($docbook_rng, '.rng') !== false ) {
                $relaxng = $docbook_rng;
            }
            $docbook = '<'."?xml version='1.0'?>\n";
            $docbook .= '<book xmlns="http://docbook.org/ns/docbook" xmlns:xlink="http://www.w3.org/1999/xlink" version="5.0">
<title>My First Book</title><article><title>test</title>
';
            $docbook .= $res;
            $docbook .= '</article></book>';

            file_put_contents('docbook_result.xml', $docbook);
            $output = array();
            $returnCode = 0;
            $cmd = "xmllint --relaxng ".escapeshellcmd($relaxng).' --noout docbook_result.xml 2>&1';
            exec($cmd, $output, $returnCode);
            $this->assertEquals("docbook_result.xml validates", implode("\n", $output));
        }

    }

}
