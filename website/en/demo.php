<?php
require('../inc.demo.php');

?>

<h2>Test Wikirenderer <?php echo WIKIRENDERER_VERSION; ?></h2>
<p>You can test WikiRenderer: write your wiki text in the field, select the
corresponding wiki syntax, and validate. You will see the transformation.</p>

<form action="demo.php#resultats" method="POST" id="test" name="test">
<fieldset><legend>Test</legend>
<label>Your wiki text:
<textarea style="border:1px solid;" name="texte" cols="50" rows="20"><?php echo htmlspecialchars($texte)?></textarea></label>
<br />
<label>Rule:
<?php showRuleList() ?>
</label>
<input type="button" value="edit an example" onclick="exemple()" />
<br />
<input type="submit" value="Validate" />
</fieldset>
</form>

<?php
if($texte!=''){

    $ctr=new WikiRenderer($rule);
    echo '<h2 id="resultats">Result source:</h2>';

    $texte=$ctr->render($texte);
    if($ctr->errors){
        echo '<p style="color:red;"> ';
        if(count($ctr->errors)>1)
           echo 'There are some wiki syntax errors at lines: ',implode(',',array_keys($ctr->errors)),'</p>' ;
        else{
           list($num,$l)=each($ctr->errors);
           echo 'There is a wiki syntax error at line', $num,'</p>';
       }
    }

   $texte2=htmlspecialchars($texte);
   echo '<pre style="overflow:auto">';
   echo $texte2;
   echo '</pre>',"\n\n";

}

require('footer.inc.php');

