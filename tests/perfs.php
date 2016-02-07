<?php
/**
 * Tests unitaires
 *
 * @package wikirenderer
 * @subpackage tests
 * @author Laurent Jouanneau
 * @copyright 2003-2014 Laurent Jouanneau
 */
header('ContentType: text/plain');
require_once(__DIR__.'/../vendor/autoload.php');
include('dataSeries.php');

function getMicroTime(){
    list($micro,$time) = explode (' ', microtime());
    return $micro + $time;
}

$start=getMicroTime();

$genConfig = new \WikiRenderer\Generator\Html\Config();
$generator = new \WikiRenderer\Generator\Html\Document($genConfig);
$markupConfig = new \WikiRenderer\Markup\ClassicWR\Config();
$wr = new \WikiRenderer\Renderer($generator, $markupConfig);

foreach($list as $k=> $t){
    $res =$wr->render($t[0]);
}
$stop =getMicroTime();


echo "time=".(intval(($stop - $start)*1000) / 1000);
