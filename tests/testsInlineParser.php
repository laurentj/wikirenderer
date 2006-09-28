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
require_once(WR_DIR.'rules/classicwr_to_xhtml.php');

// pour accéder à des propriétés privées et les vérifier
class WikiInlineParserTest extends WikiInlineParser {

    function getSplitPattern(){ return $this->splitPattern; }
    function getListTag(){ return $this->listTag; }
}

class WikiRendererTestsInlineParser extends WikiRendererUnitTestCase {

    function testInlineParserConstructor() {
        $inlinetags=array( 'cwrxhtml_strong');
        $simpletags=array();
        $textLineContainer = 'WikiHtmlTextLine';
        $funcCheckWikiWord = null;

        $wip = new WikiInlineParserTest(array( 'cwrxhtml_strong'), array(), $textLineContainer, $funcCheckWikiWord=null  );
        $trueResult = '/(__)|(\\\\)/';
        if(!$this->assertEqual($trueResult, $wip->getSplitPattern(), "erreur")){
            $this->_showDiff($trueResult,$wip->getSplitPattern());
        }
        $wip = new WikiInlineParserTest(array( 'cwrxhtml_strong','cwrxhtml_em'), array('%%%'=>''), $textLineContainer, $funcCheckWikiWord=null  );
        $trueResult = '/(__)|(\'\')|(%%%)|(\\\\)/';
        if(!$this->assertEqual($trueResult, $wip->getSplitPattern(), "erreur")){
            $this->_showDiff($trueResult,$wip->getSplitPattern());
        }

        $wip = new WikiInlineParserTest(array( 'cwrxhtml_strong','cwrxhtml_q'), array('%%%'=>''), $textLineContainer, $funcCheckWikiWord=null  );
        $trueResult = '/(__)|(\^\^)|(%%%)|(\\|)|(\\\\)/';
        if(!$this->assertEqual($trueResult, $wip->getSplitPattern(), "erreur")){
            $this->_showDiff($trueResult,$wip->getSplitPattern());
        }


        $inlinetags=array( 'cwrxhtml_strong','cwrxhtml_em','cwrxhtml_code','cwrxhtml_q',
        'cwrxhtml_cite','cwrxhtml_acronym','cwrxhtml_link', 'cwrxhtml_image', 'cwrxhtml_anchor');
        $simpletags=array('%%%'=>'', ':-)'=>'');
        $wip = new WikiInlineParserTest($inlinetags, $simpletags, $textLineContainer, $funcCheckWikiWord=null  );
        $trueResult = '/(__)|(\'\')|(@@)|(\\^\\^)|(\\{\\{)|(\\}\\})|(\\?\\?)|(\\[)|(\\])|(\\(\\()|(\\)\\))|(~~)|(%%%)|(\\:-\\))|(\\|)|(\\\\)/';
        if(!$this->assertEqual($trueResult, $wip->getSplitPattern(), "erreur")){
            $this->_showDiff($trueResult,$wip->getSplitPattern());
        }

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
                $this->assertEqual($test[$b][0], $t->beginTag);
                $this->assertEqual($test[$b][1], $t->endTag);
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
        $inlinetags=array( 'cwrxhtml_strong');
        $simpletags=array();
        $textLineContainer = 'WikiHtmlTextLine';
        $funcCheckWikiWord = null;

        $wip = new WikiInlineParser($inlinetags, $simpletags, $textLineContainer, $funcCheckWikiWord=null  );
        foreach($this->listinline1 as $source=>$trueResult){
            $res = $wip->parse($source);
            if(!$this->assertEqual($trueResult,$res, "erreur")){
                $this->_showDiff($trueResult,$res);
            }
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
        $inlinetags=array( 'cwrxhtml_strong','cwrxhtml_em','cwrxhtml_code','cwrxhtml_q',
    'cwrxhtml_cite','cwrxhtml_acronym','cwrxhtml_link', 'cwrxhtml_image', 'cwrxhtml_anchor');
        $simpletags=array('%%%'=>'');
        $textLineContainer = 'WikiHtmlTextLine';
        $funcCheckWikiWord = null;

        $wip = new WikiInlineParser($inlinetags, $simpletags, $textLineContainer, $funcCheckWikiWord=null  );

        $k=0;
        foreach($this->listinline2 as $source=>$trueResult){
            $k++;
            $res = $wip->parse($source);
            if(!$this->assertEqual($trueResult,$res, "erreur")){
                $this->sendMessage('test '.$k++ .' : '.$source);
                $this->_showDiff($trueResult,$res);
            }
        }
    }




}

$test = &new WikiRendererTestsInlineParser();
$test->run(new HtmlReporter2());



?>