<?php
/**
 * Tests unitaires
 *
 * @package wikirenderer
 * @subpackage tests
 * @author Laurent Jouanneau
 * @copyright 2008-2023 Laurent Jouanneau
 */

require_once(WR_DIR.'rules/classicwr_to_xhtml.php');

class classicwr_internalTest extends PHPUnit\Framework\TestCase {

    function _tagtest( $list, $class) {
        $conf= new WRConfigTest();
        foreach($list as $k=> $val){
            $tag = new $class($conf);
            foreach($val[0] as $wiki){
                if($wiki === false)
                    $tag->addSeparator('|');
                elseif(is_string($wiki))
                    $tag->addContent($wiki);
                else
                    $tag->addContent($wiki[0], $wiki[1]);
            }

            $this->assertEquals($val[1], $tag->getWikiContent(), "wikicontent error at number $k");
            $this->assertEquals($val[2], $tag->getContent(), "content error at number $k");
        }
    }


    var $listlinetext = array(
        array(
            array('foo'),
            'foo',
            'foo'),
        array(
            array('foo', 'bar'),
            'foobar',
            'foobar'),
        array(
            array('foo', false, 'bar'),
            'foobar',
            'foo'),
    );

    function testListLineText() {
        $this->_tagtest( $this->listlinetext, 'WikiHtmlTextLine');
    }


    var $listtagstrong = array(
        array(
            array('foo'),
            '__foo__',
            '<strong>foo</strong>'),
        array(
            array('foo', 'bar'),
            '__foobar__',
            '<strong>foobar</strong>'),
        array(
            array('foo', false, 'bar'),
            '__foobar__',
            '<strong>foo</strong>'),
    );

    function testTagStrong() {
        $this->_tagtest( $this->listtagstrong, 'cwrxhtml_strong');
    }

    var $listtagq = array(
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

    function testTagq() {
        $this->_tagtest( $this->listtagq, 'cwrxhtml_q');
    }
}
