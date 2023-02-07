<?php
/**
 * Tests unitaires
 *
 * @package wikirenderer
 * @subpackage tests
 * @author Laurent Jouanneau
 * @copyright 2006-2023 Laurent Jouanneau
 */

require_once(WR_DIR.'rules/classicwr_to_xhtml.php');

class classicwr_inlinesCCTest extends PHPUnit\Framework\TestCase {

    public function getListInline()
    {
        return array(
            ['Lorem ipsum dolor sit amet, ConsecTetuer adipiscing elit.',
            '<p>Lorem ipsum dolor sit amet, <a href="truc/ConsecTetuer/">ConsecTetuer</a> adipiscing elit.</p>'],
            ['Lorem __IpSum dolor__ sit amet, consectetuer adipiscing elit.',
            '<p>Lorem <strong><a href="truc/IpSum/">IpSum</a> dolor</strong> sit amet, consectetuer adipiscing elit.</p>'],
            ['Lorem ipsum ^^dolor sit AmEt^^, consectetuer adipiscing elit.',
            '<p>Lorem ipsum <q>dolor sit <a href="truc/AmEt/">AmEt</a></q>, consectetuer adipiscing elit.</p>'],
            ['Lorem ipsum ^^dolor sit amet|FrPo^^, consectetuer adipiscing elit.',
            '<p>Lorem ipsum <q lang="FrPo">dolor sit amet</q>, consectetuer adipiscing elit.</p>'],
            ['Lorem ipsum ^^dolor sit amet|fr|foo BaRo^^, consectetuer adipiscing elit.',
            '<p>Lorem ipsum <q lang="fr" cite="foo BaRo">dolor sit amet</q>, consectetuer adipiscing elit.</p>'],
            ['Lorem ipsum dolor sit amet, {{ConsecTetuer adipiscing}} elit.',
            '<p>Lorem ipsum dolor sit amet, <cite><a href="truc/ConsecTetuer/">ConsecTetuer</a> adipiscing</cite> elit.</p>'],
            ['Lorem ipsum dolor sit amet, {{consectetuer adipiscing|un TiTre}} elit.',
            '<p>Lorem ipsum dolor sit amet, <cite title="un TiTre">consectetuer adipiscing</cite> elit.</p>'],
            ['Lorem ipsum dolor sit amet, ??ConsecTetuer adipiscing?? elit.',
            '<p>Lorem ipsum dolor sit amet, <acronym><a href="truc/ConsecTetuer/">ConsecTetuer</a> adipiscing</acronym> elit.</p>'],
            ['Lorem ipsum dolor sit amet, ??consectetuer adipiscing|un TiTre?? elit.',
            '<p>Lorem ipsum dolor sit amet, <acronym title="un TiTre">consectetuer adipiscing</acronym> elit.</p>'],
            ['Lorem [ipsum DoLor] sit amet, consectetuer adipiscing elit.',
            '<p>Lorem <a href="ipsum DoLor">ipsum DoLor</a> sit amet, consectetuer adipiscing elit.</p>'],
            ['Lorem [ipsum dolor|http://FoRo.com] sit amet, consectetuer adipiscing elit.',
            '<p>Lorem <a href="http://FoRo.com">ipsum dolor</a> sit amet, consectetuer adipiscing elit.</p>'],
            ['Lorem [ipsum dolor|bar|fr|ceci est un TiTre] sit amet, consectetuer adipiscing elit.',
            '<p>Lorem <a href="bar" hreflang="fr" title="ceci est un TiTre">ipsum dolor</a> sit amet, consectetuer adipiscing elit.</p>'],
            ['Lorem ((IpsumDolorsit.png)) amet, consectetuer adipiscing elit.',
            '<p>Lorem <img src="IpsumDolorsit.png" alt=""/> amet, consectetuer adipiscing elit.</p>'],
            ['Lorem ((ipsumdolorsit.png|AlterNative text)) amet, consectetuer adipiscing elit.',
            '<p>Lorem <img alt="AlterNative text" src="ipsumdolorsit.png"/> amet, consectetuer adipiscing elit.</p>'],
            ['Lorem ((ipsumdolorsit.png|AlteRnative text|R|longue DescriPtion)) amet, consectetuer adipiscing elit.',
            '<p>Lorem <img longdesc="longue DescriPtion" style="float:right;" alt="AlteRnative text" src="ipsumdolorsit.png"/> amet, consectetuer adipiscing elit.</p>'],
            ['Lorem ~~IpsumDolorsit~~ amet, consectetuer adipiscing elit.',
            '<p>Lorem <a name="IpsumDolorsit"></a> amet, consectetuer adipiscing elit.</p>'],

        );
    }


    public function getListInline2()
    {
        return array(
            // 'source' => array( nb_error, 'resultat')
            ['Lorem __ipsum \'\'dolor sit\'\' amet__, ConsecTetuer adipiscing elit.',
              0, '<p>Lorem <strong>ipsum <em>dolor sit</em> amet</strong>, <a href="truc/ConsecTetuer/">ConsecTetuer</a> adipiscing elit.</p>'],
            ['Lorem __ipsum \'\'DoLor sit\'\' amet__, ConsecTetuer adipiscing elit.',
              0, '<p>Lorem <strong>ipsum <em><a href="truc/DoLor/">DoLor</a> sit</em> amet</strong>, <a href="truc/ConsecTetuer/">ConsecTetuer</a> adipiscing elit.</p>'],
            ['Lorem __IpSum \'\'DoLor sit\'\' amet__, ConsecTetuer adipiscing elit.',
              0, '<p>Lorem <strong><a href="truc/IpSum/">IpSum</a> <em><a href="truc/DoLor/">DoLor</a> sit</em> amet</strong>, <a href="truc/ConsecTetuer/">ConsecTetuer</a> adipiscing elit.</p>'],

            /*
            ['Lorem __ipsum \'\'dolor sit__ amet\'\', consectetuer adipiscing elit.',
                1,'<p>Lorem __ipsum \'\'dolor sit__ amet\'\', consectetuer adipiscing elit.</p>'],
            ['Lorem __ipsum \'\'dolor sit__ amet__, consectetuer adipiscing elit.'
                1,'<p>Lorem __ipsum \'\'dolor sit<strong> amet</strong>, consectetuer adipiscing elit.</p>'],
            ['Lorem [ips__um dol__or|bar|fr] sit amet, consectetuer adipiscing elit.'
                0,'<p>Lorem <a href="bar" hreflang="fr">ips<strong>um dol</strong>or</a> sit amet, consectetuer adipiscing elit.</p>'],

            ['Lorem [ips[um dol]or|bar|fr] sit amet, consectetuer adipiscing elit.'
                0,'<p>Lorem <a href="bar" hreflang="fr">ips<a href="um dol">um dol</a>or</a> sit amet, consectetuer adipiscing elit.</p>'],

            ['Lorem [ips[um dolor|bar|fr] sit] amet, consectetuer adipiscing elit.'
                0,'<p>Lorem <a href="ips[um dolor|bar|fr] sit">ips[um dolor|bar|fr] sit</a> amet, consectetuer adipiscing elit.</p>'],
            ['Lorem [ips__um dolor|bar|fr] sit__ amet, consectetuer adipiscing elit.'
                1,'<p>Lorem [ips<strong>um dolor|bar|fr] sit</strong> amet, consectetuer adipiscing elit.</p>'],
                */
        );
    }

    /**
     * @dataProvider getListInline
     * @return void
     * @throws Exception
     */
    function testInlineSimplesWikiWord($source, $result) {
        $conf = new classicwr_to_xhtml();
        $conf->checkWikiWordFunction = 'wikiword';
        $wr = new WikiRenderer($conf);
        $res = $wr->render($source);
        $this->assertEquals($result, $res, "erreur");
        $this->assertEquals(0, count($wr->errors), "WR found errors (%s)");
    }

    /**
     * @dataProvider getListInline2
     * @return void
     * @throws Exception
     */
    function testInlineWikiWord($source, $nbError, $result) {
        $conf = new classicwr_to_xhtml();
        $conf->checkWikiWordFunction = 'wikiword';
        $wr = new WikiRenderer($conf);
        $res = $wr->render($source);
        $this->assertEquals($result, $res);
        $this->assertEquals($nbError, count($wr->errors), "Different errors number (%s)");
    }

}

function wikiword($ww){
    $result=array();
    foreach($ww as $w){
        $result[]='<a href="truc/'.$w.'/">'.$w.'</a>';
    }
    return $result;
}

