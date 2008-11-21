<?php
/**
 * Tests unitaires
 *
 * @package wikirenderer
 * @subpackage tests
 * @author Laurent Jouanneau
 * @copyright 2003-2006 Laurent Jouanneau
 */
header('ContentType: text/plain');
require_once('wikirenderer/WikiRenderer.lib.php');
include('datasSerie.php');

function getMicroTime(){
    list($micro,$time) = explode (' ', microtime());
    return $micro + $time;
}


$start=getMicroTime();

$wr= new WikiRenderer('classicwr_to_xhtml');
foreach($list as $k=> $t){
    $res =$wr->render($t[0]);
}
$stop =getMicroTime();


echo "time=".(intval(($stop - $start)*1000) / 1000);

