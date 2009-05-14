<html>
<html><head><title>plop</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

</style>
</head>
<body>
<?php
define('WR_DIR',realpath(dirname(__FILE__).'/wikirenderer/').'/');
require_once('wikirenderer/WikiRenderer.lib.php');

require_once(WR_DIR.'rules/dokuwiki_to_xhtml.php');

$wr = new WikiRenderer(new dokuwiki_to_xhtml());

$sourceFile = 'datasblocks/pw_dk_1.res';
$source = file_get_contents($sourceFile);
echo $wr->render($source);

?>
</body>
</html>