<?php
require(__DIR__.'/../vendor/autoload.php');

$texte='';

if(isset($_POST['texte'])){
    $texte=$_POST['texte'];
}

// choose a generator
$genConfig = new \WikiRenderer\Generator\Html\Config();
$generator = new \WikiRenderer\Generator\Html\Document($genConfig);

// choose a parser
$markupConfig = new \WikiRenderer\Markup\ClassicWR\Config();

// instanciate the renderer
$wr = new \WikiRenderer\Renderer($generator, $markupConfig);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>WikiRenderer</title>
   <link rel="stylesheet" href="exemple.css" media="all" type="text/css" />
</head>
<body>

<script type="text/javascript">
<!--
function example(){
   document.test.texte.value="!!! titre\n!! sous-titre\n! sous-sous-titre\n\nLorem __ipsum dolor__ sit amet, ''consectetuer adipiscing'' elit. Ut scelerisque. Ut iaculis ultrices nulla. Cras viverra diam nec justo.\n\n* Phasellus non eros sit amet sem tristique laoreet. \n*# Nam mi wisi, pellentesque dictum, \n*# tristique in, tristique quis, erat. \n*## In in erat ut urna vulputate vestibulum. Aenean justo. \n*## In quis nisl. \n* Morbi justo libero, pharetra a, \n* malesuada eget, lacinia in, ligula.\n\nMauris [sit amet massa|http://ljouanneau.com|fr|at neque] pretium dapibus.\n\n| Nulla metus felis | tristique non\n| 1 | 2\n| 5 | 7\n\ncursus et, @@vulputate in@@, eros. \n Phasellus ??placerat|semper neque??.\n In hac habitasse platea dictumst. \n\nFusce sagittis, mi eu elementum lobortis, augue enim tristique ante, sed varius urna mauris sed erat.\n====\nPraesent pellentesque, ^^augue at| consectetuer imperdiet^^, mi metus {{dignissim arcu}}, sed sodales quam risus eu neque. \n\nPellentesque euismod. \n> Curabitur mi. Aenean vitae lectus vel turpis feugiat egestas. \n> Quisque diam. Maecenas tincidunt tortor sed neque. \n\nMauris nibh. Vivamus tempus est in urna. \n\n;Curabitur et arcu : non odio gravida varius. Vivamus fringilla, neque ac suscipit vehicula, libero metus laoreet libero, in gravida purus nunc quis orci. \n;Duis : non mi non lacus tincidunt iaculis. \n;Aliquam tempor : metus in cursus dapibus, purus ipsum consequat quam, et vehicula libero velit sit amet felis. Sed id leo. \n\nVivamus orci leo, dictum et, scelerisque sed, pretium et, dolor. Aenean pharetra felis pellentesque dui. Donec neque. Duis tristique. Pellentesque at eros";
}
//-->
</script>

<h2>Test Wikirenderer <?php echo $ctr->getVersion() ?></h2>
<form action="exemple.php#resultats" method="POST" id="test" name="test">
<fieldset><legend>Write some wiki text</legend>
<label>text :
<textarea style="border:1px solid;" name="texte" cols="50" rows="20"><?php echo htmlspecialchars($texte, ENT_COMPAT | ENT_HTML401, "UTF-8");?></textarea></label>
<br />
<input type="button" value="Edit an example" onclick="example()" />
<input type="submit" value="Validate and see HTML convertion" />
</fieldset>
</form>
<h2>Help</h2>
<h3>Blocs:</h3>
<ul class="aide">
<li>Paragraph: an empty line before</li>
<li>Separator: <code>====</code> + line return</li>
<li>List: each item should begin with <code>*</code> or  <code>-</code> or <code>#</code></li>
<li>Table: <span><code>|</code>text<code>|</code>text</span>  ( <code>|</code> = column separator, each line is a row)</li>
<li>title level 1: <span><code>!!!</code>title</span>  + line return</li>
<li>title level 2: <span><code>!!</code>title</span>  + line return</li>
<li>title level 3: <span><code>!</code>title</span>  + line return</li>
<li>preformated: at least one space should start each line</li>
<li>blockquote:  one or more <code>&gt;</code> should start each line</li>
<li>Définitions : <span><code>;</code>term<code>:</code>definition</span> + line return</li>
</ul>

<h3>inline:</h3>
<ul class="aide">
<li>strong bold   : <span><code>__</code>texte<code>__</code></span> (2 underscores)</li>
<li>bold : <span><code>''</code>texte<code>''</code></span> (deux apostrophes)</li>
<li>Return line in a paragraph: <code>%%%</code> </li>
<li>Link    : <span><code>[</code>link name<code>|</code>link<code>|</code>lang<code>|</code>description (title)<code>]</code></span> </li>
<li>image : <span><code>((</code>image url<code>|</code>text<code>|</code>position<code>|</code>long description<code>))</code></span>  position = G (align to left) or D (align to right)</li>
<li>code            : <span><code>@@</code>code<code>@@</code></span></li>
<li>citation         : <span><code>^^</code>sentence<code>|</code>source link<code>^^</code></span></li>
<li>reference      : <span><code>{{</code>reference<code>}}</code></span></li>
<li>acronym         : <span><code>??</code>acronym<code>|</code>definition<code>??</code></span></li>
<li>anchor : <span><code>~~</code>myanchor</span><code>~~</code></li>
</ul>


<?php
if($texte!=''){

   echo '<h2 id="resultats">Source of the result:</h2>';

   $texte=$ctr->render($texte);
   if($ctr->errors){
      echo '<p style="color:red;"> ';
      if(count($ctr->errors)>1) {
         echo 'There are some wiki errors at lines: ',implode(',',array_keys($ctr->errors)),'</p>' ;
      }
      else {
         list($num,$l)=each($ctr->errors);
         echo 'There is a wiki error at line ', $num,'</p>';
     }
   }

   $texte2=htmlspecialchars($texte);
   echo '<pre style="overflow:auto">';
   echo $texte2;
   echo '</pre>';
    echo '<h2>Result:</h2>';
    echo $texte;

}

?>

</body>
</html>
