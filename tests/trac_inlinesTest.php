<?php
/**
 * Tests unitaires
 *
 * @package wikirenderer
 * @subpackage tests
 * @author Laurent Jouanneau
 * @copyright 2008-2023 Laurent Jouanneau
 */

require_once(WR_DIR.'rules/trac_to_xhtml.php');

class TracTestsInlines extends PHPUnit\Framework\TestCase {
    var $listinline = array(

        'Lorem ipsum dolor sit amet, consectetuer adipiscing elit.'
            =>'<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>',
        "Lorem '''''ipsum dolor''''' sit amet, consectetuer adipiscing elit."
            =>'<p>Lorem <strong><em>ipsum dolor</em></strong> sit amet, consectetuer adipiscing elit.</p>',
        "Lorem '''ipsum dolor''' sit amet, consectetuer adipiscing elit."
            =>'<p>Lorem <strong>ipsum dolor</strong> sit amet, consectetuer adipiscing elit.</p>',
        "Lorem ''ipsum dolor'' sit amet, consectetuer adipiscing elit."
            =>'<p>Lorem <em>ipsum dolor</em> sit amet, consectetuer adipiscing elit.</p>',
        "Lorem '''''ipsum dolor''''' sit ''amet'', '''consectetuer''' adipiscing elit."
            =>'<p>Lorem <strong><em>ipsum dolor</em></strong> sit <em>amet</em>, <strong>consectetuer</strong> adipiscing elit.</p>',
        'Lorem ipsum dolor __sit amet__, consectetuer adipiscing elit.'
            =>'<p>Lorem ipsum dolor <u>sit amet</u>, consectetuer adipiscing elit.</p>',
        'Lorem ipsum dolor sit amet, {{{consectetuer}}} adipiscing `elit`.'
            =>'<p>Lorem ipsum dolor sit amet, <code>consectetuer</code> adipiscing <code>elit</code>.</p>',
        'Lorem ipsum dolor ~~sit amet~~, consectetuer adipiscing elit.'
            =>'<p>Lorem ipsum dolor <del>sit amet</del>, consectetuer adipiscing elit.</p>',
        'Lorem ipsum dolor ^sit amet^, consectetuer adipiscing elit.'
            =>'<p>Lorem ipsum dolor <sup>sit amet</sup>, consectetuer adipiscing elit.</p>',
        'Lorem ipsum dolor sit ,,amet, consectetuer,, adipiscing elit.'
            =>'<p>Lorem ipsum dolor sit <sub>amet, consectetuer</sub> adipiscing elit.</p>',

        'Lorem ipsum dolor [[sit amet]], consectetuer adipiscing elit.'
            =>'<p>Lorem ipsum dolor [[sit amet]], consectetuer adipiscing elit.</p>',
        'Lorem ipsum dolor sit[[br]] amet, consectetuer adipiscing elit.'
            =>'<p>Lorem ipsum dolor sit<br /> amet, consectetuer adipiscing elit.</p>',
        'Lorem ipsum dolor SitAmet, consectetuer adipiscing elit.'
            =>'<p>Lorem ipsum dolor <a href="/SitAmet">SitAmet</a>, consectetuer adipiscing elit.</p>',
        'Lorem ipsum dolor !SitAmet, consectetuer adipiscing elit.'
            =>'<p>Lorem ipsum dolor SitAmet, consectetuer adipiscing elit.</p>',

        'Lorem ipsum http://truc.com/bla/bla/bla?toto=po#pop dolor sit amet, consectetuer adipiscing elit.'
            =>'<p>Lorem ipsum <a href="http://truc.com/bla/bla/bla?toto=po#pop">http://truc.com/bla/bla/bla?toto=po#pop</a> dolor sit amet, consectetuer adipiscing elit.</p>',
        'Lorem ipsum #165 dolor sit amet, ticket:986 consectetuer adipiscing elit.'
            =>'<p>Lorem ipsum <a href="/ticket/165">#165</a> dolor sit amet, <a href="/ticket/986">ticket 986</a> consectetuer adipiscing elit.</p>',
        'Lorem ipsum dolor {68} sit amet, consectetuer report:15 adipiscing elit.'
            =>'<p>Lorem ipsum dolor <a href="/report/68">{68}</a> sit amet, consectetuer <a href="/report/15">report 15</a> adipiscing elit.</p>',
        'Lorem ipsum changeset:65 dolor sit amet, consectetuer adipiscing elit.'
            =>'<p>Lorem ipsum <a href="/changeset/65">changeset 65</a> dolor sit amet, consectetuer adipiscing elit.</p>',
        'Lorem ipsum wiki:dolor sit amet, consectetuer adipiscing elit.'
            =>'<p>Lorem ipsum <a href="/wiki/dolor">dolor</a> sit amet, consectetuer adipiscing elit.</p>',
       'Lorem ipsum dolor sit amet, milestone:658 consectetuer source:trunk/COPYING adipiscing attachment:my.patch elit.'
            =>'<p>Lorem ipsum dolor sit amet, <a href="/milestone/658">milestone 658</a> consectetuer <a href="/browser/trunk/COPYING">trunk/COPYING</a> adipiscing attachment:my.patch elit.</p>',

        'Lorem [ipsum dolor] sit amet, consectetuer adipiscing elit.'
            =>'<p>Lorem [ipsum dolor] sit amet, consectetuer adipiscing elit.</p>',
        'Lorem [http://foo.com ipsum dolor] sit amet, consectetuer adipiscing elit.'
            =>'<p>Lorem <a href="http://foo.com">ipsum dolor</a> sit amet, consectetuer adipiscing elit.</p>',
        'Lorem [javascript:alert(window.title) ipsum dolor] sit amet, consectetuer adipiscing elit.'
            =>'<p>Lorem [javascript:alert(window.title) ipsum dolor] sit amet, consectetuer adipiscing elit.</p>',


        'Lorem [wiki:ipsum dolor sit amet], consectetuer adipiscing elit.'
            =>'<p>Lorem <a href="/wiki/ipsum">dolor sit amet</a>, consectetuer adipiscing elit.</p>',
        'Lorem [wiki:IpsumDolor] sit amet, consectetuer adipiscing elit.'
            =>'<p>Lorem <a href="/wiki/IpsumDolor">IpsumDolor</a> sit amet, consectetuer adipiscing elit.</p>',
        'Lorem [source:ipsum dolor] sit amet, consectetuer adipiscing elit.'
            =>'<p>Lorem <a href="/browser/ipsum">dolor</a> sit amet, consectetuer adipiscing elit.</p>',
        'Lorem [source:Ipsum/Dolor] sit amet, consectetuer adipiscing elit.'
            =>'<p>Lorem <a href="/browser/Ipsum/Dolor">Ipsum/Dolor</a> sit amet, consectetuer adipiscing elit.</p>',
        'Lorem [ticket:1] sit amet, consectetuer adipiscing elit.'
            =>'<p>Lorem <a href="/ticket/1">ticket 1</a> sit amet, consectetuer adipiscing elit.</p>',
        'Lorem [report:1] sit amet, consectetuer adipiscing elit.'
            =>'<p>Lorem <a href="/report/1">report 1</a> sit amet, consectetuer adipiscing elit.</p>',
        'Lorem [changeset:1] sit amet, consectetuer adipiscing elit.'
            =>'<p>Lorem <a href="/changeset/1">changeset 1</a> sit amet, consectetuer adipiscing elit.</p>',
        'Lorem [milestone:1] sit amet, consectetuer adipiscing elit.'
            =>'<p>Lorem <a href="/milestone/1">milestone 1</a> sit amet, consectetuer adipiscing elit.</p>',


 /*        'Lorem ipsum dolor sit amet, consectetuer adipiscing elit.'
            =>'<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>',
       'Lorem ipsum ^^dolor sit amet^^, consectetuer adipiscing elit.'
            =>'<p>Lorem ipsum <q>dolor sit amet</q>, consectetuer adipiscing elit.</p>',
        'Lorem ipsum ^^dolor sit amet|fr^^, consectetuer adipiscing elit.'
            =>'<p>Lorem ipsum <q lang="fr">dolor sit amet</q>, consectetuer adipiscing elit.</p>',
        'Lorem ipsum ^^dolor sit amet|fr|foo bar^^, consectetuer adipiscing elit.'
            =>'<p>Lorem ipsum <q lang="fr" cite="foo bar">dolor sit amet</q>, consectetuer adipiscing elit.</p>',
        'Lorem ipsum dolor sit amet, {{consectetuer adipiscing}} elit.'
            =>'<p>Lorem ipsum dolor sit amet, <cite>consectetuer adipiscing</cite> elit.</p>',
        'Lorem ipsum dolor sit amet, {{consectetuer adipiscing|un titre}} elit.'
            =>'<p>Lorem ipsum dolor sit amet, <cite title="un titre">consectetuer adipiscing</cite> elit.</p>',
        'Lorem ipsum dolor sit amet, ??consectetuer adipiscing?? elit.'
            =>'<p>Lorem ipsum dolor sit amet, <acronym>consectetuer adipiscing</acronym> elit.</p>',
        'Lorem ipsum dolor sit amet, ??consectetuer adipiscing|un titre?? elit.'
            =>'<p>Lorem ipsum dolor sit amet, <acronym title="un titre">consectetuer adipiscing</acronym> elit.</p>',
        'Lorem ((ipsumdolorsit.png)) amet, consectetuer adipiscing elit.'
            =>'<p>Lorem <img src="ipsumdolorsit.png" alt=""/> amet, consectetuer adipiscing elit.</p>',
        'Lorem ((ipsumdolorsit.png|alternative text)) amet, consectetuer adipiscing elit.'
            =>'<p>Lorem <img alt="alternative text" src="ipsumdolorsit.png"/> amet, consectetuer adipiscing elit.</p>',
        'Lorem ((ipsumdolorsit.png|alternative text|L)) amet, consectetuer adipiscing elit.'
            =>'<p>Lorem <img style="float:left;" alt="alternative text" src="ipsumdolorsit.png"/> amet, consectetuer adipiscing elit.</p>',
        'Lorem ((ipsumdolorsit.png|alternative text|R|longue description)) amet, consectetuer adipiscing elit.'
            =>'<p>Lorem <img longdesc="longue description" style="float:right;" alt="alternative text" src="ipsumdolorsit.png"/> amet, consectetuer adipiscing elit.</p>',
        'Lorem ~~ipsumdolorsit~~ amet, consectetuer adipiscing elit.'
            =>'<p>Lorem <a name="ipsumdolorsit"></a> amet, consectetuer adipiscing elit.</p>',
*/
    );


    var $listinline2 = array(
        // 'source' => array( nb_error, 'resultat')
/*
        'Lorem __ipsum \'\'dolor sit\'\' amet__, consectetuer adipiscing elit.'
            =>array(0,'<p>Lorem <strong>ipsum <em>dolor sit</em> amet</strong>, consectetuer adipiscing elit.</p>'),
        'Lorem __ipsum \'\'dolor sit__ amet\'\', consectetuer adipiscing elit.'
            =>array(1,'<p>Lorem __ipsum \'\'dolor sit__ amet\'\', consectetuer adipiscing elit.</p>'),
        'Lorem __ipsum \'\'dolor sit__ amet__, consectetuer adipiscing elit.'
            =>array(1,'<p>Lorem __ipsum \'\'dolor sit<strong> amet</strong>, consectetuer adipiscing elit.</p>'),
        'Lorem [[ips__um dol__or|bar|fr]] sit amet, consectetuer adipiscing elit.'
            =>array(0,'<p>Lorem <a href="bar" hreflang="fr">ips<strong>um dol</strong>or</a> sit amet, consectetuer adipiscing elit.</p>'),

        'Lorem [[ips[[um dol]]or|bar|fr]] sit amet, consectetuer adipiscing elit.'
            =>array(0,'<p>Lorem <a href="bar" hreflang="fr">ips<a href="um dol">um dol</a>or</a> sit amet, consectetuer adipiscing elit.</p>'),

        'Lorem [[ips[[um dolor|bar|fr]] sit]] amet, consectetuer adipiscing elit.'
            =>array(0,'<p>Lorem <a href="ips[[um dolor|bar|fr]] sit">ips[[um dolor|bar|fr]] sit</a> amet, consectetuer adipiscing elit.</p>'),
        'Lorem [[ips__um dolor|bar|fr]] sit__ amet, consectetuer adipiscing elit.'
            =>array(1,'<p>Lorem [[ips<strong>um dolor|bar|fr]] sit</strong> amet, consectetuer adipiscing elit.</p>'),
*/

    );
    function testBalisesInlineSimples() {
        $wr = new WikiRenderer(new trac_to_xhtml());
        foreach($this->listinline as $source=>$result){
            $res = $wr->render($source);
            $this->assertEquals($result, $res);
            $this->assertEquals(0, count($wr->errors), "Errors detected by wr in \"$source\"");
        }
    }

    function testBalisesInlineComplexes() {
        $wr = new WikiRenderer(new trac_to_xhtml());
        foreach($this->listinline2 as $source=>$result){
            $res = $wr->render($source);
            $this->assertEquals($result[1], $res);
            $this->assertEquals($result[0], count($wr->errors), "Different errors number");
        }
    }
}
