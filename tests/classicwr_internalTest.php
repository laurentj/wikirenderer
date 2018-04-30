<?php
/**
 * Tests unitaires
 *
 * @package wikirenderer
 * @subpackage tests
 * @author Laurent Jouanneau
 * @copyright 2008-2011 Laurent Jouanneau
 */

class classicwr_internalTest extends PHPUnit_Framework_TestCase {

    protected function _tagtest( $chunks, $wikicontent, $htmlcontent, $class) {
        $genConfig = new \WikiRenderer\Generator\Html\Config();
        $generator = new \WikiRenderer\Generator\Html\Document($genConfig);
        $conf= new WRConfigTest();
        $tag = new $class($conf, $generator);
        foreach($chunks as $wiki){
            if($wiki === false) {
                if ($tag instanceof \WikiRenderer\InlineTagWithSeparator) {
                    $tag->addSeparator('|');
                }
            }
            elseif(is_string($wiki)) {
                $tag->addContentString($wiki);
            }
            else {
                $word = new \WikiRenderer\Generator\Html\Words($genConfig);
                $word->init($wiki[1], false);
                $tag->addContentGenerator($wiki[0], $word);
            }
        }

        $this->assertEquals($wikicontent, $tag->getWikiContent());
        $this->assertEquals($htmlcontent, $tag->getContent()->generate());
    }

    function getListlinetext() {
        return  array(
        array(
            array('foo'),
            'foo',
            'foo'),
        array(
            array('foo', 'bar'),
            'foobar',
            'foobar'),
        );
    }
    /**
     * @dataProvider getListlinetext
     */
    function testListLineText($chunks, $wikicontent, $htmlcontent) {
        $this->_tagtest( $chunks, $wikicontent, $htmlcontent, '\WikiRenderer\Markup\WR3\TextLine');
    }

    function getListtagstrong() {
        return  array(
        array(
            array('foo'),
            '__foo__',
            '<strong>foo</strong>'),
        array(
            array('foo', 'bar'),
            '__foobar__',
            '<strong>foobar</strong>'),
        );
    }
    /**
     * @dataProvider getListtagstrong
     */
    function testTagStrong($chunks, $wikicontent, $htmlcontent) {
        $this->_tagtest( $chunks, $wikicontent, $htmlcontent, '\WikiRenderer\Markup\WR3\Strong');
    }

    function getListtagq() {
        return  array(
        array(
            array('foo'),
            '^^foo^^',
            '<q>foo</q>'),
        array(
            array('foo',false, 'bar'),
            '^^foo|bar^^',
            '<q lang="bar">foo</q>'),
        array(
            array('foo', false, 'bar', false,'baz','truc'),
            '^^foo|bar|baztruc^^',
            '<q lang="bar" cite="baztruc">foo</q>'),
        array(
            array('foo',array('__hello__','<strong>hello</strong>'), false, 'bar', false,'baz','truc'),
            '^^foo__hello__|bar|baztruc^^',
            '<q lang="bar" cite="baztruc">foo<strong>hello</strong></q>'),
        array(
            array('foo', false, array('__bar__','<strong>bar</strong>'), 'fleur', false,'baz','truc'),
            '^^foo|__bar__fleur|baztruc^^',
            '<q lang="__bar__fleur" cite="baztruc">foo</q>'),
        );
    }

    /**
     * @dataProvider getListtagq
     */
    function testTagq($chunks, $wikicontent, $htmlcontent) {
        $this->_tagtest( $chunks, $wikicontent, $htmlcontent, '\WikiRenderer\Markup\WR3\Q');
    }
}
