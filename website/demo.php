<?php
require('../php4/WikiRenderer.lib.php');
require('../php4/rules/classicwr_to_text.php');
require('../php4/rules/classicwr_to_xhtml.php');

$texte='';

if(isset($_POST['texte'])){
   if(get_magic_quotes_gpc())
      $texte=stripslashes($_POST['texte']);
   else
      $texte=$_POST['texte'];
}

$path_link=array('démo'=>'demo.php');
require('header.inc.php');
?>

<script type="text/javascript">

function exemple(){
   texte="!!! titre\n!! sous-titre\n! sous-sous-titre\n\nLorem __ipsum dolor__ sit amet, ''consectetuer adipiscing'' elit. Ut scelerisque. Ut iaculis ultrices nulla. Cras viverra diam nec justo.\n\n";
   texte=texte+"* Phasellus non eros sit amet sem tristique laoreet. \n*# Nam mi wisi, pellentesque dictum, \n*# tristique in, tristique quis, erat. \n*## In in erat ut urna vulputate vestibulum. Aenean justo. \n*## In quis nisl. \n* Morbi justo libero, pharetra a, \n* malesuada eget, lacinia in, ligula.\n\n";
   texte=texte+"Mauris [sit amet massa|http://ljouanneau.com|fr|at neque] pretium dapibus.\n\n| Nulla metus felis | tristique non\n| 1 | 2\n| 5 | 7\n\ncursus et, @@vulputate in@@, eros. \n Phasellus ??placerat|semper neque??.\n";
   texte=texte+" In hac habitasse platea dictumst. \n\nFusce sagittis, mi eu elementum lobortis, augue enim tristique ante, sed varius urna mauris sed erat.\n====\nPraesent pellentesque, ^^augue at| consectetuer imperdiet^^, mi metus {{dignissim arcu}}, sed sodales quam risus eu neque. \n\nPellentesque euismod. \n";
   texte=texte+"> Curabitur mi. Aenean vitae lectus vel turpis feugiat egestas. \n> Quisque diam. Maecenas tincidunt tortor sed neque. \n\nMauris nibh. Vivamus tempus est in urna. \n\n"
   texte=texte+";Curabitur et arcu : non odio gravida varius. Vivamus fringilla, neque ac suscipit vehicula, libero metus laoreet libero, in gravida purus nunc quis orci. \n;Duis : non mi non lacus tincidunt iaculis. \n;Aliquam tempor : metus in cursus dapibus, purus ipsum consequat quam, et vehicula libero velit sit amet felis. Sed id leo. \n\n";
   texte=texte+"Vivamus orci leo, dictum et, <b>scelerisque sed</b>, <i>pretium et</i>, dolor. Aenean pharetra felis pellentesque dui. Donec neque. Duis tristique. Pellentesque at eros\n\n";
   texte=texte+"Lorem ipsum | dolor \\| sit\\\\ amet \n\n";
   texte=texte+"Pater \\[noster qui|est|in] @@caelis@@... \n";
   document.test.texte.value=texte;
}

</script>


<h2>Testez Wikirenderer <?php echo WIKIRENDERER_VERSION; ?></h2>
<p>Vous pouvez tester le moteur de WikiRenderer : saisissez votre texte wiki, validez, et
celui-ci sera transformé. Ici, deux types de transformations vous sont proposés,
XHTML et texte brut (les balises wikis sont retirées et le texte reformaté). Elles
montrent le caractère <em>configurable</em> du moteur, qui ne se limite donc
pas à la transformation en XHTML.</p>

<form action="demo.php#resultats" method="POST" id="test" name="test">
<fieldset><legend>Saisissez un texte wiki</legend>
<label>texte :
<textarea style="border:1px solid;" name="texte" cols="50" rows="20"><?echo $texte?></textarea></label>
<br />Transformation en :
<label for="transfohtml"><input type="radio" name="transfo" id="transfohtml" value="xhtml" checked="checked" />XHTML</label>
<label for="transfotext"><input type="radio" name="transfo" id="transfotext" value="txt"  />Texte sans balise wiki</label>
<br />
<input type="button" value="editer un exemple" onclick="exemple()" />
<input type="submit" value="Valider et voir la transformation" />
</fieldset>
</form>
<h2>Aide</h2>
<h3>signes de formatage de types bloc&nbsp;:</h3>
<ul class="aide">
<li>Paragraphe       : 2 sauts de lignes</li>
<li>Trait HR          : <code>====</code> (4 signes "égale" ou plus) + saut de ligne</li>
<li>Liste             : une ou plusieurs <code>*</code> ou  <code>-</code> (liste simple) ou <code>#</code> (liste numérotée) par item + saut de ligne</li>
<li>Tableaux          : <code>| texte | texte</code>. <code>|</code> <strong>encadré par des espaces</strong>
                    (sauf pour le premier)    = caractere séparateur de colonne, chaque ligne écrite =
                     une ligne de tableau</li>
<li>sous titre niveau 1 : <code>!!!</code>titre + saut de ligne</li>
<li>sous titre niveau 2 : <code>!!</code>titre + saut de ligne</li>
<li>sous titre niveau 3 : <code>!</code>titre + saut de ligne</li>
<li>texte préformaté :  un espace + texte + saut de ligne</li>
<li>citation (blockquote) :  un ou plusieurs <code>&gt;</code> + texte + saut de ligne</li>
<li>Définitions : <code>;</code>terme<code> : </code>définition + saut de ligne
(le <code>:</code> doit être <strong>encadré par des espaces</strong>)</li>
</ul>

<h3>signes de formatage de type inline:</h3>
<ul class="aide">
<li>emphase forte (gras)   : <span><code>__</code>texte<code>__</code></span> (2 underscores)</li>
<li>emphase simple (italique) : <span><code>''</code>texte<code>''</code></span> (deux apostrophes)</li>
<li>Retour à la ligne forcée    : <code>%%%</code> </li>
<li>Lien    : <span><code>[</code>nomdulien<code>|</code>lien<code>|</code>langue<code>|</code>déscription (title)<code>]</code></span> </li>
<li>images : <span><code>((</code>url image<code>|</code>texte alternatif<code>|</code>position<code>|</code>longue description<code>))</code></span>  position = G, D ( aligné à Gauche, Droite) ou rien (en ligne)</li>
<li>code            : <span><code>@@</code>code<code>@@</code></span></li>
<li>citation         : <span><code>^^</code>phrase<code>|</code>langue<code>|</code>lien source<code>^^</code></span></li>
<li>reférence (cite)      : <span><code>{{</code>reference<code>}}</code></span></li>
<li>acronym         : <span><code>??</code>acronyme<code>|</code>signification<code>??</code></span></li>
<li>ancre : <span><code>~~</code>monancre</span><code>~~</code></li>
</ul>
<h3>Autres</h3>
<ul>
<li>Pour éviter l'interpretation d'une balise wiki, mettre un \ devant la balise.</li>
<li>Pour afficher le caractère \, doublez-le ( \\ )</li>
</ul>


<?
if($texte!=''){

   if($_POST['transfo'] == 'txt'){
      $config=new classicwr_to_text();
   }else{
      $config=new classicwr_to_xhtml();
   }

   $ctr=new WikiRenderer($config);
   echo '<h2 id="resultats">Source du resultat:</h2>';

   $texte=$ctr->render($texte);
   if($ctr->errors){
      echo '<p style="color:red;">Il y a ';
      if(count($ctr->errors)>1)
         echo 'des erreurs wiki aux lignes : ',implode(',',array_keys($ctr->errors)),'</p>' ;
      else{
         list($num,$l)=each($ctr->errors);
         echo 'une erreur wiki à la ligne ', $num,'</p>';
     }
   }

   $texte2=htmlspecialchars($texte);
   echo '<pre style="overflow:auto">';
   echo $texte2;
   echo '</pre>',"\n\n<hr />";
    echo '<h2>Résultat:</h2>',"\n";
    echo $texte;


}

require('footer.inc.php');
?>
