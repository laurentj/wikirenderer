<?php
/**
 * Tests unitaires
 *
 * @package wikirenderer
 * @subpackage tests
 * @author Laurent Jouanneau <jouanneau@netcourrier.com>
 * @copyright 2003-2006 Laurent Jouanneau
 */

require_once('../../tags/release_2.0.6/WikiRenderer.lib.php');
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

header('ContentType: text/plain');
echo "time=".(intval(($stop - $start)*1000) / 1000);


?>
