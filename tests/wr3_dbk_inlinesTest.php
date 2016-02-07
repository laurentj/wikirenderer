<?php
/**
 * Tests unitaires
 *
 * @package wikirenderer
 * @subpackage tests
 * @author Laurent Jouanneau
 * @copyright 2006-2013 Laurent Jouanneau
 */

class WR3DBKTestsInlines extends PHPUnit_Framework_TestCase {
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
            =>'<para>Lorem ipsum <quote><foreignphrase xml:lang="fr">dolor sit amet</foreignphrase></quote>, consectetuer adipiscing elit.</para>',
        'Lorem ipsum ^^dolor sit amet|fr|foo bar^^, consectetuer adipiscing elit.'
            =>'<para>Lorem ipsum <quote><foreignphrase xml:lang="fr">dolor sit amet</foreignphrase></quote>, consectetuer adipiscing elit.</para>',
        'Lorem ipsum dolor sit amet, {{consectetuer adipiscing}} elit.'
            =>'<para>Lorem ipsum dolor sit amet, <citetitle>consectetuer adipiscing</citetitle> elit.</para>',
        'Lorem ipsum dolor sit amet, {{consectetuer adipiscing|un titre}} elit.'
            =>'<para>Lorem ipsum dolor sit amet, <citetitle>consectetuer adipiscing</citetitle> elit.</para>',
        'Lorem ipsum dolor sit amet, ??consectetuer adipiscing?? elit.'
            =>'<para>Lorem ipsum dolor sit amet, <acronym>consectetuer adipiscing</acronym> elit.</para>',
        'Lorem ipsum dolor sit amet, ??consectetuer adipiscing|un titre?? elit.'
            =>'<para>Lorem ipsum dolor sit amet, <acronym><alt>un titre</alt>consectetuer adipiscing</acronym> elit.</para>',
        'Lorem [[ipsum dolor]] sit amet, consectetuer adipiscing elit.'
            =>'<para>Lorem <link xlink:href="ipsum dolor">ipsum dolor</link> sit amet, consectetuer adipiscing elit.</para>',
        'Lorem [[#ipsum.dolor]] sit amet, consectetuer adipiscing elit.'
            =>'<para>Lorem <link linkend="ipsum.dolor">#ipsum.dolor</link> sit amet, consectetuer adipiscing elit.</para>',
        'Lorem [[ipsum dolor|http://foo.com]] sit amet, consectetuer adipiscing elit.'
            =>'<para>Lorem <link xlink:href="http://foo.com">ipsum dolor</link> sit amet, consectetuer adipiscing elit.</para>',
        'Lorem [[ipsum dolor|javascript:alert(window.title)]] sit amet, consectetuer adipiscing elit.'
            =>'<para>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</para>',
        'Lorem [[ipsum dolor|bar|fr]] sit amet, consectetuer adipiscing elit.'
            =>'<para>Lorem <link xlink:href="bar">ipsum dolor</link> sit amet, consectetuer adipiscing elit.</para>',
        'Lorem [[ipsum dolor|bar|fr|ceci est un titre]] sit amet, consectetuer adipiscing elit.'
            =>'<para>Lorem <link xlink:href="bar">ipsum dolor</link> sit amet, consectetuer adipiscing elit.</para>',
        'Lorem ((ipsumdolorsit.png)) amet, consectetuer adipiscing elit.'
            =>'<para>Lorem <inlinemediaobject>
<imageobject><imagedata fileref="ipsumdolorsit.png"/>
</imageobject></inlinemediaobject> amet, consectetuer adipiscing elit.</para>',
        'Lorem ((ipsumdolorsit.png|alternative text)) amet, consectetuer adipiscing elit.'
            =>'<para>Lorem <inlinemediaobject>
<alt>alternative text</alt>
<imageobject><imagedata fileref="ipsumdolorsit.png"/>
</imageobject></inlinemediaobject> amet, consectetuer adipiscing elit.</para>',
        'Lorem ((ipsumdolorsit.png|alternative text|L)) amet, consectetuer adipiscing elit.'
            =>'<para>Lorem <inlinemediaobject>
<alt>alternative text</alt>
<imageobject><imagedata fileref="ipsumdolorsit.png" align="left"/>
</imageobject></inlinemediaobject> amet, consectetuer adipiscing elit.</para>',
        'Lorem ((ipsumdolorsit.png|alternative text|R|longue description)) amet, consectetuer adipiscing elit.'
            =>'<para>Lorem <inlinemediaobject>
<info><abstract><title></title><para>longue description</para></abstract></info>
<alt>alternative text</alt>
<imageobject><imagedata fileref="ipsumdolorsit.png" align="right"/>
</imageobject></inlinemediaobject> amet, consectetuer adipiscing elit.</para>',
        'Lorem ~~ipsumdolorsit~~ amet, consectetuer adipiscing elit.'
            =>'<para>Lorem <anchor xml:id="ipsumdolorsit"/> amet, consectetuer adipiscing elit.</para>',
        //'Lorem $$ipsumdolorsit amet$$, consectetuer adipiscing elit.'
        //    =>'<para>Lorem <footnote><para>ipsumdolorsit amet</para></footnote>, consectetuer adipiscing elit.</para>',

    );



    function testBalisesInlineSimples() {
        $genConfig = new \WikiRenderer\Generator\Docbook\Config();
        $generator = new \WikiRenderer\Generator\Docbook\Document($genConfig);

        $config = new \WikiRenderer\Markup\WR3\Config();

        $wr = new \WikiRenderer\Renderer($generator, $config);
        foreach($this->listinline as $source=>$expected){
            $res = $wr->render($source);
            $this->assertEquals($expected, $res, $source);
            $this->assertEquals(0, count($wr->errors),0);
            if ($source != 'Lorem [[#ipsum.dolor]] sit amet, consectetuer adipiscing elit.') {
                $this->validateDocbook($res);
            }
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
            =>array(0,'<para>Lorem <link xlink:href="bar">ips<emphasis role="strong">um dol</emphasis>or</link> sit amet, consectetuer adipiscing elit.</para>'),

        'Lorem [[ips[[um dol]]or|bar|fr]] sit amet, consectetuer adipiscing elit.'
            =>array(0,'<para>Lorem <link xlink:href="bar">ips<link xlink:href="um dol">um dol</link>or</link> sit amet, consectetuer adipiscing elit.</para>'),

        'Lorem [[ips[[um dolor|bar|fr]] sit]] amet, consectetuer adipiscing elit.'
            =>array(0,'<para>Lorem <link xlink:href="ips[[um dolor|bar|fr]] sit">ips[[um dolor|bar|fr]] sit</link> amet, consectetuer adipiscing elit.</para>'),
        'Lorem [[ips__um dolor|bar|fr]] sit__ amet, consectetuer adipiscing elit.'
            =>array(1,'<para>Lorem [[ips<emphasis role="strong">um dolor|bar|fr]] sit</emphasis> amet, consectetuer adipiscing elit.</para>'),

    );

    function testBalisesInlineComplexes() {
        $genConfig = new \WikiRenderer\Generator\Docbook\Config();
        $generator = new \WikiRenderer\Generator\Docbook\Document($genConfig);

        $config = new \WikiRenderer\Markup\WR3\Config();

        $wr = new \WikiRenderer\Renderer($generator, $config);
        foreach($this->listinline2 as $source=>$result){
            $res = $wr->render($source);
            $this->assertEquals($result[1], $res);
            $this->assertEquals($result[0], count($wr->errors), "Bad number of errors");
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
