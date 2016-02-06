<?php
/**
 * Tests unitaires
 *
 * @package wikirenderer
 * @subpackage tests
 * @author Laurent Jouanneau
 * @copyright 2006-2016 Laurent Jouanneau
 */

class DokuWikiDocbookTestBlocks extends PHPUnit_Framework_TestCase {
/*
    protected $data = array(
0=>array(
'',
'',
0
),

1=>array(
'<code> machin </code>',
'<programlisting> machin </programlisting>',
0
),

2=>array(
'<code> machin
truc </code>',
'<programlisting> machin
truc </programlisting>',
0
),


3=>array(
'<code bidule> machin
truc3 </code>',
'<programlisting> machin
truc3 </programlisting>',
0
),

4=>array(
'   <p> lorem ipsum {bla bla}</p>',
'<para>   &lt;p&gt; lorem ipsum {bla bla}&lt;/p&gt;</para>',
0
),
    );
    public function testBlocks() {
        $genConfig = new \WikiRenderer\Generator\Dockbook\Config();
        $generator = new \WikiRenderer\Generator\Dockbook\Document($genConfig);
        $markupConfig = new \WikiRenderer\Markup\DokuWiki\Config();
        $wr = new \WikiRenderer\RendererNG($generator, $markupConfig);

        foreach($this->data as $k=>$test){
            list($source, $result, $nberror) = $test;
            $res = $wr->render($source);
            $this->assertEquals($result, $res, "error on $k th test");
            $this->assertEquals($nberror, count($wr->errors), "Errors detected by wr");
        }
    }
*/

    function getListblocks () {
        return array(
            array('para',0),
            array('para2',0),
            array('list',0),
            array('quote',0),
            //array('table',0),
            //array('section',0),
            //array('section2',0),
            //array('section3',0),
            array('pre',0),
        );
    }

    /**
     * @dataProvider getListblocks
     */
    function testBlockFiles($file, $nberror) {

        $genConfig = new \WikiRenderer\Generator\Docbook\Config();
        $generator = new \WikiRenderer\Generator\Docbook\Document($genConfig);
        $markupConfig = new \WikiRenderer\Markup\DokuWiki\Config();
        $wr = new \WikiRenderer\RendererNG($generator, $markupConfig);

        $sourceFile = 'datasblocks/dokuwiki_docbook/doku_dbk_'.$file.'.src';
        $resultFile = 'datasblocks/dokuwiki_docbook/doku_dbk_'.$file.'.res';

        $source = file_get_contents($sourceFile);
        $result = file_get_contents($resultFile);

        $res = $wr->render($source);

        $this->assertEquals($result, $res);
        $this->assertEquals($nberror, count($wr->errors));
        $this->validateDocbook($res);
    }

    protected function validateDocbook($res) {
        $docbook_rng = getenv('DOCBOOK_RNG');
        if ($docbook_rng) {
            $relaxng = '/usr/share/xml/docbook/schema/rng/5.0/docbook.rng';
            if (strpos($docbook_rng, '.rng') !== false ) {
                $relaxng = $docbook_rng;
            }
            $docbook = '<'."?xml version='1.0'?>\n";
            $docbook .= '<book xmlns="http://docbook.org/ns/docbook" version="5.0">
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

