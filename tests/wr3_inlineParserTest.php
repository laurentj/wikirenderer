<?php
/**
 * Tests unitaires
 *
 * @package wikirenderer
 * @subpackage tests
 * @author Laurent Jouanneau
 * @copyright 2006-2013 Laurent Jouanneau
 */

class WR3TestsInlineParser extends PHPUnit_Framework_TestCase {

    function testInlineParserConstructor() {

        $conf = new WRConfigTest();
        $conf->defaultTextLineContainer= '\WikiRenderer\HtmlTextLine';
        $conf->textLineContainers = array('\WikiRenderer\HtmlTextLine'=>array( '\WikiRenderer\Markup\WR3Html\Strong'));

        $wip = new WikiInlineParserTest($conf);
        $trueResult = '/(__)|(\\\\)/';
        $this->assertEquals($trueResult, $wip->getSplitPattern());

        $conf->textLineContainers = array('\WikiRenderer\HtmlTextLine'=>array( '\WikiRenderer\Markup\WR3Html\Strong','\WikiRenderer\Markup\WR3Html\Em'));
        $conf->simpletags=array('%%%'=>'');

        $wip = new WikiInlineParserTest($conf );
        $trueResult = '/(__)|(\'\')|(%%%)|(\\\\)/';
        $this->assertEquals($trueResult, $wip->getSplitPattern());

        $conf->textLineContainers = array('\WikiRenderer\HtmlTextLine'=>array( '\WikiRenderer\Markup\WR3Html\Strong','\WikiRenderer\Markup\WR3Html\Q'));
        $conf->simpletags=array('%%%'=>'');

        $wip = new WikiInlineParserTest( $conf);
        $trueResult = '/(__)|(\^\^)|(\\|)|(%%%)|(\\\\)/';
        $this->assertEquals($trueResult, $wip->getSplitPattern());

        $conf->textLineContainers = array('\WikiRenderer\HtmlTextLine'=>array(
            '\WikiRenderer\Markup\WR3Html\Strong',
            '\WikiRenderer\Markup\WR3Html\Em',
            '\WikiRenderer\Markup\WR3Html\Code',
            '\WikiRenderer\Markup\WR3Html\Q',
            '\WikiRenderer\Markup\WR3Html\Cite',
            '\WikiRenderer\Markup\WR3Html\Acronym',
            '\WikiRenderer\Markup\WR3Html\Link',
            '\WikiRenderer\Markup\WR3Html\Image',
            '\WikiRenderer\Markup\WR3Html\Anchor'));
        $conf->simpletags=array('%%%'=>'', ':-)'=>'');

        $wip = new WikiInlineParserTest($conf );
        $trueResult = '/(__)|(\'\')|(@@)|(\\^\\^)|(\\{\\{)|(\\}\\})|(\\?\\?)|(\\[\\[)|(\\]\\])|(\\(\\()|(\\)\\))|(~~)|(\\|)|(%%%)|(\\:\\-\\))|(\\\\)/';
        $this->assertEquals($trueResult, $wip->getSplitPattern());

        $test = array(
            '__'=>array('__','__'),
            '\'\''=>array('\'\'','\'\''),
            '@@'=>array('@@','@@'),
            '^^'=>array('^^','^^'),
            '{{'=>array('{{','}}'),
            '??'=>array('??','??'),
            '[['=>array('[[',']]'),
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
        $conf->textLineContainers = array ('\WikiRenderer\HtmlTextLine' => array(
            '\WikiRenderer\Markup\WR3Html\Strong',
        ));

        $conf->defaultTextLineContainer= '\WikiRenderer\HtmlTextLine';

        $wip = new \WikiRenderer\InlineParser($conf);
        foreach($this->listinline1 as $source=>$trueResult){
            $res = $wip->parse($source);
            $this->assertEquals($trueResult,$res);
        }
    }

    var $listinline2 = array(

        'Lorem ipsum dolor sit amet, consectetuer adipiscing elit.'
           =>'Lorem ipsum dolor sit amet, consectetuer adipiscing elit.',
        'Lorem ipsum dolor __sit amet__, consectetuer adipiscing elit.'
            =>'Lorem ipsum dolor <strong>sit amet</strong>, consectetuer adipiscing elit.',
        'Lorem ipsum dolor __0__, consectetuer adipiscing elit.'
            =>'Lorem ipsum dolor <strong>0</strong>, consectetuer adipiscing elit.',
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
        'Lorem [[ipsum dolor]] sit amet, consectetuer adipiscing elit.'
            =>'Lorem <a href="ipsum dolor">ipsum dolor</a> sit amet, consectetuer adipiscing elit.',
        'Lorem [[ipsum dolor|http://foo.com]] sit amet, consectetuer adipiscing elit.'
            =>'Lorem <a href="http://foo.com">ipsum dolor</a> sit amet, consectetuer adipiscing elit.',
        'Lorem [[ipsum dolor|javascript:alert(window.title)]] sit amet, consectetuer adipiscing elit.'
            =>'Lorem <a href="#">ipsum dolor</a> sit amet, consectetuer adipiscing elit.',
        'Lorem [[ipsum dolor|bar|fr]] sit amet, consectetuer adipiscing elit.'
            =>'Lorem <a href="bar" hreflang="fr">ipsum dolor</a> sit amet, consectetuer adipiscing elit.',
        'Lorem [[ipsum dolor|bar|fr|ceci est un titre]] sit amet, consectetuer adipiscing elit.'
            =>'Lorem <a href="bar" hreflang="fr" title="ceci est un titre">ipsum dolor</a> sit amet, consectetuer adipiscing elit.',
        'Lorem ((ipsumdolorsit.png)) amet, consectetuer adipiscing elit.'
            =>'Lorem <img src="ipsumdolorsit.png" alt=""/> amet, consectetuer adipiscing elit.',
        'Lorem ((ipsumdolorsit.png|alternative text)) amet, consectetuer adipiscing elit.'
            =>'Lorem <img alt="alternative text" src="ipsumdolorsit.png"/> amet, consectetuer adipiscing elit.',
        'Lorem ((ipsumdolorsit.png|alternative text|L)) amet, consectetuer adipiscing elit.'
            =>'Lorem <img style="float:left;" alt="alternative text" src="ipsumdolorsit.png"/> amet, consectetuer adipiscing elit.',
        'Lorem ((ipsumdolorsit.png|alternative text|R|longue description)) amet, consectetuer adipiscing elit.'
            =>'Lorem <img longdesc="longue description" style="float:right;" alt="alternative text" src="ipsumdolorsit.png"/> amet, consectetuer adipiscing elit.',
        'Lorem ~~ipsumdolorsit~~ amet, consectetuer adipiscing elit.'
            =>'Lorem <a name="ipsumdolorsit"></a> amet, consectetuer adipiscing elit.',
        'Lorem \[[ipsum dolor|bar|fr]] sit amet, \consectetuer \\\\adipiscing \%%%elit.'
            =>'Lorem [[ipsum dolor|bar|fr]] sit amet, \consectetuer \\adipiscing %%%elit.',
        'Lorem ipsum ^^dolor [[ipsum dolor|bar|fr]] amet|fr^^, consectetuer adipiscing elit.'
            =>'Lorem ipsum <q lang="fr">dolor <a href="bar" hreflang="fr">ipsum dolor</a> amet</q>, consectetuer adipiscing elit.',
    );

    function testInlineParser2() {
        $conf = new \WikiRenderer\Markup\WR3Html\Config();

        $wip = new \WikiRenderer\InlineParser($conf  );

        $k=0;
        foreach($this->listinline2 as $source=>$trueResult){
            $k++;
            $res = $wip->parse($source);
            $this->assertEquals($trueResult,$res);
        }
    }


    function testFootnote() {
        $conf = new \WikiRenderer\Markup\WR3Html\Config();
        $conf->onStart('');
        $wip = new \WikiRenderer\InlineParser($conf);

        $source='Lorem ipsum dolor sit amet, $$consectetuer __adipis__cing$$ elit.';

        $res = $wip->parse($source);

        $id = 'footnote-'.$conf->footnotesId.'-1';
        $trueResult='Lorem ipsum dolor sit amet, <span class="footnote-ref">[<a href="#'.$id.'" name="rev-'.$id.'" id="rev-'.$id.'">1</a>]</span> elit.';
        $trueFootnote = '<p>[<a href="#rev-'.$id.'" name="'.$id.'" id="'.$id.'">1</a>] consectetuer <strong>adipis</strong>cing</p>';

        $this->assertEquals($trueResult,$res);
        $this->assertEquals(1,count($conf->footnotes));
        $this->assertEquals($trueFootnote, $conf->footnotes[0]);
    }


}
