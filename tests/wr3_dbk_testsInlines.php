<?php
/**
 * Tests unitaires
 *
 * @package wikirenderer
 * @subpackage tests
 * @author Laurent Jouanneau
 * @copyright 2006 Laurent Jouanneau
 */

require_once('common.php');
require_once(WR_DIR.'rules/wr3_to_docbook.php');

class WR3DBKTestsInlines extends WikiRendererUnitTestCase {
    var $listinline = array(

        'Lorem ipsum dolor sit amet, consectetuer adipiscing elit.'
            =>'<para>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</para>',
        'Lorem __ipsum dolor__ sit amet, consectetuer adipiscing elit.'
            =>'<para>Lorem <emphasis role="strong">ipsum dolor</emphasis> sit amet, consectetuer adipiscing elit.</para>',
        'Lorem ipsum dolor \'\'sit amet\'\', consectetuer adipiscing elit.'
            =>'<para>Lorem ipsum dolor <emphasis>sit amet</emphasis>, consectetuer adipiscing elit.</para>',
        'Lorem ipsum dolor sit amet, @@consectetuer@@ adipiscing elit.'
            =>'<para>Lorem ipsum dolor sit amet, <code>consectetuer</code> adipiscing elit.</para>',
        'Lorem ipsum dolor sit amet, consectetuer adipiscing elit.'
            =>'<para>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</para>',
        'Lorem ipsum ^^dolor sit amet^^, consectetuer adipiscing elit.'
            =>'<para>Lorem ipsum <quote>dolor sit amet</quote>, consectetuer adipiscing elit.</para>',
        'Lorem ipsum ^^dolor sit amet|fr^^, consectetuer adipiscing elit.'
            =>'<para>Lorem ipsum <quote lang="fr">dolor sit amet</quote>, consectetuer adipiscing elit.</para>',
        'Lorem ipsum ^^dolor sit amet|fr|foo bar^^, consectetuer adipiscing elit.'
            =>'<para>Lorem ipsum <quote lang="fr">dolor sit amet</quote>, consectetuer adipiscing elit.</para>',
        'Lorem ipsum dolor sit amet, {{consectetuer adipiscing}} elit.'
            =>'<para>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</para>',
        'Lorem ipsum dolor sit amet, {{consectetuer adipiscing|un titre}} elit.'
            =>'<para>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</para>',
        'Lorem ipsum dolor sit amet, ??consectetuer adipiscing?? elit.'
            =>'<para>Lorem ipsum dolor sit amet, <acronym>consectetuer adipiscing</acronym> elit.</para>',
        'Lorem ipsum dolor sit amet, ??consectetuer adipiscing|un titre?? elit.'
            =>'<para>Lorem ipsum dolor sit amet, <acronym>consectetuer adipiscing</acronym> elit.</para>',
        'Lorem [[ipsum dolor]] sit amet, consectetuer adipiscing elit.'
            =>'<para>Lorem <ulink url="ipsum dolor">ipsum dolor</ulink> sit amet, consectetuer adipiscing elit.</para>',
        'Lorem [[#ipsum.dolor]] sit amet, consectetuer adipiscing elit.'
            =>'<para>Lorem <link linkterm="ipsum.dolor">#ipsum.dolor</link> sit amet, consectetuer adipiscing elit.</para>',
        'Lorem [[ipsum dolor|http://foo.com]] sit amet, consectetuer adipiscing elit.'
            =>'<para>Lorem <ulink url="http://foo.com">ipsum dolor</ulink> sit amet, consectetuer adipiscing elit.</para>',
        'Lorem [[ipsum dolor|javascript:alert(window.title)]] sit amet, consectetuer adipiscing elit.'
            =>'<para>Lorem <ulink url="javascript:alert(window.title)">ipsum dolor</ulink> sit amet, consectetuer adipiscing elit.</para>',
        'Lorem [[ipsum dolor|bar|fr]] sit amet, consectetuer adipiscing elit.'
            =>'<para>Lorem <ulink url="bar">ipsum dolor</ulink> sit amet, consectetuer adipiscing elit.</para>',
        'Lorem [[ipsum dolor|bar|fr|ceci est un titre]] sit amet, consectetuer adipiscing elit.'
            =>'<para>Lorem <ulink url="bar">ipsum dolor</ulink> sit amet, consectetuer adipiscing elit.</para>',
        'Lorem ((ipsumdolorsit.png)) amet, consectetuer adipiscing elit.'
            =>'<para>Lorem <inlinemediaobject><imageobject><imagedata fileref="ipsumdolorsit.png"/></imageobject></inlinemediaobject> amet, consectetuer adipiscing elit.</para>',
        'Lorem ((ipsumdolorsit.png|alternative text)) amet, consectetuer adipiscing elit.'
            =>'<para>Lorem <inlinemediaobject><imageobject><imagedata fileref="ipsumdolorsit.png"/></imageobject><textobject><phrase>alternative text</phrase></textobject></inlinemediaobject> amet, consectetuer adipiscing elit.</para>',
        'Lorem ((ipsumdolorsit.png|alternative text|L)) amet, consectetuer adipiscing elit.'
            =>'<para>Lorem <inlinemediaobject><imageobject><imagedata align="left" fileref="ipsumdolorsit.png"/></imageobject><textobject><phrase>alternative text</phrase></textobject></inlinemediaobject> amet, consectetuer adipiscing elit.</para>',
        'Lorem ((ipsumdolorsit.png|alternative text|R|longue description)) amet, consectetuer adipiscing elit.'
            =>'<para>Lorem <inlinemediaobject><imageobject><imagedata align="right" fileref="ipsumdolorsit.png"/></imageobject><textobject><phrase>alternative text</phrase></textobject></inlinemediaobject> amet, consectetuer adipiscing elit.</para>',
        'Lorem ~~ipsumdolorsit~~ amet, consectetuer adipiscing elit.'
            =>'<para>Lorem <anchor id="ipsumdolorsit"/> amet, consectetuer adipiscing elit.</para>',
        'Lorem $$ipsumdolorsit amet$$, consectetuer adipiscing elit.'
            =>'<para>Lorem <footnote><para>ipsumdolorsit amet</para></footnote>, consectetuer adipiscing elit.</para>',

    );



    function testBalisesInlineSimples() {
        $wr = new WikiRenderer(new wr3_to_docbook());
        foreach($this->listinline as $source=>$result){
            $res = $wr->render($source);
            $this->assertEqualOrDiff($res,$result, "erreur");
            $this->assertEqual(count($wr->errors),0, "WR returns errors ! (%s)");
        }
    }

    var $listinline2 = array(
        // 'source' => array( nb_error, 'resultat')
        'Lorem __ipsum \'\'dolor sit\'\' amet__, consectetuer adipiscing elit.'
            =>array(0,'<para>Lorem <emphasis role="strong">ipsum <emphasis>dolor sit</emphasis> amet</emphasis>, consectetuer adipiscing elit.</para>'),
        'Lorem __ipsum \'\'dolor sit__ amet\'\', consectetuer adipiscing elit.'
            =>array(1,'<para>Lorem __ipsum \'\'dolor sit__ amet\'\', consectetuer adipiscing elit.</para>'),
        'Lorem __ipsum \'\'dolor sit__ amet__, consectetuer adipiscing elit.'
            =>array(1,'<para>Lorem __ipsum \'\'dolor sit<emphasis role="strong"> amet</emphasis>, consectetuer adipiscing elit.</para>'),
        'Lorem [[ips__um dol__or|bar|fr]] sit amet, consectetuer adipiscing elit.'
            =>array(0,'<para>Lorem <ulink url="bar">ips<emphasis role="strong">um dol</emphasis>or</ulink> sit amet, consectetuer adipiscing elit.</para>'),

        'Lorem [[ips[[um dol]]or|bar|fr]] sit amet, consectetuer adipiscing elit.'
            =>array(0,'<para>Lorem <ulink url="bar">ips<ulink url="um dol">um dol</ulink>or</ulink> sit amet, consectetuer adipiscing elit.</para>'),

        'Lorem [[ips[[um dolor|bar|fr]] sit]] amet, consectetuer adipiscing elit.'
            =>array(0,'<para>Lorem <ulink url="ips[[um dolor|bar|fr]] sit">ips[[um dolor|bar|fr]] sit</ulink> amet, consectetuer adipiscing elit.</para>'),
        'Lorem [[ips__um dolor|bar|fr]] sit__ amet, consectetuer adipiscing elit.'
            =>array(1,'<para>Lorem [[ips<emphasis role="strong">um dolor|bar|fr]] sit</emphasis> amet, consectetuer adipiscing elit.</para>'),

    );

    function testBalisesInlineComplexes() {
        $wr = new WikiRenderer(new wr3_to_docbook());
        foreach($this->listinline2 as $source=>$result){
            $res = $wr->render($source);
            if(!$this->assertEqual($res,$result[1], "erreur")){
                $this->sendMessage('test : '.$source);
                $this->_showDiff($result[1],$res);
            }
            if(!$this->assertEqual(count($wr->errors),$result[0], "Bad number of errors (%s)")){
                $this->dump($wr->errors);
            }
        }
    }

}

if(!defined('ALL_TESTS')) {
    $test = new WR3DBKTestsInlines();
    $test->run(new HtmlReporter2());
}
