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
            =>'<para>Lorem ipsum dolor sit amet, <emphasis role="underline">consectetuer</emphasis> adipiscing elit.</para>',
        'Lorem ipsum dolor sit amet, <sub>consectetuer</sub> adipiscing elit.'
            =>'<para>Lorem ipsum dolor sit amet, <subscript>consectetuer</subscript> adipiscing elit.</para>',
        'Lorem ipsum dolor sit amet, <sup>consectetuer</sup> adipiscing elit.'
            =>'<para>Lorem ipsum dolor sit amet, <superscript>consectetuer</superscript> adipiscing elit.</para>',
        'Lorem ipsum dolor sit amet, <del>consectetuer</del> adipiscing elit.'
            =>'<para>Lorem ipsum dolor sit amet, <emphasis role="deletion">consectetuer</emphasis> adipiscing elit.</para>',
        'Lorem ipsum dolor sit amet, \\\\consectetuer adipiscing elit.'
            =>'<para>Lorem ipsum dolor sit amet, \\\\consectetuer adipiscing elit.</para>',
        'Lorem ipsum dolor sit amet, \\\\
consectetuer adipiscing elit.'
            =>'<para>Lorem ipsum dolor sit amet, 
consectetuer adipiscing elit.</para>',
        'Lorem [[ipsum dolor]] sit amet, consectetuer adipiscing elit.'
            =>'<para>Lorem <link xlink:href="/wiki/ipsum dolor">ipsum dolor</link> sit amet, consectetuer adipiscing elit.</para>',
        'Lorem [[#ipsum.dolor]] sit amet, consectetuer adipiscing elit.'
            =>'<para>Lorem <link linkend="ipsum.dolor">#ipsum.dolor</link> sit amet, consectetuer adipiscing elit.</para>',
        'Lorem [[http://foo.com|ipsum dolor]] sit amet, consectetuer adipiscing elit.'
            =>'<para>Lorem <link xlink:href="http://foo.com">ipsum dolor</link> sit amet, consectetuer adipiscing elit.</para>',
        'Lorem [[ javascript:alert(window.title) | ipsum dolor]] sit amet, consectetuer adipiscing elit.'
            =>'<para>Lorem  ipsum dolor sit amet, consectetuer adipiscing elit.</para>',
        //'Lorem ((ipsumdolorsit amet)), consectetuer adipiscing elit.'
        //    =>'<para>Lorem <footnote><para>ipsumdolorsit amet</para></footnote>, consectetuer adipiscing elit.</para>',
        'Lorem {{ipsumdolorsit.png}} amet, consectetuer adipiscing elit.'
            =>'<para>Lorem <inlinemediaobject>
<imageobject><imagedata fileref="/wiki/ipsumdolorsit.png"/>
</imageobject></inlinemediaobject> amet, consectetuer adipiscing elit.</para>',
        'Lorem {{ipsumdolorsit.png|alternative text}} amet, consectetuer adipiscing elit.'
            =>'<para>Lorem <inlinemediaobject>
<alt>alternative text</alt>
<imageobject><imagedata fileref="/wiki/ipsumdolorsit.png"/>
</imageobject></inlinemediaobject> amet, consectetuer adipiscing elit.</para>',
        'Lorem {{ ipsumdolorsit.png}} amet, consectetuer adipiscing elit.'
            =>'<para>Lorem <inlinemediaobject>
<imageobject><imagedata fileref="/wiki/ipsumdolorsit.png" align="right"/>
</imageobject></inlinemediaobject> amet, consectetuer adipiscing elit.</para>',
        'Lorem {{ ipsumdolorsit.png }} amet, consectetuer adipiscing elit.'
            =>'<para>Lorem <inlinemediaobject>
<imageobject><imagedata fileref="/wiki/ipsumdolorsit.png" align="center"/>
</imageobject></inlinemediaobject> amet, consectetuer adipiscing elit.</para>',
        'Lorem {{ipsumdolorsit.png }} amet, consectetuer adipiscing elit.'
            =>'<para>Lorem <inlinemediaobject>
<imageobject><imagedata fileref="/wiki/ipsumdolorsit.png" align="left"/>
</imageobject></inlinemediaobject> amet, consectetuer adipiscing elit.</para>',
        'Lorem {{ ipsumdolorsit.png?50}} amet, consectetuer adipiscing elit.'
            =>'<para>Lorem <inlinemediaobject>
<imageobject><imagedata fileref="/wiki/ipsumdolorsit.png" align="right" contentwidth="50" contentdepth="50"/>
</imageobject></inlinemediaobject> amet, consectetuer adipiscing elit.</para>',
        'Lorem {{ipsumdolorsit.png?200x50 }} amet, consectetuer adipiscing elit.'
            =>'<para>Lorem <inlinemediaobject>
<imageobject><imagedata fileref="/wiki/ipsumdolorsit.png" align="left" contentwidth="200" contentdepth="50"/>
</imageobject></inlinemediaobject> amet, consectetuer adipiscing elit.</para>',
        'Lorem {{ ipsumdolorsit.png?200x50 |alternative text}} amet, consectetuer adipiscing elit.'
            =>'<para>Lorem <inlinemediaobject>
<alt>alternative text</alt>
<imageobject><imagedata fileref="/wiki/ipsumdolorsit.png" align="center" contentwidth="200" contentdepth="50"/>
</imageobject></inlinemediaobject> amet, consectetuer adipiscing elit.</para>',
        'Lorem ipsum dolor sit %%amet, consectetuer%% adipiscing elit.'
            =>'<para>Lorem ipsum dolor sit <phrase>amet, consectetuer</phrase> adipiscing elit.</para>',
    );

    function testBalisesInlineSimples() {
        $genConfig = new \WikiRenderer\Generator\Docbook\Config();
        $generator = new \WikiRenderer\Generator\Docbook\Document($genConfig);

        $config = new \WikiRenderer\Markup\Dokuwiki\Config();

        $wr = new \WikiRenderer\Renderer($generator, $config);
        $k=0;
        foreach($this->listinline as $source=>$result){
            $res = $wr->render($source);
            $this->assertEquals($result, $res, "item ".(++$k));
            $this->assertEquals(0, count($wr->errors), "WR returns errors ! ".var_export($wr->errors,true));
            if ($source != 'Lorem [[#ipsum.dolor]] sit amet, consectetuer adipiscing elit.') {
                  $this->validateDocbook($res);
            }
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
            =>array(0,'<para>Lorem <link xlink:href="/wiki/bar">ips<emphasis role="strong">um dol</emphasis>or</link> sit amet, consectetuer adipiscing elit.</para>'),

        'Lorem [[bar|ips[[um dol]]or|fr]] sit amet, consectetuer adipiscing elit.'
            =>array(0,'<para>Lorem <link xlink:href="/wiki/bar">ips<link xlink:href="/wiki/um dol">um dol</link>or</link> sit amet, consectetuer adipiscing elit.</para>'),

        'Lorem [[bar|ips**um dolor|fr]] sit** amet, consectetuer adipiscing elit.'
            =>array(1,'<para>Lorem [[bar|ips<emphasis role="strong">um dolor|fr]] sit</emphasis> amet, consectetuer adipiscing elit.</para>'),

    );

    function testBalisesInlineComplexes() {
        $genConfig = new \WikiRenderer\Generator\Docbook\Config();
        $generator = new \WikiRenderer\Generator\Docbook\Document($genConfig);

        $config = new \WikiRenderer\Markup\Dokuwiki\Config();

        $wr = new \WikiRenderer\Renderer($generator, $config);
        foreach($this->listinline2 as $source=>$result){
            $res = $wr->render($source);
            $this->assertEquals($result[1], $res, "erreur for ".$source);
            $this->assertEquals($result[0], count($wr->errors), "Bad number of errors (%s)");
        }
    }

    protected function validateDocbook($res) {
        $docbook_rng = getenv('DOCBOOK_RNG');
        if ($docbook_rng) {
            $relaxng = '/usr/share/xml/docbook/schema/rng/5.0/docbook.rng';
            if (strpos($docbook_rng, '.rng') !== false ) {
                $relaxng = $docbook_rng;
            }
            $docbook = '<'."?xml version='1.0'?>\n";
            $docbook .= '<book xmlns="http://docbook.org/ns/docbook" xmlns:xlink="http://www.w3.org/1999/xlink" version="5.0">
<title>My First Book</title><article><title>test</title>
';
            $docbook .= $res;
            $docbook .= '</article></book>';

            file_put_contents('docbook_result.xml', $docbook);
            $output = array();
            $returnCode = 0;
            $cmd = "xmllint --relaxng ".escapeshellcmd($relaxng).' --noout docbook_result.xml 2>&1';
            exec($cmd, $output, $returnCode);
            $this->assertEquals("docbook_result.xml validates", implode("\n", $output));
        }

    }

}
