<?php
/**
 * Tests unitaires
 *
 * @package wikirenderer
 * @subpackage tests
 * @author Laurent Jouanneau
 * @copyright 2008-2016 Laurent Jouanneau
 */
 
class TracMacroExample {

    function match($wiki) {
        return $wiki == 'TitleIndex';
    }

    function getContent($documentGenerator, $wiki) {
        $words = $documentGenerator->getInlineGenerator('em');
        $words->addRawContent('my macro title index');
        return $words;
    }
}

class TracTestsInlines extends PHPUnit_Framework_TestCase {


    public function listUrlProvider() {
        return array(
            array('link', 'foo',
                          '',
                          ''),
            array('link', 'http://jelix.org',
                          'http://jelix.org',
                          'http://jelix.org'),
            array('link', 'http://jelix.org/reference/trunk/jelix/controllers/jControllerCmdLine.html',
                          'http://jelix.org/reference/trunk/jelix/controllers/jControllerCmdLine.html',
                          'http://jelix.org/reference/trunk/jelix/c(..)'),
            array('link', 'wiki:TitleIndex',
                          '/wiki/TitleIndex',
                          'TitleIndex'),
            array('link', 'TitleIndex',
                          '/wiki/TitleIndex',
                          'TitleIndex'),
            array('link', '#123',
                          '/ticket/123',
                          '#123'),
            array('link', 'ticket:123',
                          '/ticket/123',
                          'ticket 123'),
            array('link', 'report:123',
                          '/report/123',
                          'report 123'),
            array('link', '{123}',
                          '/report/123',
                          '{123}'),
            /*array('link', 'ISO9000',
                          '/wiki/ISO9000',
                          'ISO9000'),*/
            array('link', 'changeset:123',
                          '/changeset/123',
                          'changeset 123'),
            array('link', '[123]',
                          '/changeset/123',
                          '[123]'),
        );
    }

    /**
     * @dataProvider listUrlProvider
     */
    public function testUrlProcessing($tagName, $url, $expectedHref, $expectedLabel) {
        $markupConfig = new \WikiRenderer\Markup\Trac\Config();
        list($href, $label) = $markupConfig->processLink($url, $tagName = '');
        $this->assertEquals($expectedHref, $href);
        $this->assertEquals($expectedLabel, $label);
    }


    public function listInlineProvider() {
        return array(
        array('Lorem ipsum dolor sit amet, consectetuer adipiscing elit.'
            ,'<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>'),
        array("Lorem '''''ipsum dolor''''' sit amet, consectetuer adipiscing elit."
            ,'<p>Lorem <strong><em>ipsum dolor</em></strong> sit amet, consectetuer adipiscing elit.</p>'),
        array("Lorem '''ipsum dolor''' sit amet, consectetuer adipiscing elit."
            ,'<p>Lorem <strong>ipsum dolor</strong> sit amet, consectetuer adipiscing elit.</p>'),
        array("Lorem ''ipsum dolor'' sit amet, consectetuer adipiscing elit."
            ,'<p>Lorem <em>ipsum dolor</em> sit amet, consectetuer adipiscing elit.</p>'),
        array("Lorem '''''ipsum dolor''''' sit ''amet'', '''consectetuer''' adipiscing elit."
            ,'<p>Lorem <strong><em>ipsum dolor</em></strong> sit <em>amet</em>, <strong>consectetuer</strong> adipiscing elit.</p>'),
        array('Lorem ipsum dolor __sit amet__, consectetuer adipiscing elit.'
            ,'<p>Lorem ipsum dolor <u>sit amet</u>, consectetuer adipiscing elit.</p>'),
        array('Lorem ipsum dolor sit amet, {{{consectetuer}}} adipiscing `elit`.'
            ,'<p>Lorem ipsum dolor sit amet, <code>consectetuer</code> adipiscing <code>elit</code>.</p>'),
        array('Lorem ipsum dolor ~~sit amet~~, consectetuer adipiscing elit.'
            ,'<p>Lorem ipsum dolor <del>sit amet</del>, consectetuer adipiscing elit.</p>'),
        array('Lorem ipsum dolor ^sit amet^, consectetuer adipiscing elit.'
            ,'<p>Lorem ipsum dolor <sup>sit amet</sup>, consectetuer adipiscing elit.</p>'),
        array('Lorem ipsum dolor sit ,,amet, consectetuer,, adipiscing elit.'
            ,'<p>Lorem ipsum dolor sit <sub>amet, consectetuer</sub> adipiscing elit.</p>'),

        array('Lorem ipsum dolor sit[=#point1] amet, consectetuer adipiscing elit.'
            ,'<p>Lorem ipsum dolor sit<span id="point1" class="wikianchor"><a href="#point1" class="anchor">¶</a></span> amet, consectetuer adipiscing elit.</p>'),
        array('Lorem ipsum dolor sit[=#point1 label] amet, consectetuer adipiscing elit.'
            ,'<p>Lorem ipsum dolor sit<span id="point1" class="wikianchor">label<a href="#point1" class="anchor">¶</a></span> amet, consectetuer adipiscing elit.</p>'),
        array('Lorem ipsum dolor sit[[=#point1|label]] amet, consectetuer adipiscing elit.'
            ,'<p>Lorem ipsum dolor sit<span id="point1" class="wikianchor">label<a href="#point1" class="anchor">¶</a></span> amet, consectetuer adipiscing elit.</p>'),
        array('Lorem ipsum dolor sit [#point2 join to the second point] amet, consectetuer adipiscing elit.'
            ,'<p>Lorem ipsum dolor sit <a href="#point2">join to the second point</a> amet, consectetuer adipiscing elit.</p>'),
        array('Lorem ipsum dolor sit [[#point2|join to the second point]] amet, consectetuer adipiscing elit.'
            ,'<p>Lorem ipsum dolor sit <a href="#point2">join to the second point</a> amet, consectetuer adipiscing elit.</p>'),

        array('Lorem ipsum dolor macro [[TitleIndex]], consectetuer adipiscing elit.'
            ,'<p>Lorem ipsum dolor macro <em>my macro title index</em>, consectetuer adipiscing elit.</p>'),

        array('Lorem ipsum dolor [[sit amet]], consectetuer adipiscing elit.'
            ,'<p>Lorem ipsum dolor [[sit amet]], consectetuer adipiscing elit.</p>'),
        array('Lorem ipsum dolor sit[[br]] amet, consectetuer adipiscing elit.'
            ,'<p>Lorem ipsum dolor sit<br /> amet, consectetuer adipiscing elit.</p>'),
        array('Lorem ipsum dolor SitAmet, consectetuer adipiscing elit.'
            ,'<p>Lorem ipsum dolor <a href="/wiki/SitAmet">SitAmet,</a> consectetuer adipiscing elit.</p>'),
        array('Lorem ipsum dolor !SitAmet, consectetuer adipiscing elit.'
            ,'<p>Lorem ipsum dolor SitAmet, consectetuer adipiscing elit.</p>'),

        array('Lorem ipsum http://truc.com/bla/bla/bla?toto=po#pop dolor sit amet, consectetuer adipiscing elit.'
            ,'<p>Lorem ipsum <a href="http://truc.com/bla/bla/bla?toto=po#pop">http://truc.com/bla/bla/bla?toto=po#pop</a> dolor sit amet, consectetuer adipiscing elit.</p>'),
        array('Lorem ipsum #165 dolor sit amet, ticket:986 consectetuer adipiscing elit.'
            ,'<p>Lorem ipsum <a href="/ticket/165">#165</a> dolor sit amet, <a href="/ticket/986">ticket 986</a> consectetuer adipiscing elit.</p>'),
        array('Lorem ipsum dolor {68} sit amet, consectetuer report:15 adipiscing elit.'
            ,'<p>Lorem ipsum dolor <a href="/report/68">{68}</a> sit amet, consectetuer <a href="/report/15">report 15</a> adipiscing elit.</p>'),
        array('Lorem ipsum changeset:65 dolor sit amet, consectetuer adipiscing elit.'
            ,'<p>Lorem ipsum <a href="/changeset/65">changeset 65</a> dolor sit amet, consectetuer adipiscing elit.</p>'),
        array('Lorem ipsum wiki:dolor sit amet, consectetuer adipiscing elit.'
            ,'<p>Lorem ipsum <a href="/wiki/dolor">dolor</a> sit amet, consectetuer adipiscing elit.</p>'),
       array('Lorem ipsum dolor sit amet, milestone:658 consectetuer source:trunk/COPYING adipiscing attachment:my.patch elit.'
            ,'<p>Lorem ipsum dolor sit amet, <a href="/milestone/658">milestone 658</a> consectetuer <a href="/browser/trunk/COPYING">trunk/COPYING</a> adipiscing attachment:my.patch elit.</p>'),

        array('Lorem [ipsum dolor] sit amet, consectetuer adipiscing elit.'
            ,'<p>Lorem [ipsum dolor] sit amet, consectetuer adipiscing elit.</p>'),
        array('Lorem [http://foo.com ipsum dolor] sit amet, consectetuer adipiscing elit.'
            ,'<p>Lorem <a href="http://foo.com">ipsum dolor</a> sit amet, consectetuer adipiscing elit.</p>'),
        array('Lorem [javascript:alert(window.title) ipsum dolor] sit amet, consectetuer adipiscing elit.'
            ,'<p>Lorem <a href="#">ipsum dolor</a> sit amet, consectetuer adipiscing elit.</p>'),
        array('Lorem [wiki:ipsum dolor sit amet], consectetuer adipiscing elit.'
            ,'<p>Lorem <a href="/wiki/ipsum">dolor sit amet</a>, consectetuer adipiscing elit.</p>'),
        array('Lorem [wiki:IpsumDolor] sit amet, consectetuer adipiscing elit.'
            ,'<p>Lorem <a href="/wiki/IpsumDolor">IpsumDolor</a> sit amet, consectetuer adipiscing elit.</p>'),
        array('Lorem [source:ipsum dolor] sit amet, consectetuer adipiscing elit.'
            ,'<p>Lorem <a href="/browser/ipsum">dolor</a> sit amet, consectetuer adipiscing elit.</p>'),
        array('Lorem [source:Ipsum/Dolor] sit amet, consectetuer adipiscing elit.'
            ,'<p>Lorem <a href="/browser/Ipsum/Dolor">Ipsum/Dolor</a> sit amet, consectetuer adipiscing elit.</p>'),
        array('Lorem [ticket:1] sit amet, consectetuer adipiscing elit.'
            ,'<p>Lorem <a href="/ticket/1">ticket 1</a> sit amet, consectetuer adipiscing elit.</p>'),
        array('Lorem [report:1] sit amet, consectetuer adipiscing elit.'
            ,'<p>Lorem <a href="/report/1">report 1</a> sit amet, consectetuer adipiscing elit.</p>'),
        array('Lorem [changeset:1] sit amet, consectetuer adipiscing elit.'
            ,'<p>Lorem <a href="/changeset/1">changeset 1</a> sit amet, consectetuer adipiscing elit.</p>'),
        array('Lorem [milestone:1] sit amet, consectetuer adipiscing elit.'
            ,'<p>Lorem <a href="/milestone/1">milestone 1</a> sit amet, consectetuer adipiscing elit.</p>'),

        array('Lorem [[ipsum dolor]] sit amet, consectetuer adipiscing elit.'
            ,'<p>Lorem [[ipsum dolor]] sit amet, consectetuer adipiscing elit.</p>'),
        array('Lorem [[http://foo.com|ipsum dolor]] sit amet, consectetuer adipiscing elit.'
            ,'<p>Lorem <a href="http://foo.com">ipsum dolor</a> sit amet, consectetuer adipiscing elit.</p>'),
        array('Lorem [[javascript:alert(window.title)|ipsum dolor]] sit amet, consectetuer adipiscing elit.'
            ,'<p>Lorem <a href="#">ipsum dolor</a> sit amet, consectetuer adipiscing elit.</p>'),
        array('Lorem [[wiki:ipsum|dolor sit amet]], consectetuer adipiscing elit.'
            ,'<p>Lorem <a href="/wiki/ipsum">dolor sit amet</a>, consectetuer adipiscing elit.</p>'),
        array('Lorem [[wiki:IpsumDolor]] sit amet, consectetuer adipiscing elit.'
            ,'<p>Lorem <a href="/wiki/IpsumDolor">IpsumDolor</a> sit amet, consectetuer adipiscing elit.</p>'),
        array('Lorem [[source:ipsum|dolor]] sit amet, consectetuer adipiscing elit.'
            ,'<p>Lorem <a href="/browser/ipsum">dolor</a> sit amet, consectetuer adipiscing elit.</p>'),
        array('Lorem [[source:Ipsum/Dolor]] sit amet, consectetuer adipiscing elit.'
            ,'<p>Lorem <a href="/browser/Ipsum/Dolor">Ipsum/Dolor</a> sit amet, consectetuer adipiscing elit.</p>'),
        array('Lorem [[ticket:1]] sit amet, consectetuer adipiscing elit.'
            ,'<p>Lorem <a href="/ticket/1">ticket 1</a> sit amet, consectetuer adipiscing elit.</p>'),
        array('Lorem [[report:1]] sit amet, consectetuer adipiscing elit.'
            ,'<p>Lorem <a href="/report/1">report 1</a> sit amet, consectetuer adipiscing elit.</p>'),
        array('Lorem [[changeset:1]] sit amet, consectetuer adipiscing elit.'
            ,'<p>Lorem <a href="/changeset/1">changeset 1</a> sit amet, consectetuer adipiscing elit.</p>'),
        array('Lorem [[milestone:1]] sit amet, consectetuer adipiscing elit.'
            ,'<p>Lorem <a href="/milestone/1">milestone 1</a> sit amet, consectetuer adipiscing elit.</p>'),


 /*        array('Lorem ipsum dolor sit amet, consectetuer adipiscing elit.'
            ,'<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>'),
       array('Lorem ipsum ^^dolor sit amet^^, consectetuer adipiscing elit.'
            ,'<p>Lorem ipsum <q>dolor sit amet</q>, consectetuer adipiscing elit.</p>'),
        array('Lorem ipsum ^^dolor sit amet|fr^^, consectetuer adipiscing elit.'
            ,'<p>Lorem ipsum <q lang="fr">dolor sit amet</q>, consectetuer adipiscing elit.</p>'),
        array('Lorem ipsum ^^dolor sit amet|fr|foo bar^^, consectetuer adipiscing elit.'
            ,'<p>Lorem ipsum <q lang="fr" cite="foo bar">dolor sit amet</q>, consectetuer adipiscing elit.</p>'),
        array('Lorem ipsum dolor sit amet, {{consectetuer adipiscing}} elit.'
            ,'<p>Lorem ipsum dolor sit amet, <cite>consectetuer adipiscing</cite> elit.</p>'),
        array('Lorem ipsum dolor sit amet, {{consectetuer adipiscing|un titre}} elit.'
            ,'<p>Lorem ipsum dolor sit amet, <cite title="un titre">consectetuer adipiscing</cite> elit.</p>'),
        array('Lorem ipsum dolor sit amet, ??consectetuer adipiscing?? elit.'
            ,'<p>Lorem ipsum dolor sit amet, <acronym>consectetuer adipiscing</acronym> elit.</p>'),
        array('Lorem ipsum dolor sit amet, ??consectetuer adipiscing|un titre?? elit.'
            ,'<p>Lorem ipsum dolor sit amet, <acronym title="un titre">consectetuer adipiscing</acronym> elit.</p>'),
        array('Lorem ((ipsumdolorsit.png)) amet, consectetuer adipiscing elit.'
            ,'<p>Lorem <img src="ipsumdolorsit.png" alt=""/> amet, consectetuer adipiscing elit.</p>'),
        array('Lorem ((ipsumdolorsit.png|alternative text)) amet, consectetuer adipiscing elit.'
            ,'<p>Lorem <img alt="alternative text" src="ipsumdolorsit.png"/> amet, consectetuer adipiscing elit.</p>'),
        array('Lorem ((ipsumdolorsit.png|alternative text|L)) amet, consectetuer adipiscing elit.'
            ,'<p>Lorem <img style="float:left;" alt="alternative text" src="ipsumdolorsit.png"/> amet, consectetuer adipiscing elit.</p>'),
        array('Lorem ((ipsumdolorsit.png|alternative text|R|longue description)) amet, consectetuer adipiscing elit.'
            ,'<p>Lorem <img longdesc="longue description" style="float:right;" alt="alternative text" src="ipsumdolorsit.png"/> amet, consectetuer adipiscing elit.</p>'),
        array('Lorem ~~ipsumdolorsit~~ amet, consectetuer adipiscing elit.'
            ,'<p>Lorem <a name="ipsumdolorsit"></a> amet, consectetuer adipiscing elit.</p>'),
*/
        );
    }


    public function listInlineComplexesProvider() {
        return array(

/*
        array('Lorem __ipsum \'\'dolor sit\'\' amet__, consectetuer adipiscing elit.'
            ,0,'<p>Lorem <strong>ipsum <em>dolor sit</em> amet</strong>, consectetuer adipiscing elit.</p>'),
        array('Lorem __ipsum \'\'dolor sit__ amet\'\', consectetuer adipiscing elit.'
            ,1,'<p>Lorem __ipsum \'\'dolor sit__ amet\'\', consectetuer adipiscing elit.</p>'),
        array('Lorem __ipsum \'\'dolor sit__ amet__, consectetuer adipiscing elit.'
            ,1,'<p>Lorem __ipsum \'\'dolor sit<strong> amet</strong>, consectetuer adipiscing elit.</p>'),
        array('Lorem [[ips__um dol__or|bar|fr]] sit amet, consectetuer adipiscing elit.'
            ,0,'<p>Lorem <a href="bar" hreflang="fr">ips<strong>um dol</strong>or</a> sit amet, consectetuer adipiscing elit.</p>'),

        array('Lorem [[ips[[um dol]]or|bar|fr]] sit amet, consectetuer adipiscing elit.'
            ,0,'<p>Lorem <a href="bar" hreflang="fr">ips<a href="um dol">um dol</a>or</a> sit amet, consectetuer adipiscing elit.</p>'),

        array('Lorem [[ips[[um dolor|bar|fr]] sit]] amet, consectetuer adipiscing elit.'
            ,0,'<p>Lorem <a href="ips[[um dolor|bar|fr]] sit">ips[[um dolor|bar|fr]] sit</a> amet, consectetuer adipiscing elit.</p>'),
        array('Lorem [[ips__um dolor|bar|fr]] sit__ amet, consectetuer adipiscing elit.'
            ,1,'<p>Lorem [[ips<strong>um dolor|bar|fr]] sit</strong> amet, consectetuer adipiscing elit.</p>'),
*/
        );
    }

    /**
     * @dataProvider listInlineProvider
     */
    function testBalisesInlineSimples($source, $expected) {
        $genConfig = new \WikiRenderer\Generator\Html\Config();
        $generator = new \WikiRenderer\Generator\Html\Document($genConfig);
        $markupConfig = new \WikiRenderer\Markup\Trac\Config();
        $markupConfig->macros[] = new TracMacroExample();
        $wr = new \WikiRenderer\RendererNG($generator, $markupConfig);
        $res = $wr->render($source);
        $this->assertEquals($expected, $res);
        $this->assertEquals(0, count($wr->errors));
    }

    /**
     * @dataProvider listInlineComplexesProvider
     */
/*    function testBalisesInlineComplexes($source, $errors, $expected) {
        $genConfig = new \WikiRenderer\Generator\Html\Config();
        $generator = new \WikiRenderer\Generator\Html\Document($genConfig);
        $markupConfig = new \WikiRenderer\Markup\Trac\Config();
        $wr = new \WikiRenderer\RendererNG($generator, $markupConfig);
        $res = $wr->render($source);
        $this->assertEquals($expected, $res);
        $this->assertEquals($errors, count($wr->errors));
    }*/
}
