<?php
/**
 * Tests unitaires
 *
 * @package wikirenderer
 * @subpackage tests
 * @author Laurent Jouanneau
 * @copyright 2006-2011 Laurent Jouanneau
 */

class DokuWikiDocbookTestsInlines extends PHPUnit_Framework_TestCase {
      var $listinline = array(

        'Lorem ipsum dolor sit amet, consectetuer adipiscing elit.'
            =>'<para>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</para>',
        'Lorem **ipsum dolor** sit amet, consectetuer adipiscing elit.'
            =>'<para>Lorem <emphasis role="strong">ipsum dolor</emphasis> sit amet, consectetuer adipiscing elit.</para>',
        'Lorem **0** sit amet, consectetuer adipiscing elit.'
            =>'<para>Lorem <emphasis role="strong">0</emphasis> sit amet, consectetuer adipiscing elit.</para>',
        'Lorem ipsum dolor //sit amet//, consectetuer adipiscing elit.'
            =>'<para>Lorem ipsum dolor <emphasis>sit amet</emphasis>, consectetuer adipiscing elit.</para>',
        'Lorem ipsum dolor sit amet, \'\'consectetuer\'\' adipiscing elit.'
            =>'<para>Lorem ipsum dolor sit amet, <code>consectetuer</code> adipiscing elit.</para>',
        'Lorem ipsum dolor sit amet, __consectetuer__ adipiscing elit.'
            =>'<para>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</para>',
        'Lorem ipsum dolor sit amet, <sub>consectetuer</sub> adipiscing elit.'
            =>'<para>Lorem ipsum dolor sit amet, <subscript>consectetuer</subscript> adipiscing elit.</para>',
        'Lorem ipsum dolor sit amet, <sup>consectetuer</sup> adipiscing elit.'
            =>'<para>Lorem ipsum dolor sit amet, <superscript>consectetuer</superscript> adipiscing elit.</para>',
        'Lorem ipsum dolor sit amet, <del>consectetuer</del> adipiscing elit.'
            =>'<para>Lorem ipsum dolor sit amet,  adipiscing elit.</para>',
        'Lorem ipsum dolor sit amet, \\\\consectetuer adipiscing elit.'
            =>'<para>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</para>',
        'Lorem ipsum dolor sit amet, \\\\
consectetuer adipiscing elit.'
            =>'<para>Lorem ipsum dolor sit amet, 
consectetuer adipiscing elit.</para>',
        'Lorem [[ipsum dolor]] sit amet, consectetuer adipiscing elit.'
            =>'<para>Lorem <link xlink:href="ipsum dolor">ipsum dolor</link> sit amet, consectetuer adipiscing elit.</para>',
        'Lorem [[#ipsum.dolor]] sit amet, consectetuer adipiscing elit.'
            =>'<para>Lorem <link linkend="ipsum.dolor">#ipsum.dolor</link> sit amet, consectetuer adipiscing elit.</para>',
        'Lorem [[http://foo.com|ipsum dolor]] sit amet, consectetuer adipiscing elit.'
            =>'<para>Lorem <link xlink:href="http://foo.com">ipsum dolor</link> sit amet, consectetuer adipiscing elit.</para>',
        'Lorem [[ javascript:alert(window.title) | ipsum dolor]] sit amet, consectetuer adipiscing elit.'
            =>'<para>Lorem  ipsum dolor sit amet, consectetuer adipiscing elit.</para>',
        'Lorem ((ipsumdolorsit amet)), consectetuer adipiscing elit.'
            =>'<para>Lorem <footnote><para>ipsumdolorsit amet</para></footnote>, consectetuer adipiscing elit.</para>',
        'Lorem {{ipsumdolorsit.png}} amet, consectetuer adipiscing elit.'
            =>'<para>Lorem <inlinemediaobject><imageobject><imagedata fileref="ipsumdolorsit.png"/></imageobject></inlinemediaobject> amet, consectetuer adipiscing elit.</para>',
        'Lorem {{ipsumdolorsit.png|alternative text}} amet, consectetuer adipiscing elit.'
            =>'<para>Lorem <inlinemediaobject><imageobject><imagedata fileref="ipsumdolorsit.png"/></imageobject><textobject><phrase>alternative text</phrase></textobject></inlinemediaobject> amet, consectetuer adipiscing elit.</para>',
        'Lorem {{ ipsumdolorsit.png}} amet, consectetuer adipiscing elit.'
            =>'<para>Lorem <inlinemediaobject><imageobject><imagedata fileref="ipsumdolorsit.png" align="right"/></imageobject></inlinemediaobject> amet, consectetuer adipiscing elit.</para>',
        'Lorem {{ ipsumdolorsit.png }} amet, consectetuer adipiscing elit.'
            =>'<para>Lorem <inlinemediaobject><imageobject><imagedata fileref="ipsumdolorsit.png" align="center"/></imageobject></inlinemediaobject> amet, consectetuer adipiscing elit.</para>',
        'Lorem {{ipsumdolorsit.png }} amet, consectetuer adipiscing elit.'
            =>'<para>Lorem <inlinemediaobject><imageobject><imagedata fileref="ipsumdolorsit.png" align="left"/></imageobject></inlinemediaobject> amet, consectetuer adipiscing elit.</para>',
        'Lorem {{ ipsumdolorsit.png?50}} amet, consectetuer adipiscing elit.'
            =>'<para>Lorem <inlinemediaobject><imageobject><imagedata fileref="ipsumdolorsit.png" contentwidth="50px" contentdepth="50px" align="right"/></imageobject></inlinemediaobject> amet, consectetuer adipiscing elit.</para>',
        'Lorem {{ipsumdolorsit.png?200x50 }} amet, consectetuer adipiscing elit.'
            =>'<para>Lorem <inlinemediaobject><imageobject><imagedata fileref="ipsumdolorsit.png" contentwidth="200px" contentdepth="50px" align="left"/></imageobject></inlinemediaobject> amet, consectetuer adipiscing elit.</para>',
        'Lorem {{ ipsumdolorsit.png?200x50 |alternative text}} amet, consectetuer adipiscing elit.'
            =>'<para>Lorem <inlinemediaobject><imageobject><imagedata fileref="ipsumdolorsit.png" contentwidth="200px" contentdepth="50px" align="center"/></imageobject><textobject><phrase>alternative text</phrase></textobject></inlinemediaobject> amet, consectetuer adipiscing elit.</para>',
        'Lorem ipsum dolor sit <nowiki>amet, consectetuer</nowiki> adipiscing elit.'
            =>'<para>Lorem ipsum dolor sit <phrase>amet, consectetuer</phrase> adipiscing elit.</para>',

/*        'Lorem ipsum ^^dolor sit amet^^, consectetuer adipiscing elit.'
            =>'<para>Lorem ipsum <quote>dolor sit amet</quote>, consectetuer adipiscing elit.</para>',
        'Lorem ipsum ^^dolor sit amet|fr^^, consectetuer adipiscing elit.'
            =>'<para>Lorem ipsum <quote lang="fr">dolor sit amet</quote>, consectetuer adipiscing elit.</para>',
        'Lorem ipsum ^^dolor sit amet|fr|foo bar^^, consectetuer adipiscing elit.'
            =>'<para>Lorem ipsum <quote lang="fr">dolor sit amet</quote>, consectetuer adipiscing elit.</para>',*/
        'Lorem ipsum dolor sit amet, {{consectetuer adipiscing}} elit.'
            =>'<para>Lorem ipsum dolor sit amet, <inlinemediaobject><imageobject><imagedata fileref="consectetuer adipiscing"/></imageobject></inlinemediaobject> elit.</para>',
        'Lorem ipsum dolor sit amet, {{consectetuer adipiscing|un titre}} elit.'
            =>'<para>Lorem ipsum dolor sit amet, <inlinemediaobject><imageobject><imagedata fileref="consectetuer adipiscing"/></imageobject><textobject><phrase>un titre</phrase></textobject></inlinemediaobject> elit.</para>',
/*        'Lorem ipsum dolor sit amet, ??consectetuer adipiscing?? elit.'
            =>'<para>Lorem ipsum dolor sit amet, <acronym>consectetuer adipiscing</acronym> elit.</para>',
        'Lorem ipsum dolor sit amet, ??consectetuer adipiscing|un titre?? elit.'
            =>'<para>Lorem ipsum dolor sit amet, <acronym title="un titre">consectetuer adipiscing</acronym> elit.</para>',
        'Lorem ~~ipsumdolorsit~~ amet, consectetuer adipiscing elit.'
            =>'<para>Lorem <anchor id="ipsumdolorsit"/> amet, consectetuer adipiscing elit.</para>',*/
    );



    function testBalisesInlineSimples() {
        $wr = new \WikiRenderer\Renderer(new \WikiRenderer\Markup\DokuDocBook\Config());
        $k=0;
        foreach($this->listinline as $source=>$result){
            $res = $wr->render($source);
            $this->assertEquals($result, $res, "item ".(++$k));
            $this->assertEquals(0, count($wr->errors), "WR returns errors ! ".var_export($wr->errors,true));
        }
    }

    var $listinline2 = array(
        // 'source' => array( nb_error, 'resultat')
        'Lorem **ipsum //dolor sit// amet**, consectetuer adipiscing elit.'
            =>array(0,'<para>Lorem <emphasis role="strong">ipsum <emphasis>dolor sit</emphasis> amet</emphasis>, consectetuer adipiscing elit.</para>'),
        'Lorem **ipsum //dolor sit** amet//, consectetuer adipiscing elit.' // crossed tag 
            =>array(1,'<para>Lorem **ipsum //dolor sit** amet//, consectetuer adipiscing elit.</para>'),
        'Lorem **ipsum //dolor sit** amet**, consectetuer adipiscing elit.' // bad end tag
            =>array(1,'<para>Lorem **ipsum //dolor sit<emphasis role="strong"> amet</emphasis>, consectetuer adipiscing elit.</para>'),
        'Lorem [[bar|ips**um dol**or|fr]] sit amet, consectetuer adipiscing elit.'
            =>array(0,'<para>Lorem <link xlink:href="bar">ips<emphasis role="strong">um dol</emphasis>or</link> sit amet, consectetuer adipiscing elit.</para>'),

        'Lorem [[bar|ips[[um dol]]or|fr]] sit amet, consectetuer adipiscing elit.'
            =>array(0,'<para>Lorem <link xlink:href="bar">ips<link xlink:href="um dol">um dol</link>or</link> sit amet, consectetuer adipiscing elit.</para>'),

        'Lorem [[bar|ips**um dolor|fr]] sit** amet, consectetuer adipiscing elit.'
            =>array(1,'<para>Lorem [[bar|ips<emphasis role="strong">um dolor|fr]] sit</emphasis> amet, consectetuer adipiscing elit.</para>'),

    );

    function testBalisesInlineComplexes() {
        $wr = new \WikiRenderer\Renderer(new \WikiRenderer\Markup\DokuDocBook\Config());
        foreach($this->listinline2 as $source=>$result){
            $res = $wr->render($source);
            $this->assertEquals($result[1], $res, "erreur for ".$source);
            $this->assertEquals($result[0], count($wr->errors), "Bad number of errors (%s)");
        }
    }

}
