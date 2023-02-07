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

class classicwr_inlineParserTest extends PHPUnit\Framework\TestCase {

    function testInlineParserConstructor() {

        $conf = new WRConfigTest();
        $conf->defaultTextLineContainer= 'WikiHtmlTextLine';
        $conf->textLineContainers = array('WikiHtmlTextLine'=>array( 'cwrxhtml_strong'));
        $wip = new WikiInlineParserTest($conf);
        $trueResult = '/(__)|(\\\\)/';
        $this->assertEquals($trueResult, $wip->getSplitPattern(), "erreur");

        $conf->textLineContainers = array('WikiHtmlTextLine'=>array( 'cwrxhtml_strong','cwrxhtml_em'));
        $conf->simpletags=array('%%%'=>'');

        $wip = new WikiInlineParserTest($conf );
        $trueResult = '/(__)|(\'\')|(%%%)|(\\\\)/';
        $this->assertEquals($trueResult, $wip->getSplitPattern(), "erreur");

        $conf->simpletags=array('%%%'=>'');
        $conf->textLineContainers = array('WikiHtmlTextLine'=>array( 'cwrxhtml_strong','cwrxhtml_q'));
        $wip = new WikiInlineParserTest( $conf);
        $trueResult = '/(__)|(\^\^)|(\\|)|(%%%)|(\\\\)/';
        $this->assertEquals($trueResult, $wip->getSplitPattern(), "erreur");


        $conf->textLineContainers = array('WikiHtmlTextLine'=>array( 'cwrxhtml_strong','cwrxhtml_em','cwrxhtml_code','cwrxhtml_q',
        'cwrxhtml_cite','cwrxhtml_acronym','cwrxhtml_link', 'cwrxhtml_image', 'cwrxhtml_anchor'));
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
        $conf->defaultTextLineContainer= 'WikiHtmlTextLine';
        $conf->textLineContainers = array('WikiHtmlTextLine'=>array( 'cwrxhtml_strong'));

        $wip = new WikiInlineParser($conf);
        foreach($this->listinline1 as $source=>$trueResult){
            $res = $wip->parse($source);
            $this->assertEquals($trueResult,$res, "erreur");
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
            =>'Lorem <img alt="alternative text" src="ipsumdolorsit.png"/> amet, consectetuer adipiscing elit.',
        'Lorem ((ipsumdolorsit.png|alternative text|L)) amet, consectetuer adipiscing elit.'
            =>'Lorem <img style="float:left;" alt="alternative text" src="ipsumdolorsit.png"/> amet, consectetuer adipiscing elit.',
        'Lorem ((ipsumdolorsit.png|alternative text|R|longue description)) amet, consectetuer adipiscing elit.'
            =>'Lorem <img longdesc="longue description" style="float:right;" alt="alternative text" src="ipsumdolorsit.png"/> amet, consectetuer adipiscing elit.',
        'Lorem ~~ipsumdolorsit~~ amet, consectetuer adipiscing elit.'
            =>'Lorem <a name="ipsumdolorsit"></a> amet, consectetuer adipiscing elit.',
        'Lorem \[ipsum dolor|bar|fr] sit amet, \consectetuer \\\\adipiscing \%%%elit.'
            =>'Lorem [ipsum dolor|bar|fr] sit amet, \consectetuer \\adipiscing %%%elit.',
    );

    function testInlineParser2() {
        $conf = new classicwr_to_xhtml();

        $conf->simpletags=array('%%%'=>'');
        $conf->defaultTextLineContainer= 'WikiHtmlTextLine';
        $conf->textLineContainers = array('WikiHtmlTextLine'=>array( 'cwrxhtml_strong','cwrxhtml_em','cwrxhtml_code','cwrxhtml_q',
            'cwrxhtml_cite','cwrxhtml_acronym','cwrxhtml_link', 'cwrxhtml_image', 'cwrxhtml_anchor'));

        $conf->funcCheckWikiWord = null;

        $wip = new WikiInlineParser($conf  );

        $k=0;
        foreach($this->listinline2 as $source=>$trueResult){
            $k++;
            $res = $wip->parse($source);
            $this->assertEquals($trueResult,$res, "erreur");
        }
    }
}
