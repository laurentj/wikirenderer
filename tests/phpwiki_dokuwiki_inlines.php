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
require_once(WR_DIR.'rules/phpwiki_to_dokuwiki.php');

class phpwiki_dokuwiki_inlines extends WikiRendererUnitTestCase {
    var $listinline = array(
        'Lorem ipsum dolor sit amet, consectetuer adipiscing elit.'
                    =>'Lorem ipsum dolor sit amet, consectetuer adipiscing elit.',
        'Lorem **ipsum dolor** sit amet, consectetuer adipiscing elit.'
                    =>'Lorem **ipsum dolor** sit amet, consectetuer adipiscing elit.',
        'Lorem __ipsum dolor__ sit amet, consectetuer adipiscing elit.'
                    =>'Lorem **ipsum dolor** sit amet, consectetuer adipiscing elit.',
        'Lorem __0__ sit amet, consectetuer adipiscing elit.'
                    =>'Lorem **0** sit amet, consectetuer adipiscing elit.',
        'Lorem ipsum dolor //sit amet//, consectetuer adipiscing elit.'
                    =>'Lorem ipsum dolor //sit amet//, consectetuer adipiscing elit.',
        "Lorem ipsum dolor ''sit amet'', consectetuer adipiscing elit."
                    =>'Lorem ipsum dolor //sit amet//, consectetuer adipiscing elit.',
        'Lorem ipsum dolor sit amet, <sub>consectetuer</sub> adipiscing elit.'
                    =>'Lorem ipsum dolor sit amet, <sub>consectetuer</sub> adipiscing elit.',
        'Lorem ipsum dolor sit amet, <sup>consectetuer</sup> adipiscing elit.'
                    =>'Lorem ipsum dolor sit amet, <sup>consectetuer</sup> adipiscing elit.',
        'Lorem ipsum dolor sit amet, <del>consectetuer</del> adipiscing elit.'
                    =>'Lorem ipsum dolor sit amet, <del>consectetuer</del> adipiscing elit.',
        'Lorem ipsum dolor sit amet, \\\\consectetuer adipiscing elit.'
                    =>'Lorem ipsum dolor sit amet, \\consectetuer adipiscing elit.',
        'Lorem ipsum dolor sit amet, \\\\
consectetuer adipiscing elit.'
                    =>'Lorem ipsum dolor sit amet, \\
consectetuer adipiscing elit.',
        'Lorem [ipsum dolor] sit amet, consectetuer adipiscing elit.'
                    =>'Lorem [[ipsum dolor]] sit amet, consectetuer adipiscing elit.',
        'Lorem [#ipsum.dolor] sit amet, consectetuer adipiscing elit.'
                    =>'Lorem [[#ipsum.dolor]] sit amet, consectetuer adipiscing elit.',
        'Lorem [ipsum dolor|http://foo.com] sit amet, consectetuer adipiscing elit.'
                    =>'Lorem [[http://foo.com|ipsum dolor]] sit amet, consectetuer adipiscing elit.',
        'Lorem [ ipsum dolor | javascript:alert(window.title)] sit amet, consectetuer adipiscing elit.'
                    =>'Lorem [[ javascript:alert(window.title)| ipsum dolor ]] sit amet, consectetuer adipiscing elit.',
        'Lorem ((ipsumdolorsit amet)), consectetuer adipiscing elit.'
                    =>'Lorem ((ipsumdolorsit amet)), consectetuer adipiscing elit.',
        'Lorem {{ipsumdolorsit.png}} amet, consectetuer adipiscing elit.'
                    =>'Lorem {{ipsumdolorsit.png}} amet, consectetuer adipiscing elit.',
        'Lorem {{ipsumdolorsit.png|alternative text}} amet, consectetuer adipiscing elit.'
                    =>'Lorem {{ipsumdolorsit.png|alternative text}} amet, consectetuer adipiscing elit.',
        'Lorem {{ ipsumdolorsit.png}} amet, consectetuer adipiscing elit.'
                    =>'Lorem {{ ipsumdolorsit.png}} amet, consectetuer adipiscing elit.',
        'Lorem ipsum dolor sit <nowiki>amet, consectetuer</nowiki> adipiscing elit.'
                    =>'Lorem ipsum dolor sit <nowiki>amet, consectetuer</nowiki> adipiscing elit.',
    );



    function testBalisesInlineSimples() {
        $wr = new WikiRenderer(new phpwiki_to_dokuwiki());
        $k = 0;
        foreach($this->listinline as $source=>$result){
            $k++;
            $res = $wr->render($source);
            $this->assertEqualOrDiff($result, $res, "erreur on $k th test");
            $this->assertEqual(count($wr->errors),0, "WR returns errors ! ".var_export($wr->errors,true)." (%s)");
        }
    }
/*
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
        $wr = new WikiRenderer(new dokuwiki_to_docbook());
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
*/
}
if(!defined('ALL_TESTS')) {
      $test = new phpwiki_dokuwiki_inlines();
      $test->run(new HtmlReporter2());
}
