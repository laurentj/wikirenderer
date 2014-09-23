<?php
/**
 * Tests unitaires
 *
 * @package wikirenderer
 * @subpackage tests
 * @author Laurent Jouanneau
 * @copyright 2006-2013 Laurent Jouanneau
 */

class WikiRendererTestsWr3Docbook extends PHPUnit_Framework_TestCase {

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

            $this->assertEquals($val[1], $tag->getWikiContent(), "erreur wikicontent au numero $k");
            $this->assertEquals($val[2], $tag->getContent(), "erreur content au numero $k");
        }
    }

    var $listtagstrong = array(
        array(
            array('foo'),
            '__foo__',
            '<emphasis role="strong">foo</emphasis>'),
        array(
            array('foo', 'bar'),
            '__foobar__',
            '<emphasis role="strong">foobar</emphasis>'),
        array(
            array('foo', false, 'bar'),
            '__foobar__',
            '<emphasis role="strong">foo</emphasis>'),
    );

    function testTagStrong() {
        $this->_tagtest( $this->listtagstrong, '\WikiRenderer\Markup\WR3DocBook\Strong');
    }

    var $listtagq = array(
        array(
            array('foo'),
            '^^foo^^',
            '<quote>foo</quote>'),
        array(
            array('foo',false, 'bar'),
            '^^foo|bar^^',
            '<quote lang="bar">foo</quote>'),
        array(
            array('foo', false, 'bar', false,'baz','truc'),
            '^^foo|bar|baztruc^^',
            '<quote lang="bar">foo</quote>'),
        array(
            array('foo',array('__hello__','<strong>hello</strong>'), false, 'bar', false,'baz','truc'),
            '^^foo__hello__|bar|baztruc^^',
            '<quote lang="bar">foo<strong>hello</strong></quote>'),
        array(
            array('foo', false, array('__bar__','<strong>bar</strong>'), 'fleur', false,'baz','truc'),
            '^^foo|__bar__fleur|baztruc^^',
            '<quote lang="__bar__fleur">foo</quote>'),
    );

    function testTagq() {
        $this->_tagtest( $this->listtagq, '\WikiRenderer\Markup\WR3DocBook\Q');
    }

    var $listtaga = array(
        array(
            array(array('__bar__','<strong>bar</strong>'), 'fleur', false,'fooo', false, 'baz','truc'),
            '[[__bar__fleur|fooo|baztruc]]',
            '<link xlink:href="fooo"><strong>bar</strong>fleur</link>'),
    );

    function testTaga() {
        $this->_tagtest( $this->listtaga, '\WikiRenderer\Markup\WR3DocBook\Link');
    }
}

