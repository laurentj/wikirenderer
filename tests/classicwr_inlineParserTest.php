<?php
/**
 * Tests unitaires
 *
 * @package wikirenderer
 * @subpackage tests
 * @author Laurent Jouanneau
 * @copyright 2006-2011 Laurent Jouanneau
 */



class classicwr_inlineParserTest extends PHPUnit_Framework_TestCase {

    function testInlineParserConstructor() {

        $conf = new WRConfigTest();
        $conf->defaultTextLineContainer= '\WikiRenderer\Markup\WR3\TextLine';
        $conf->textLineContainers = array(
                    '\WikiRenderer\Markup\WR3\TextLine'=>array(
                            '\WikiRenderer\Markup\WR3\Strong'));
        $wip = new WikiInlineParserTest($conf);
        $trueResult = '/(__)|(\\\\)/';
        $this->assertEquals($trueResult, $wip->getSplitPattern(), "erreur");

        $conf->textLineContainers = array(
                    '\WikiRenderer\Markup\WR3\TextLine'=>array(
                            '\WikiRenderer\Markup\WR3\Strong',
                            '\WikiRenderer\Markup\WR3\Em'));
        $conf->simpletags=array('%%%'=>'');

        $wip = new WikiInlineParserTest($conf );
        $trueResult = '/(__)|(\'\')|(%%%)|(\\\\)/';
        $this->assertEquals($trueResult, $wip->getSplitPattern(), "erreur");

        $conf->simpletags=array('%%%'=>'');
        $conf->textLineContainers = array(
                    '\WikiRenderer\Markup\WR3\TextLine'=>array(
                            '\WikiRenderer\Markup\WR3\Strong',
                            '\WikiRenderer\Markup\WR3\Q'));
        $wip = new WikiInlineParserTest( $conf);
        $trueResult = '/(__)|(\^\^)|(\\|)|(%%%)|(\\\\)/';
        $this->assertEquals($trueResult, $wip->getSplitPattern(), "erreur");


        $conf->textLineContainers = array(
                    '\WikiRenderer\Markup\WR3\TextLine'=>array(
                            '\WikiRenderer\Markup\WR3\Strong',
                            '\WikiRenderer\Markup\WR3\Em',
                            '\WikiRenderer\Markup\ClassicWR\Code',
                            '\WikiRenderer\Markup\WR3\Q',
                            '\WikiRenderer\Markup\WR3\Cite',
                            '\WikiRenderer\Markup\WR3\Acronym',
                            '\WikiRenderer\Markup\ClassicWR\Link',
                            '\WikiRenderer\Markup\WR3\Image',
                            '\WikiRenderer\Markup\WR3\Anchor'));
        $conf->simpletags=array('%%%'=>'', ':-)'=>'');

        $wip = new WikiInlineParserTest($conf );
        $trueResult = '/(__)|(\'\')|(@@)|(\\^\\^)|(\\{\\{)|(\\}\\})|(\\?\\?)|(\\[)|(\\])|(\\(\\()|(\\)\\))|(~~)|(\\|)|(%%%)|(\\:\\-\\))|(\\\\)/';
        $this->assertEquals($trueResult, $wip->getSplitPattern(), "erreur");

        $test = array(
            '__'=>array('__','__'),
            '\'\''=>array('\'\'','\'\''),
            '@@'=>array('@@','@@'),
            '^^'=>array('^^','^^'),
            '{{'=>array('{{','}}'),
            '??'=>array('??','??'),
            '['=>array('[',']'),
            '(('=>array('((','))'),
            '~~'=>array('~~','~~'),
        );
        foreach($wip->getListTag() as $b=>$t){
            if($this->assertTrue(isset($test[$b]), 'tag présent bizarre '. $b)){
                $this->assertEquals($test[$b][0], $t->beginTag);
                $this->assertEquals($test[$b][1], $t->endTag);
            }
        }
    }

    var $listinline1 = array(

        'Lorem ipsum dolor sit amet, consectetuer adipiscing elit.'
            =>'Lorem ipsum dolor sit amet, consectetuer adipiscing elit.',
        'Lorem ipsum dolor __sit amet__, consectetuer adipiscing elit.'
            =>'Lorem ipsum dolor <strong>sit amet</strong>, consectetuer adipiscing elit.',
    );

    function testInlineParser1() {
        $conf = new WRConfigTest();
        $conf->defaultTextLineContainer= '\WikiRenderer\Markup\WR3\TextLine';
        $conf->textLineContainers = array(
                    '\WikiRenderer\Markup\WR3\TextLine'=>array(
                            '\WikiRenderer\Markup\WR3\Strong'));

        $genConfig = new \WikiRenderer\Generator\Html\Config();
        $generator = new \WikiRenderer\Generator\Html\Document($genConfig);
        $wip = new WikiRenderer\InlineParserNG($conf, $generator);
        foreach($this->listinline1 as $source=>$trueResult){
            $res = $wip->parse($source);
            $this->assertEquals($trueResult, $res->generate(), "erreur");
        }
    }

    var $listinline2 = array(

        'Lorem ipsum dolor sit amet, consectetuer adipiscing elit.'
           =>'Lorem ipsum dolor sit amet, consectetuer adipiscing elit.',
        'Lorem ipsum dolor __sit amet__, consectetuer adipiscing elit.'
            =>'Lorem ipsum dolor <strong>sit amet</strong>, consectetuer adipiscing elit.',
        'Lorem __ipsum dolor__ sit amet, consectetuer adipiscing elit.'
            =>'Lorem <strong>ipsum dolor</strong> sit amet, consectetuer adipiscing elit.',
        'Lorem ipsum dolor \'\'sit amet\'\', consectetuer adipiscing elit.'
            =>'Lorem ipsum dolor <em>sit amet</em>, consectetuer adipiscing elit.',
        'Lorem ipsum dolor sit amet, @@consectetuer@@ adipiscing elit.'
            =>'Lorem ipsum dolor sit amet, <code>consectetuer</code> adipiscing elit.',
        'Lorem ipsum ^^dolor sit amet^^, consectetuer adipiscing elit.'
            =>'Lorem ipsum <q>dolor sit amet</q>, consectetuer adipiscing elit.',
        'Lorem ipsum ^^dolor sit amet|fr^^, consectetuer adipiscing elit.'
            =>'Lorem ipsum <q lang="fr">dolor sit amet</q>, consectetuer adipiscing elit.',
        'Lorem ipsum ^^dolor sit amet|fr|foo bar^^, consectetuer adipiscing elit.'
            =>'Lorem ipsum <q lang="fr" cite="foo bar">dolor sit amet</q>, consectetuer adipiscing elit.',
        'Lorem ipsum dolor sit amet, {{consectetuer adipiscing}} elit.'
            =>'Lorem ipsum dolor sit amet, <cite>consectetuer adipiscing</cite> elit.',
        'Lorem ipsum dolor sit amet, {{consectetuer adipiscing|un titre}} elit.'
            =>'Lorem ipsum dolor sit amet, <cite title="un titre">consectetuer adipiscing</cite> elit.',
        'Lorem ipsum dolor sit amet, ??consectetuer adipiscing?? elit.'
            =>'Lorem ipsum dolor sit amet, <acronym>consectetuer adipiscing</acronym> elit.',
        'Lorem ipsum dolor sit amet, ??consectetuer adipiscing|un titre?? elit.'
            =>'Lorem ipsum dolor sit amet, <acronym title="un titre">consectetuer adipiscing</acronym> elit.',
        'Lorem [ipsum dolor] sit amet, consectetuer adipiscing elit.'
            =>'Lorem <a href="ipsum dolor">ipsum dolor</a> sit amet, consectetuer adipiscing elit.',
        'Lorem [ipsum dolor|http://foo.com] sit amet, consectetuer adipiscing elit.'
            =>'Lorem <a href="http://foo.com">ipsum dolor</a> sit amet, consectetuer adipiscing elit.',
        'Lorem [ipsum dolor|javascript:alert(window.title)] sit amet, consectetuer adipiscing elit.'
            =>'Lorem <a href="#">ipsum dolor</a> sit amet, consectetuer adipiscing elit.',
        'Lorem [ipsum dolor|bar|fr] sit amet, consectetuer adipiscing elit.'
            =>'Lorem <a href="bar" hreflang="fr">ipsum dolor</a> sit amet, consectetuer adipiscing elit.',
        'Lorem [ipsum dolor|bar|fr|ceci est un titre] sit amet, consectetuer adipiscing elit.'
            =>'Lorem <a href="bar" hreflang="fr" title="ceci est un titre">ipsum dolor</a> sit amet, consectetuer adipiscing elit.',
        'Lorem ((ipsumdolorsit.png)) amet, consectetuer adipiscing elit.'
            =>'Lorem <img src="ipsumdolorsit.png" alt=""/> amet, consectetuer adipiscing elit.',
        'Lorem ((ipsumdolorsit.png|alternative text)) amet, consectetuer adipiscing elit.'
            =>'Lorem <img src="ipsumdolorsit.png" alt="alternative text"/> amet, consectetuer adipiscing elit.',
        'Lorem ((ipsumdolorsit.png|alternative text|L)) amet, consectetuer adipiscing elit.'
            =>'Lorem <img src="ipsumdolorsit.png" alt="alternative text" style="float:left;"/> amet, consectetuer adipiscing elit.',
        'Lorem ((ipsumdolorsit.png|alternative text|R|longue description)) amet, consectetuer adipiscing elit.'
            =>'Lorem <img src="ipsumdolorsit.png" alt="alternative text" longdesc="longue description" style="float:right;"/> amet, consectetuer adipiscing elit.',
        'Lorem ~~ipsumdolorsit~~ amet, consectetuer adipiscing elit.'
            =>'Lorem <span id="ipsumdolorsit" class="wikianchor"><a href="#ipsumdolorsit" class="anchor">¶</a></span> amet, consectetuer adipiscing elit.',
        'Lorem \[ipsum dolor|bar|fr] sit amet, \consectetuer \\\\adipiscing \%%%elit.'
            =>'Lorem [ipsum dolor|bar|fr] sit amet, \consectetuer \\adipiscing %%%elit.',
    );

    function testInlineParser2() {
        $genConfig = new \WikiRenderer\Generator\Html\Config();
        $generator = new \WikiRenderer\Generator\Html\Document($genConfig);

        $conf = new \WikiRenderer\Markup\ClassicWR\Config();
        $conf->simpletags=array('%%%'=>'');
        $conf->defaultTextLineContainer= '\WikiRenderer\Markup\WR3\TextLine';
        $conf->textLineContainers = array(
                    '\WikiRenderer\Markup\WR3\TextLine'=>array(
                        '\WikiRenderer\Markup\WR3\Strong',
                        '\WikiRenderer\Markup\WR3\Em',
                        '\WikiRenderer\Markup\ClassicWR\Code',
                        '\WikiRenderer\Markup\WR3\Q',
                        '\WikiRenderer\Markup\WR3\Cite',
                        '\WikiRenderer\Markup\WR3\Acronym',
                        '\WikiRenderer\Markup\ClassicWR\Link',
                        '\WikiRenderer\Markup\WR3\Image',
                        '\WikiRenderer\Markup\WR3\Anchor'));

        $conf->funcCheckWikiWord = null;

        $wip = new WikiRenderer\InlineParserNG($conf, $generator);

        $k=0;
        foreach($this->listinline2 as $source=>$trueResult){
            $k++;
            $res = $wip->parse($source);
            $this->assertEquals($trueResult,$res->generate(), "erreur");
        }
    }
}
