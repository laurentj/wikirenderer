<?php
require('header.inc.php');
?>

<h2>Qu'est-ce WikiRenderer ?</h2>

<p>WikiRenderer est une classe PHP permettant de transformer un texte wiki, en un texte formaté en XHTML.</p>
<p>Vous pouvez la tester <a href="demo.php">sur la page de démonstration</a></p>
<p>WikiRenderer est distribué sous <a href="http://www.gnu.org/licenses/licenses.html#LGPL">licence LGPL</a>.</p>


<h2>Dernière version</h2>
<dl>
<dt>En test</dt>
<dd><strong>3.0beta</strong>, pour php4 et pour php5 (28/09/2006)</dd>
<dt>Stable</dt>
<dd><strong>2.0.6</strong> pour php4, (26/09/2004).</dd>
</dl>
<p>Wikirenderer est <a href="https://developer.berlios.de/project/showfiles.php?group_id=5378">disponible en téléchargement</a></p>


<h2 id="caracteristiques">Caractéristiques</h2>
<h3>Caractéristiques</h3>
<p> Contrairement à certains moteurs wiki, WikiRenderer génère du code xhtml valide
en toute circonstance, et ceci, même si il y a des erreurs dans le balisage wiki. Par exemple, si on ecrit
un "chevauchement" de balises wiki comme ceci, <code>ceci est __un exemple
de ''code wiki__ invalide''</code>, cela produira tout de même du code xhtml valide.</p>
<p>Il est bien sûr possible, grâce à une propriété de la classe WikiRenderer,
 de savoir si il y a eu des erreurs, pour en informer l'utilisateur.</p>

<h3>Autres caractéristiques</h3>
<ul>
    <li>Balisage wiki entièrement paramètrable</li>
    <li>Format généré entièrement paramétrable : on peut générer autre chose que du XHTML</li>
    <li>Indication des lignes où il y a des erreurs de balisages wiki</li>
    <li>Possibilité de ne pas interpreter des balises wiki grâce au caractère d'échappement <code>\</code>
    (modifiable)  devant chaque balise wiki.</li>
    <li>Détection incluse des mots wiki type <em>CamelCase</em> (activable en indiquant une fonction de callback)</li>
    <li>Architecture du moteur 100% objet</li>
</ul>

<h2 id="references">Les utilisateurs de WikiRenderer</h2>
<p>Vous utilisez wikirenderer dans votre site ? Dans un projet (CMS, wiki ou autre) ?
 Vous avez adapté la conf pour une syntaxe wiki d'un outils existant ?
 Faites le moi savoir ( jouanneau chez netcourrier point com), envoyez si vous le souhaitez
 votre fichier de conf et je completerais la liste ci-dessous ;-)</p>

<p>WikiRenderer est utilisé&nbsp;:</p>
<ul>
   <li>Dans le CMS php <strong><a href="http://pxsystem.sourceforge.net/">Plume CMS</a></strong></li>
   <li>Dans le wiki <strong><a href="http://chuwiki.berlios.de/">chuWiki</a></strong></li>

   <li>Sur le site <a href="http://www.nosica.net/">www.nosica.net</a></li>
   <li>Dans le CMS des sites gouvernementaux <a href="http://premar-atlantique.gouv.fr/mentionslegales/">premar-atlantique.gouv.fr</a>
   et <a href="http://premar-mediterranee.gouv.fr/mentionslegales/">premar-mediterranee.gouv.fr</a>.</li>
   <li>Dans le framework <a href="http://www.copix.org">Copix 2.2</a></li>
   <li>Dans le CMS du site du <a href="http://web.utk.edu/~ihouse/">Campus de l'université du Tenessis</a></li>
   <li>Utilisé dans le site <a href="http://www.piregwan.com">www.piregwan.com</a></li>
   <li>Dans le CMS Beryo utilisé sur le site <a href="http://www.xrousse.org/">www.xrousse.org</a></li>


   <li>Sur le site <a href="http://www.rocknrollswing.com">www.rocknrollswing.com</a></li>
   <li>Dans un petit CMS utilisé pour les sites
   <a href="http://www.recyclagesolidaire.org">www.recyclagesolidaire.org</a>,
   <a href="http://www.salonhumanitaire.org"> www.salonhumanitaire.org</a>,
   <a href="http://www.createliers.com">www.createliers.com</a>,
   <a href="http://www.collectif-asah.org">www.collectif-asah.org</a>.</li>

</ul>

<h2 id="contact">Contact</h2>
<p>WikiRenderer est réalisé par Laurent Jouanneau : jouanneau chez netcourrier point com.
(site : <a href="http://ljouanneau.com">ljouanneau.com</a>).</p>



<?php

require('footer.inc.php');
?>
