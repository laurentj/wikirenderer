<?php
require('../inc.demo.php');

?>

<h2>Testez Wikirenderer <?php echo WIKIRENDERER_VERSION; ?></h2>
<p>Vous pouvez tester le moteur de WikiRenderer : saisissez votre texte wiki, validez, et
celui-ci sera transformé.</p>

<form action="demo.php#resultats" method="POST" id="test" name="test">
<fieldset><legend>Saisissez un texte wiki</legend>
<label>texte :
<textarea style="border:1px solid;" name="texte" cols="50" rows="20"><?php echo htmlspecialchars($texte)?></textarea></label>
<br />
<label>Transformation en :
<?php showRuleList() ?>
</label>
<input type="button" value="editer un exemple" onclick="exemple()" />
<br />
<input type="submit" value="Valider et voir la transformation" />
</fieldset>
</form>

<?php
if($texte!=''){

    $ctr=new WikiRenderer($rule);
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
   echo '</pre>',"\n\n";

}

require('footer.inc.php');

