<?php
/**
 * Tests unitaires
 *
 * @package wikirenderer
 * @subpackage tests
 * @author Laurent Jouanneau
 * @copyright 2006-2023 Laurent Jouanneau
 */

require_once(WR_DIR.'rules/classicwr_to_xhtml.php');

class classicwr_blocksTest extends PHPUnit\Framework\TestCase {

    public function getListBlocks()
    {
        return array(
            ['b1', 0],
            ['b2', 0],
            ['demo', 0],
            ['list1', 0],
            ['list2', 0],
        );
    }

    /**
     * @dataProvider getListBlocks
     */
    function testBlock($file, $nberror)
    {
        $wr = new WikiRenderer('classicwr_to_xhtml');
        $sourceFile = 'datasblocks/'.$file.'.src';
        $resultFile = 'datasblocks/'.$file.'.res';

        $handle = fopen($sourceFile, "r");
        $source = fread($handle, filesize($sourceFile));
        fclose($handle);

        $handle = fopen($resultFile, "r");
        $result = fread($handle, filesize($resultFile));
        fclose($handle);

        $res = $wr->render($source);
        $this->assertEquals($result, $res);
        $this->assertEquals($nberror, count($wr->errors), "WR found errors (%s)");
    }
}
