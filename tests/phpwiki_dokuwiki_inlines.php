<?php
/**
 * Unit tests for phpwiki to dokuwiki syntax conversion.
 *
 * inlines tags
 *
 * @package wikirenderer
 * @subpackage tests
 * @author Laurent Jouanneau
 * @copyright 2009 Laurent Jouanneau
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
                    
        //---- links
        
        'Lorem [ipsum dolor] sit amet, consectetuer adipiscing elit.'
                    =>'Lorem [[ipsum dolor]] sit amet, consectetuer adipiscing elit.',
        'Lorem [#ipsum.dolor] sit amet, consectetuer adipiscing elit.'
                    =>'Lorem [[#ipsum.dolor]] sit amet, consectetuer adipiscing elit.',
        'Lorem [ipsum dolor|http://foo.com] sit amet, consectetuer adipiscing elit.'
                    =>'Lorem [[http://foo.com|ipsum dolor]] sit amet, consectetuer adipiscing elit.',
        'Lorem [ipsum dolor|http://foo.com|bla|blo|bli] sit amet, consectetuer adipiscing elit.'
                    =>'Lorem [[http://foo.com|ipsum dolor]] sit amet, consectetuer adipiscing elit.',
        'Lorem [[ipsum dolor|!http://foo.com] sit amet, consectetuer adipiscing elit.'
                    =>'Lorem [ipsum dolor|http://foo.com] sit amet, consectetuer adipiscing elit.',
        'Lorem [[ipsum dolor|http://foo.com] sit amet, consectetuer adipiscing elit.'
                    =>'Lorem [ipsum dolor|[[http://foo.com]]] sit amet, consectetuer adipiscing elit.',
        'Lorem [ ipsum dolor | javascript:alert(window.title)] sit amet, consectetuer adipiscing elit.'
                    =>'Lorem [[ javascript:alert(window.title)| ipsum dolor ]] sit amet, consectetuer adipiscing elit.',
        'Lorem [[ipsumdolorsit amet], consectetuer adipiscing elit.'
                    =>'Lorem [ipsumdolorsit amet], consectetuer adipiscing elit.',
        'Lorem [[[[ipsumdolor sit amet], consectetuer adipiscing elit.'
                    =>'Lorem [[ipsumdolor sit amet], consectetuer adipiscing elit.',
        'Lorem [ipsumdolorsit amet], [[consectetuer] adipiscing elit.'
                    =>'Lorem [[ipsumdolorsit amet]], [consectetuer] adipiscing elit.',
        'Lorem IpsumDolorSit amet, consectetuer adipiscing elit.'
                    =>'Lorem [[IpsumDolorSit]] amet, consectetuer adipiscing elit.',
        'Lorem !IpsumDolorSit amet, consectetuer adipiscing elit.'
                    =>'Lorem IpsumDolorSit amet, consectetuer adipiscing elit.',
        'Lorem !!IpsumDolorSit amet, consectetuer adipiscing elit.'
                    =>'Lorem !IpsumDolorSit amet, consectetuer adipiscing elit.',
        'Lorem [IpsumDolorSit] amet, consectetuer adipiscing elit.'
                    =>'Lorem [[IpsumDolorSit]] amet, consectetuer adipiscing elit.',
        'Lorem [Ipsum/DolorSit] amet, consectetuer adipiscing elit.'
                    =>'Lorem [[Ipsum:DolorSit]] amet, consectetuer adipiscing elit.',
        'Lorem [/Ipsum/DolorSit] amet, consectetuer adipiscing elit.'
                    =>'Lorem [[/Ipsum/DolorSit]] amet, consectetuer adipiscing elit.',
        'Lorem [http://flou.local/Ipsum/DolorSit] amet, consectetuer adipiscing elit.'
                    =>'Lorem [[http://flou.local/Ipsum/DolorSit]] amet, consectetuer adipiscing elit.',
        'Lorem [[!http://flou.local/Ipsum/DolorSit] amet, consectetuer adipiscing elit.'
                    =>'Lorem [http://flou.local/Ipsum/DolorSit] amet, consectetuer adipiscing elit.',
        'Lorem [[http://flou.local/Ipsum/DolorSit] amet, consectetuer adipiscing elit.'
                    =>'Lorem [[[http://flou.local/Ipsum/DolorSit]]] amet, consectetuer adipiscing elit.',
        'Lorem http://flou.local/Ipsum/DolorSit amet, consectetuer adipiscing elit.'
                    =>'Lorem [[http://flou.local/Ipsum/DolorSit]] amet, consectetuer adipiscing elit.',
        'Lorem !http://flou.local/Ipsum/DolorSit amet, consectetuer adipiscing elit.'
                    =>'Lorem http://flou.local/Ipsum/DolorSit amet, consectetuer adipiscing elit.',
        'Lorem __http://flou.local/Ipsum/DolorSit amet__, consectetuer adipiscing elit.'
                    =>'Lorem **[[http://flou.local/Ipsum/DolorSit]] amet**, consectetuer adipiscing elit.',
        'Lorem [phpwiki:IpsumDolorSit?action=browse] amet, consectetuer adipiscing elit.'
                    =>'Lorem [[IpsumDolorSit?]] amet, consectetuer adipiscing elit.',

        'Lorem ipsum dolor[2] sit amet, consectetuer adipiscing elit.'
                    =>'Lorem ipsum dolor[[!PWNOTE2!]] sit amet, consectetuer adipiscing elit.',

        'Lorem [http://flou.local/Ipsum/DolorSit.png] amet, consectetuer adipiscing elit.'
                    =>'Lorem {{http://flou.local/Ipsum/DolorSit.png}} amet, consectetuer adipiscing elit.',

        'Lorem [ipsumdolorsit.png] amet, consectetuer adipiscing elit.'
                    =>'Lorem {{ipsumdolorsit.png}} amet, consectetuer adipiscing elit.',
        'Lorem [alternative text|ipsumdolorsit.png] amet, consectetuer adipiscing elit.'
                    =>'Lorem {{ipsumdolorsit.png|alternative text}} amet, consectetuer adipiscing elit.',
        'Lorem [ ipsumdolorsit.png] amet, consectetuer adipiscing elit.'
                    =>'Lorem {{ ipsumdolorsit.png}} amet, consectetuer adipiscing elit.',
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

}
if(!defined('ALL_TESTS')) {
      $test = new phpwiki_dokuwiki_inlines();
      $test->run(new HtmlReporter2());
}
