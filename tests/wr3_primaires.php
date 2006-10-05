<?php
/**
 * Tests unitaires
 *
 * @package wikirenderer
 * @subpackage tests
 * @author Laurent Jouanneau <jouanneau@netcourrier.com>
 * @copyright 2006 Laurent Jouanneau
 */

require_once('common.php');
require_once(WR_DIR.'rules/wr3_to_xhtml.php');

class WRConfigTest extends WikiRendererConfig { }

class WikiRendererTestsWr3Primaire extends WikiRendererUnitTestCase {

    function _tagtest( $list, $class) {
        $conf= new WRConfigTest();
        foreach($list as $k=> $val){
            $tag = new $class($conf);
            foreach($val[0] as $wiki){
                if($wiki === false)
                    $tag->addSeparator();
                elseif(is_string($wiki))
                    $tag->addContent($wiki);
                else
                    $tag->addContent($wiki[0], $wiki[1]);
            }

            if(!$this->assertEqual($val[1], $tag->getWikiContent(), "erreur wikicontent au numéro $k")){
                $this->_showDiff($val[1], $tag->getWikiContent());
            }
            if(!$this->assertEqual($val[2], $tag->getContent(), "erreur content au numéro $k")){
                $this->_showDiff($val[2], $tag->getContent());
            }

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
            '**foo**',
            '<strong>foo</strong>'),
        array(
            array('foo', 'bar'),
            '**foobar**',
            '<strong>foobar</strong>'),
        array(
            array('foo', false, 'bar'),
            '**foobar**',
            '<strong>foo</strong>'),
    );

    function testTagStrong() {
        $this->_tagtest( $this->listtagstrong, 'wr3xhtml_strong');
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
            array('foo',array('**hello**','<strong>hello</strong>'), false, 'bar', false,'baz','truc'),
            '^^foo**hello**|bar|baztruc^^',
            '<q lang="bar" cite="baztruc">foo<strong>hello</strong></q>'),
        array(
            array('foo', false, array('**bar**','<strong>bar</strong>'), 'fleur', false,'baz','truc'),
            '^^foo|**bar**fleur|baztruc^^',
            '<q lang="**bar**fleur" cite="baztruc">foo</q>'),
    );

    function testTagq() {
        $this->_tagtest( $this->listtagq, 'wr3xhtml_q');
    }

    var $listtaga = array(
        array(
            array(array('**bar**','<strong>bar</strong>'), 'fleur', false,'fooo', false, 'baz','truc'),
            '[[**bar**fleur|fooo|baztruc]]',
            '<a href="fooo" hreflang="baztruc"><strong>bar</strong>fleur</a>'),
    );

    function testTaga() {
        $this->_tagtest( $this->listtaga, 'wr3xhtml_link');
    }
}

$test = &new WikiRendererTestsWr3Primaire();
$test->run(new HtmlReporter2());



?>