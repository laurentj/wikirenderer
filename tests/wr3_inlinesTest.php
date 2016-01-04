<?php
/**
 * Tests unitaires
 *
 * @package wikirenderer
 * @subpackage tests
 * @author Laurent Jouanneau
 * @copyright 2006-2013 Laurent Jouanneau
 */


class WR3TestsInlines extends PHPUnit_Framework_TestCase {

    public function listInlineProvider() {
        return array(
        array('Lorem ipsum dolor sit amet, consectetuer adipiscing elit.'
            ,'<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>'),
        array('Lorem __ipsum dolor__ sit amet, consectetuer adipiscing elit.'
            ,'<p>Lorem <strong>ipsum dolor</strong> sit amet, consectetuer adipiscing elit.</p>'),
        array('Lorem ipsum dolor \'\'sit amet\'\', consectetuer adipiscing elit.'
            ,'<p>Lorem ipsum dolor <em>sit amet</em>, consectetuer adipiscing elit.</p>'),
        array('Lorem ipsum dolor sit amet, @@consectetuer@@ adipiscing elit.'
            ,'<p>Lorem ipsum dolor sit amet, <code>consectetuer</code> adipiscing elit.</p>'),
        array('Lorem ipsum dolor sit amet, consectetuer adipiscing elit.'
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
/*        array('Lorem [[ipsum dolor]] sit amet, consectetuer adipiscing elit.'
            ,'<p>Lorem <a href="ipsum dolor">ipsum dolor</a> sit amet, consectetuer adipiscing elit.</p>'),
        array('Lorem [[ipsum dolor|http://foo.com]] sit amet, consectetuer adipiscing elit.'
            ,'<p>Lorem <a href="http://foo.com">ipsum dolor</a> sit amet, consectetuer adipiscing elit.</p>'),
        array('Lorem [[ipsum dolor|javascript:alert(window.title)]] sit amet, consectetuer adipiscing elit.'
            ,'<p>Lorem <a href="#">ipsum dolor</a> sit amet, consectetuer adipiscing elit.</p>'),
        array('Lorem [[ipsum dolor|bar|fr]] sit amet, consectetuer adipiscing elit.'
            ,'<p>Lorem <a href="bar" hreflang="fr">ipsum dolor</a> sit amet, consectetuer adipiscing elit.</p>'),
        array('Lorem [[ipsum dolor|bar|fr|ceci est un titre]] sit amet, consectetuer adipiscing elit.'
            ,'<p>Lorem <a href="bar" hreflang="fr" title="ceci est un titre">ipsum dolor</a> sit amet, consectetuer adipiscing elit.</p>'),
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
        array('@@$cond->addCondition(\'property\', \'IS NOT NULL\', \'\');@@'
            ,'<p><code>$cond-&gt;addCondition(\'property\', \'IS NOT NULL\', \'\');</code></p>'),
        array('@@$cond->addCondition(\'property\', \'IS NOT NULL\');@@'
            ,'<p><code>$cond-&gt;addCondition(\'property\', \'IS NOT NULL\');</code></p>'),
*/        );
    }

    public function listInlineComplexesProvider() {
        return array(
        // 'source' => array( nb_error, 'resultat')
/*        array('Lorem __ipsum \'\'dolor sit\'\' amet__, consectetuer adipiscing elit.'
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
*/        );
    }

    /**
     * @dataProvider listInlineProvider
     */
    function testBalisesInlineSimples($source, $expected) {
        $genConfig = new \WikiRenderer\Generator\Html\Config();
        $generator = new \WikiRenderer\Generator\Html\Html($genConfig);
        $markupConfig = new \WikiRenderer\Markup\WR3\Config();
        $wr = new \WikiRenderer\RendererNG($generator, $markupConfig);
        $res = $wr->render($source);
        $this->assertEquals($expected, $res);
        $this->assertEquals(0, count($wr->errors));
    }

    /**
     * @dataProvider listInlineComplexesProvider
     */
    /*function testBalisesInlineComplexes($source, $errors, $expected) {
        $genConfig = new \WikiRenderer\Generator\Html\Config();
        $generator = new \WikiRenderer\Generator\Html\Html($genConfig);
        $markupConfig = new \WikiRenderer\Markup\WR3\Config();
        $wr = new \WikiRenderer\RendererNG($generator, $markupConfig);

        $res = $wr->render($source);
        $this->assertEquals($expected, $res);
        $this->assertEquals($errors, count($wr->errors));
    }*/

}
