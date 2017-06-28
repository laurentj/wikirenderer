<?php
$path_link=array('FAQ'=>'faq.php');
require('header.inc.php');
?>

<h2>Foire Aux Questions</h2>

<dl>
   <dt id="echappement">Je ne veux pas que des caractères correspondants à des tags
   wiki soient interprétés, comment faire ?</dt>
   <dd>Mettre un anti-slash devant le caractère. <br />
   Exemple : <code>\[ exemple \]</code> ne sera pas interprété comme
   étant un lien.</dd>
</dl>


<?php

require('footer.inc.php');
?>








