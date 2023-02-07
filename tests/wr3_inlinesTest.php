<?php
/**
 * Tests unitaires
 *
 * @package wikirenderer
 * @subpackage tests
 * @author Laurent Jouanneau
 * @copyright 2006-2023 Laurent Jouanneau
 */

require_once(WR_DIR.'rules/wr3_to_xhtml.php');

class WR3TestsInlines extends PHPUnit\Framework\TestCase {
    var $listinline = array(

        'Lorem ipsum dolor sit amet, consectetuer adipiscing elit.'
            =>'<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>',
        'Lorem __ipsum dolor__ sit amet, consectetuer adipiscing elit.'
            =>'<p>Lorem <strong>ipsum dolor</strong> sit amet, consectetuer adipiscing elit.</p>',
        'Lorem ipsum dolor \'\'sit amet\'\', consectetuer adipiscing elit.'
            =>'<p>Lorem ipsum dolor <em>sit amet</em>, consectetuer adipiscing elit.</p>',
        'Lorem ipsum dolor sit amet, @@consectetuer@@ adipiscing elit.'
            =>'<p>Lorem ipsum dolor sit amet, <code>consectetuer</code> adipiscing elit.</p>',
        'Lorem ipsum dolor sit amet, consectetuer adipiscing elit.'
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
        'Lorem [[ipsum dolor]] sit amet, consectetuer adipiscing elit.'
            =>'<p>Lorem <a href="ipsum dolor">ipsum dolor</a> sit amet, consectetuer adipiscing elit.</p>',
        'Lorem [[ipsum dolor|http://foo.com]] sit amet, consectetuer adipiscing elit.'
            =>'<p>Lorem <a href="http://foo.com">ipsum dolor</a> sit amet, consectetuer adipiscing elit.</p>',
        'Lorem [[ipsum dolor|javascript:alert(window.title)]] sit amet, consectetuer adipiscing elit.'
            =>'<p>Lorem <a href="#">ipsum dolor</a> sit amet, consectetuer adipiscing elit.</p>',
        'Lorem [[ipsum dolor|bar|fr]] sit amet, consectetuer adipiscing elit.'
            =>'<p>Lorem <a href="bar" hreflang="fr">ipsum dolor</a> sit amet, consectetuer adipiscing elit.</p>',
        'Lorem [[ipsum dolor|bar|fr|ceci est un titre]] sit amet, consectetuer adipiscing elit.'
            =>'<p>Lorem <a href="bar" hreflang="fr" title="ceci est un titre">ipsum dolor</a> sit amet, consectetuer adipiscing elit.</p>',
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
        '@@$cond->addCondition(\'property\', \'IS NOT NULL\', \'\');@@'
            =>'<p><code>$cond-&gt;addCondition(\'property\', \'IS NOT NULL\', \'\');</code></p>',
        '@@$cond->addCondition(\'property\', \'IS NOT NULL\');@@'
            =>'<p><code>$cond-&gt;addCondition(\'property\', \'IS NOT NULL\');</code></p>',
    );


    var $listinline2 = array(
        // 'source' => array( nb_error, 'resultat')
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

    );
    function testBalisesInlineSimples() {
        $wr = new WikiRenderer(new wr3_to_xhtml());
        foreach($this->listinline as $source=>$result){
            $res = $wr->render($source);
            $this->assertEquals($res,$result);
            $this->assertEquals(0,count($wr->errors), "Errors detected by wr");
        }
    }

    function testBalisesInlineComplexes() {
        $wr = new WikiRenderer(new wr3_to_xhtml());
        foreach($this->listinline2 as $source=>$result){
            $res = $wr->render($source);
            $this->assertEquals($res,$result[1]);
            $this->assertEquals($result[0],count($wr->errors), "Errors detected by wr");
        }
    }

}
