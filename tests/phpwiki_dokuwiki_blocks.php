<?php
/**
 * Unit tests for phpwiki to dokuwiki syntax conversion.
 *
 * blocks tags
 *
 * @package wikirenderer
 * @subpackage tests
 * @author Laurent Jouanneau
 * @copyright 2009 Laurent Jouanneau
 */

require_once('common.php');
require_once(WR_DIR.'rules/phpwiki_to_dokuwiki.php');

class phpwiki_dokuwiki_blocks extends WikiRendererUnitTestCase {

    protected $data = array(
0=>array(
'',
'',
0),

1=>array(
'
Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Cras interdum.
Donec dictum. Sed fringilla. Duis feugiat pharetra tortor. Nulla facilisi.

',
'
Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Cras interdum.
Donec dictum. Sed fringilla. Duis feugiat pharetra tortor. Nulla facilisi.

',
0),

2=>array(
'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Cras interdum.
Donec dictum. Sed fringilla. Duis feugiat pharetra tortor. Nulla facilisi.

In hac habitasse platea dictumst. Nulla facilisi. Pellentesque sodales laoreet est.
Nulla varius egestas risus. Duis sollicitudin tempor arcu. Mauris porta leo id dui
luctus luctus. Aliquam nec lacus. Integer egestas.
',
'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Cras interdum.
Donec dictum. Sed fringilla. Duis feugiat pharetra tortor. Nulla facilisi.

In hac habitasse platea dictumst. Nulla facilisi. Pellentesque sodales laoreet est.
Nulla varius egestas risus. Duis sollicitudin tempor arcu. Mauris porta leo id dui
luctus luctus. Aliquam nec lacus. Integer egestas.
',
0),

3=>array(
'Lorem ipsum __dolor__ sit amet, consectetuer adipiscing elit. Cras interdum.
Donec dictum. Sed fringilla. Duis feugiat pharetra tortor. Nulla facilisi.

In hac habitasse platea dictumst. Nulla facilisi. Pellentesque sodales laoreet est.
Nulla varius egestas risus. Duis sollicitudin tempor arcu. Mauris porta leo id dui
luctus luctus. Aliquam nec lacus. Integer egestas.
',
'Lorem ipsum **dolor** sit amet, consectetuer adipiscing elit. Cras interdum.
Donec dictum. Sed fringilla. Duis feugiat pharetra tortor. Nulla facilisi.

In hac habitasse platea dictumst. Nulla facilisi. Pellentesque sodales laoreet est.
Nulla varius egestas risus. Duis sollicitudin tempor arcu. Mauris porta leo id dui
luctus luctus. Aliquam nec lacus. Integer egestas.
',
0),


4=>array(
"Lorem __ipsum dolor__ sit amet, ''consectetuer adipiscing'' elit. Ut scelerisque. Ut iaculis ultrices nulla. Cras viverra diam nec justo.

* Phasellus non eros sit amet sem tristique laoreet.
*# Nam mi wisi, pellentesque dictum,
*# tristique in, tristique quis, erat.
*## In in erat ut urna vulputate vestibulum. Aenean justo.
*## In quis nisl.
* Morbi justo libero, pharetra a,
* malesuada eget, lacinia in, ligula.

Mauris [sit amet massa|http://ljouanneau.com] pretium dapibus.",

"Lorem **ipsum dolor** sit amet, //consectetuer adipiscing// elit. Ut scelerisque. Ut iaculis ultrices nulla. Cras viverra diam nec justo.

   * Phasellus non eros sit amet sem tristique laoreet.
      # Nam mi wisi, pellentesque dictum,
      # tristique in, tristique quis, erat.
         # In in erat ut urna vulputate vestibulum. Aenean justo.
         # In quis nisl.
   * Morbi justo libero, pharetra a,
   * malesuada eget, lacinia in, ligula.

Mauris [[http://ljouanneau.com|sit amet massa]] pretium dapibus.",
0),

5=>array(
'In hac habitasse platea dictumst. Nulla facilisi. Pellentesque sodales laoreet est.
-----
Nulla varius egestas risus. Duis sollicitudin tempor arcu. Mauris porta leo id dui
luctus luctus. Aliquam nec lacus. Integer egestas.',
    
'In hac habitasse platea dictumst. Nulla facilisi. Pellentesque sodales laoreet est.

Nulla varius egestas risus. Duis sollicitudin tempor arcu. Mauris porta leo id dui
luctus luctus. Aliquam nec lacus. Integer egestas.',
0
),
6=>array(
'!!!In hac habitasse \'\'platea\'\' dictumst. Nulla facilisi.

!!Pellentesque __sodales__ laoreet est.
Phasellus non eros sit amet sem tristique laoreet.
!Nulla varius egestas risus.
Duis sollicitudin tempor arcu. Mauris porta leo id dui
luctus luctus. Aliquam nec lacus. Integer egestas.',
'= In hac habitasse //platea// dictumst. Nulla facilisi. =

== Pellentesque **sodales** laoreet est. ==
Phasellus non eros sit amet sem tristique laoreet.
=== Nulla varius egestas risus. ===
Duis sollicitudin tempor arcu. Mauris porta leo id dui
luctus luctus. Aliquam nec lacus. Integer egestas.',
0),

7=>array(
'Lorem ipsum __dolor__ sit amet, consectetuer adipiscing elit.

 Cras interdum.
 Donec DiCtum. [Sed fringilla].
 Duis !FeuGiat [[pharetra] tortor.
 Nulla facilisi.

In hac habitasse platea dictumst. Nulla facilisi.',
'Lorem ipsum **dolor** sit amet, consectetuer adipiscing elit.

<code> Cras interdum.
 Donec [[DiCtum]]. [[Sed fringilla]].
 Duis FeuGiat [pharetra] tortor.
 Nulla facilisi.</code>

In hac habitasse platea dictumst. Nulla facilisi.',
0),
8=>array(
'||  __Nom__               |v __Coût__   |v __Notes__
| __Prénom__   | __Nom de famille__
|> Jeff       |< Dairiki   |^  Pas cher     |< Pas valable
|> Marco      |< Polo      | Encore moins cher     |< Pas disponible',
'| **Nom** || **Coût** | **Notes** |
| **Prénom** | **Nom de famille** | | |
|   Jeff | Dairiki   |   Pas cher   | Pas valable   |
|   Marco | Polo   | Encore moins cher | Pas disponible   |',
0),
9=>array(
'| __Nom__               |v __Coût__   | __Notes__ 
| __Prénom__   | __Nom de famille__
|  Jeff       |< Dairiki   |^  Pas cher    
|| Polo    | ooo   ',
'| **Nom** | **Coût** | **Notes** |
| **Prénom** | | **Nom de famille** |
| Jeff | Dairiki   |   Pas cher   |
| Polo || ooo |',
0),
/* bug on latest line: combination on rowspan+colspan
10=>array(
'| __Nom__               |v __Coût__   | __Notes__ 
| __Prénom__   | __Nom de famille__
|v Jeff       |< Dairiki   |^  Pas cher    
|| Polo       ',
'| **Nom** | **Coût** | **Notes** |
| **Prénom** | | **Nom de famille** |
| Jeff | Dairiki   |   Pas cher   |
| | Polo ||',
0),
              */
11=>array(
'Lorem ipsum __dolor__ sit amet, consectetuer adipiscing elit. Cras interdum.
;:Donec dictum. Sed fringilla. Duis feugiat pharetra tortor. Nulla facilisi.
;:
;:In hac habitasse platea \'\'dictumst. Nulla\'\' facilisi. Pellentesque sodales laoreet est.
Nulla varius egestas risus. Duis sollicitudin tempor arcu. Mauris porta leo id dui
luctus luctus. Aliquam nec lacus. Integer egestas.
',
'Lorem ipsum **dolor** sit amet, consectetuer adipiscing elit. Cras interdum.
>Donec dictum. Sed fringilla. Duis feugiat pharetra tortor. Nulla facilisi.
>
>In hac habitasse platea //dictumst. Nulla// facilisi. Pellentesque sodales laoreet est.
Nulla varius egestas risus. Duis sollicitudin tempor arcu. Mauris porta leo id dui
luctus luctus. Aliquam nec lacus. Integer egestas.
',
0),

12=>array(
'Lorem ipsum __dolor__ sit amet, consectetuer adipiscing elit. Cras interdum.
Donec dictum. Sed fringilla. Duis feugiat pharetra tortor. Nulla facilisi.

<?plugin nom  param=value?>

In hac habitasse platea \'\'dictumst. Nulla\'\' facilisi.
<?plugin nom2 ?>
<?plugin nom3?>

Pellentesque sodales laoreet est.
Nulla varius egestas risus.',
'Lorem ipsum **dolor** sit amet, consectetuer adipiscing elit. Cras interdum.
Donec dictum. Sed fringilla. Duis feugiat pharetra tortor. Nulla facilisi.

~~nom:param=value~~

In hac habitasse platea //dictumst. Nulla// facilisi.
~~nom2~~
~~nom3~~

Pellentesque sodales laoreet est.
Nulla varius egestas risus.',
0),

    );



    public function testBlocks() {
        $wr = new WikiRenderer(new phpwiki_to_dokuwiki());
        foreach($this->data as $k=>$test){
            list($source, $result, $nberror) = $test;
            $res = $wr->render($source);

            $this->assertEqualOrDiff($result, $res, "error on $k th test");

            if(!$this->assertEqual(count($wr->errors), $nberror, "Errors detected by wr ! (%s)")){
                $this->dump($wr->errors);
            }
        }
    }


    protected $listblocks = array( '1'=>0
    );

    function testBlockFiles() {

        $wr = new WikiRenderer(new phpwiki_to_dokuwiki());
        foreach($this->listblocks as $file=>$nberror){
            $sourceFile = 'datasblocks/pw_dk_'.$file.'.src';
            $resultFile = 'datasblocks/pw_dk_'.$file.'.res';

            $source = file_get_contents($sourceFile);
            $result = file_get_contents($resultFile);

            $res = $wr->render($source);
            $this->assertEqualOrDiff($result, $res, "error on $file");
            echo '<!--'.$res.'-->';
            if(!$this->assertEqual(count($wr->errors), $nberror, "Errors detected by wr ! (%s)")){
                $this->dump($wr->errors);
            }
        }
    }
}

if(!defined('ALL_TESTS')) {
    $test = new phpwiki_dokuwiki_blocks();
    $test->run(new HtmlReporter2());
}
