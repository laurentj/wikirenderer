<?php
/**
* @package     wikirenderer
* @author      Laurent Jouanneau
* @contributor
* @copyright   2008 Laurent Jouanneau
* @licence     GNU General Public Licence see LICENCE file or http://www.gnu.org/licenses/gpl.html
*/
$BUILD_OPTIONS = array(
'MAIN_TARGET_PATH'=> array(
    "main directory where sources will be copied",  // signification (false = option cachée)
    '_dist',                                        // valeur par défaut (boolean = option booleene)
    '',                                             // regexp pour la valeur ou vide=tout (seulement pour option non booleene)
    ), 
'BASE_PATH'=> array(
    "the directory from which source will be copied",  // signification (false = option cachée)
    'src/',                                        // valeur par défaut (boolean = option booleene)
    '',
    ), 
'PACKAGE_TAR_GZ'=>array(
    "create a tar.gz package",
    false,
    ),
'PACKAGE_ZIP'=>array(
    "create a zip package",
    false,
    ),
'VERSION'=> array(
    false,
    '',
    ),
'HG_REVISION'=> array(
    false,
    ),
);
include(dirname(__FILE__).'/jbt/lib/jBuild.inc.php');

//----------------- Preparation des variables d'environnement

if ($BASE_PATH == '') 
    die("error: BASE_PATH is empty");

$BASE_PATH = jBuildUtils::normalizeDir($BASE_PATH);

Env::setFromFile('VERSION',$BASE_PATH.'/VERSION', true);
$HG_REVISION = Mercurial::revision(dirname(__FILE__).'/');
$VERSION = trim($VERSION);
$IS_NIGHTLY = (strpos($VERSION,'SERIAL') !== false);

if($IS_NIGHTLY){
    $PACKAGE_NAME='wikirenderer-'.str_replace('SERIAL', '', $VERSION);
    if(substr($PACKAGE_NAME,-1,1) == '.')
      $PACKAGE_NAME = substr($PACKAGE_NAME,0,-1);
    $VERSION = str_replace('SERIAL', $HG_REVISION, $VERSION);
}
else {
    $PACKAGE_NAME='wikirenderer-'.$VERSION;
}

if($PACKAGE_TAR_GZ || $PACKAGE_ZIP ){
    $BUILD_TARGET_PATH = jBuildUtils::normalizeDir($MAIN_TARGET_PATH).$PACKAGE_NAME.'/';
}else{
    $BUILD_TARGET_PATH = jBuildUtils::normalizeDir($MAIN_TARGET_PATH);
}

//----------------- Génération des sources

//... creation des repertoires
jBuildUtils::createDir($BUILD_TARGET_PATH);

//... execution du manifest
jManifest::process($BASE_PATH.'wr.mn', $BASE_PATH, $BUILD_TARGET_PATH, ENV::getAll());

file_put_contents($BUILD_TARGET_PATH.'VERSION', $VERSION);

//... packages

if($PACKAGE_TAR_GZ){
    echo '#'.$MAIN_TARGET_PATH."#\n";
echo 'tar czf '.$MAIN_TARGET_PATH.'/'.$PACKAGE_NAME.'.tar.gz -C '.$MAIN_TARGET_PATH.' '.$PACKAGE_NAME."\n";
    exec('tar czf '.$MAIN_TARGET_PATH.'/'.$PACKAGE_NAME.'.tar.gz -C '.$MAIN_TARGET_PATH.' '.$PACKAGE_NAME);
}

if($PACKAGE_ZIP){
    chdir($MAIN_TARGET_PATH);
    exec('zip -r '.$PACKAGE_NAME.'.zip '.$PACKAGE_NAME);
    chdir(dirname(__FILE__));
}

exit(0);
