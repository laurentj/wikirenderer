<?php
/**
 * Tests unitaires
 *
 * @package wikirenderer
 * @subpackage tests
 * @author Laurent Jouanneau
 * @copyright 2006-2013 Laurent Jouanneau
 */

class DokuwikiTestsInlineParser extends PHPUnit_Framework_TestCase {

    var $listinline2 = array(

        'Lorem ipsum dolor sit amet, consectetuer adipiscing elit.'
           =>'Lorem ipsum dolor sit amet, consectetuer adipiscing elit.',
        'Lorem ipsum dolor **sit amet**, consectetuer adipiscing elit.'
            =>'Lorem ipsum dolor <strong>sit amet</strong>, consectetuer adipiscing elit.',
        'Lorem ipsum dolor **0**, consectetuer adipiscing elit.'
            =>'Lorem ipsum dolor <strong>0</strong>, consectetuer adipiscing elit.',
        'Lorem **ipsum dolor** sit amet, consectetuer adipiscing elit.'
            =>'Lorem <strong>ipsum dolor</strong> sit amet, consectetuer adipiscing elit.',
        'Lorem ipsum dolor //sit amet//, consectetuer adipiscing elit.'
            =>'Lorem ipsum dolor <em>sit amet</em>, consectetuer adipiscing elit.',
        'Lorem __ipsum dolor__ sit amet, consectetuer adipiscing elit.'
            =>'Lorem <u>ipsum dolor</u> sit amet, consectetuer adipiscing elit.',
        'Lorem ipsum dolor <del>sit amet</del>, consectetuer adipiscing elit.'
            =>'Lorem ipsum dolor <del>sit amet</del>, consectetuer adipiscing elit.',
        'Lorem ipsum dolor <sup>sit amet</sup>, consectetuer adipiscing elit.'
            =>'Lorem ipsum dolor <sup>sit amet</sup>, consectetuer adipiscing elit.',
        'Lorem ipsum dolor <sub>sit amet</sub>, consectetuer adipiscing elit.'
            =>'Lorem ipsum dolor <sub>sit amet</sub>, consectetuer adipiscing elit.',

        'Lorem ipsum dolor <sub>sit \\\\amet</sub>, \\\\ consectetuer adipiscing elit.\\\\'
            =>'Lorem ipsum dolor <sub>sit \\\\amet</sub>, <br />consectetuer adipiscing elit.<br />',

        'Lorem ipsum dolor sit amet, \'\'consectetuer\'\' adipiscing elit.'
            =>'Lorem ipsum dolor sit amet, <code>consectetuer</code> adipiscing elit.',
        'Lorem ipsum dolor sit %%amet, \'\'consectetuer\'\' adipiscing%% elit.'
            =>'Lorem ipsum dolor sit <span>amet, \'\'consectetuer\'\' adipiscing</span> elit.',


        'Lorem [[ipsum dolor]] sit amet, consectetuer adipiscing elit.'
            =>'Lorem <a href="/wiki/ipsum dolor">ipsum dolor</a> sit amet, consectetuer adipiscing elit.',
        'Lorem [[http://foo.com|ipsum dolor]] sit amet, consectetuer adipiscing elit.'
            =>'Lorem <a href="http://foo.com">ipsum dolor</a> sit amet, consectetuer adipiscing elit.',
        'Lorem [[javascript:alert(window.title)|ipsum dolor]] sit amet, consectetuer adipiscing elit.'
            =>'Lorem <a href="#">ipsum dolor</a> sit amet, consectetuer adipiscing elit.',
            
        'Lorem [[http://www.php.net|{{wiki:dokuwiki-128.png}}]] sit amet, consectetuer adipiscing elit.'
            =>'Lorem <a href="http://www.php.net"><img src="/wiki/wiki:dokuwiki-128.png" alt=""/></a> sit amet, consectetuer adipiscing elit.',
        'Lorem [[wp>ipsum dolor]] sit amet, consectetuer adipiscing elit.'
            =>'Lorem <a href="http://wikipedia.org/ipsum dolor">ipsum dolor</a> sit amet, consectetuer adipiscing elit.',
        'Lorem [[ipsum:dolor]] sit amet, consectetuer adipiscing elit.'
            =>'Lorem <a href="/wiki/ipsum:dolor">ipsum:dolor</a> sit amet, consectetuer adipiscing elit.',
        'Lorem [[ipsum:dolor#bar]] sit amet, consectetuer adipiscing elit.'
            =>'Lorem <a href="/wiki/ipsum:dolor#bar">ipsum:dolor</a> sit amet, consectetuer adipiscing elit.',
        'Lorem [[this>dolor#bar]] sit amet, consectetuer adipiscing elit.'
            =>'Lorem <a href="/dolor#bar">dolor#bar</a> sit amet, consectetuer adipiscing elit.',

        /*'Lorem http:\\//foo.com ipsum dolor sit amet, consectetuer adipiscing elit.'
            =>'Lorem <a href="http://foo.com">http://foo.com/<a> ipsum dolor sit amet, consectetuer adipiscing elit.',*/

        'Lorem {{ipsumdolorsit.png}} amet, consectetuer adipiscing elit.'
            =>'Lorem <img src="/wiki/ipsumdolorsit.png" alt=""/> amet, consectetuer adipiscing elit.',
        'Lorem {{ipsumdolorsit.png|alternative text}} amet, consectetuer adipiscing elit.'
            =>'Lorem <img src="/wiki/ipsumdolorsit.png" alt="alternative text"/> amet, consectetuer adipiscing elit.',
        'Lorem {{ipsumdolorsit.png?linkonly|alternative text}} amet, consectetuer adipiscing elit.'
            =>'Lorem <a href="/wiki/ipsumdolorsit.png">alternative text</a> amet, consectetuer adipiscing elit.',
        'Lorem {{ipsumdolorsit.png |alternative text}} amet, consectetuer adipiscing elit.'
            =>'Lorem <img src="/wiki/ipsumdolorsit.png" alt="alternative text" style="float:left;"/> amet, consectetuer adipiscing elit.',
        'Lorem {{ wiki:ipsumdolorsit.png|alternative text}} amet, consectetuer adipiscing elit.'
            =>'Lorem <img src="/wiki/wiki:ipsumdolorsit.png" alt="alternative text" style="float:right;"/> amet, consectetuer adipiscing elit.',
        'Lorem {{ ipsumdolorsit.png?456|alternative text}} amet, consectetuer adipiscing elit.'
            =>'Lorem <img src="/wiki/ipsumdolorsit.png" alt="alternative text" width="456" height="456" style="float:right;"/> amet, consectetuer adipiscing elit.',
        'Lorem {{ ipsumdolorsit.png?456x789|alternative text}} amet, consectetuer adipiscing elit.'
            =>'Lorem <img src="/wiki/ipsumdolorsit.png" alt="alternative text" width="456" height="789" style="float:right;"/> amet, consectetuer adipiscing elit.',
        /*'Lorem ~~ipsumdolorsit~~ amet, consectetuer adipiscing elit.'
            =>'Lorem <span id="ipsumdolorsit" class="wikianchor"><a href="#ipsumdolorsit" class="anchor">¶</a></span> amet, consectetuer adipiscing elit.',
        */
    );

    function testInlineParser2() {
        $genConfig = new \WikiRenderer\Generator\Html\Config();
        $generator = new \WikiRenderer\Generator\Html\Document($genConfig);

        $conf = new \WikiRenderer\Markup\Dokuwiki\Config();

        $wip = new \WikiRenderer\InlineParserNG($conf, $generator);

        $k=0;
        foreach($this->listinline2 as $source=>$trueResult){
            $k++;
            $res = $wip->parse($source);
            $this->assertEquals($trueResult,$res->generate());
        }
    }
}
