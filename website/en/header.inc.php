<?php
$lang = 'en';

?>

<!DOCTYPE html>
<html lang="<?php echo $lang;?>">
<head>
   <title>WikiRenderer</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="author" content="Laurent Jouanneau" />

    <meta name="description" content="WikiRenderer, parser for wiki content, and converter wiki to any other syntax" />
    <meta name="keywords" content="wikirenderer php converter wiki syntax docbook dokuwiki phpwiki standards w3c html xhtml" />
    <link rel="stylesheet" href="/wr.css" media="all" type="text/css" />
</head>
<body>
<div id="entete">
    <h1>WikiRenderer</h1>
        <p id="lang"><a href="/fr/">français</a></p>

   <ul>
      <li><a href="/en/index.php">Home</a></li>
<?php if(isset($path_link)){

   foreach($path_link as $lib=>$link)
      echo '<li><a href="',$link,'">',$lib,'</a></li>';
}
?>

   </ul>
</div>
<div id="contenu">