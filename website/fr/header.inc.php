<?php
$lang = 'fr';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr" xml:lang="fr">
<head>
   <title>WikiRenderer</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="author" content="Laurent Jouanneau" />

    <meta name="description" content="WikiRenderer, convertisseur texte wiki en XHTML et autre format" />
    <meta name="keywords" content="wikirenderer php convertisseur analyseur wiki standards w3c html xhtml" />
    <link rel="stylesheet" href="/wr.css" media="all" type="text/css" />
</head>
<body>
<div id="entete">
    <h1>WikiRenderer</h1>
    <p id="lang"><a href="/en/">english</a></p>
   <ul>
      <li><a href="/fr/index.php">Accueil</a></li>
<?php if(isset($path_link)){

   foreach($path_link as $lib=>$link)
      echo '<li><a href="',$link,'">',$lib,'</a></li>';
}
?>

   </ul>
</div>
<div id="contenu">