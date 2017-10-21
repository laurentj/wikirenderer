<?php
/**
 * @package wikirenderer
 * @subpackage tests
 * @author Laurent Jouanneau
 * @copyright 2006-2016 Laurent Jouanneau
 */

class WikiRendererTestsWr3Primaire extends PHPUnit_Framework_TestCase {

    function _tagtest( $wikiElements, $wikiContent, $htmlContent, $class) {
        $genConfig = new \WikiRenderer\Generator\Html\Config();
        $generator = new \WikiRenderer\Generator\Html\Document($genConfig);
        $markupConfig = new \WikiRenderer\Markup\WR3\Config();
       
        $tag = new $class($markupConfig, $generator);
        foreach($wikiElements as $wiki){
            if($wiki === false)
                $tag->addSeparator('|');
            elseif(is_string($wiki))
                $tag->addContent($wiki);
            else {
                $w = new \WikiRenderer\Generator\Text\Words($genConfig);
                $w->addRawContent($wiki[1]);
                $tag->addContent($wiki[0], $w);
            }
        }

        $this->assertEquals($wikiContent, $tag->getWikiContent());
        $this->assertEquals($htmlContent, $tag->getContent()->generate());
    }


    function getListLineText() {
        return array(
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
    }

    /**
     * @dataProvider getListLineText
     */
    function testListLineText($wikiElements, $wikiContent, $htmlContent) {
        $this->_tagtest( $wikiElements, $wikiContent, $htmlContent, '\WikiRenderer\Markup\WR3\TextLine');
    }


    function getListtagstrong () {
        return array(
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
    }

    /**
     * @dataProvider getListtagstrong
     */
    function testTagStrong($wikiElements, $wikiContent, $htmlContent) {
        $this->_tagtest($wikiElements, $wikiContent, $htmlContent, '\WikiRenderer\Markup\WR3\Strong');
    }

    function getListtagq() {
        return array(
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
    function testTagq($wikiElements, $wikiContent, $htmlContent) {
        $this->_tagtest( $wikiElements, $wikiContent, $htmlContent, '\WikiRenderer\Markup\WR3\Q');
    }

    function getListtaga() {
        return array(
        array(
            array(array('__bar__','<strong>bar</strong>'), 'fleur', false,'fooo', false, 'baz','truc'),
            '[[__bar__fleur|fooo|baztruc]]',
            '<a href="fooo" hreflang="baztruc"><strong>bar</strong>fleur</a>'),
        );
    }

    /**
     * @dataProvider getListtaga
     */
    function testTaga($wikiElements, $wikiContent, $htmlContent) {
        $this->_tagtest( $wikiElements, $wikiContent, $htmlContent, '\WikiRenderer\Markup\WR3\Link');
    }
}
