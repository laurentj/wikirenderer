<?php
require(__DIR__.'/header.inc.php');
?>

<h2>Qu'est-ce WikiRenderer ?</h2>

<p>WikiRenderer est un composant PHP permettant de transformer un contenu wiki
en un texte formaté en XHTML ou tout autre format, et même une autre syntaxe wiki.
Vous pouvez l'intégrer dans votre CMS, votre wiki, votre forum, pour transformer
et afficher du contenu wiki, mais aussi pour migrer du contenu wiki
d'un CMS à un autre, quand ils utilisent chacun d'eux une
syntaxe différente.</p>

<p>Vous pouvez tester Wikirenderer <a href="/fr/demo.php">sur la page de démonstration</a></p>
<p>WikiRenderer est distribué sous
<a href="http://www.gnu.org/licenses/licenses.html#LGPL">licence LGPL</a>.</p>


<h2>Dernière version</h2>
<dl>
<dt>Stable</dt>
<dd><strong>3.1.9</strong>, pour PHP 5.6+ (2023-02-07)</dd>
</dl>
<p>Wikirenderer est
<a href="https://download.jelix.org/wikirenderer/">disponible
    en téléchargement</a>. Vous pouvez aussi l'installer avec Composer :</p>
<pre>
    <code>composer require jelix/wikirenderer</code>
</pre>

<p>Voir <a href="/fr/historique.php#v3.1.9">la liste des changements</a> pour cette version.</p>

<h2 id="caracteristiques">Caractéristiques</h2>
<h3>Caractéristiques</h3>

<p>Contrairement à certains moteurs wiki, WikiRenderer génère du contenu valide
en toute circonstance, même si il y a des erreurs dans le balisage wiki. Par exemple,
si on ecrit un "chevauchement" de balises wiki comme ceci, <code>ceci est __un exemple
de ''code wiki__ invalide''</code>, cela produira tout de même du code xhtml valide.</p>

<p>Wikirenderer est hautement configurable, bien qu'il peut être nécessaire
de développer des classes PHP pour supporter des syntaxes wiki ou des formats de
sorties non supporter par WikiRenderer. Ainsi, pour faire une transformation
d'un format donné vers un autre, WikiRenderer utilise un ensemble de classe qui implémente
la prise en charge de cette transformation. Un ensemble de classes dédiés à un
format spécifique est appelé une "règle" ("rule").
</p>


<ul>
    <li>Wikirenderer fournis ces règles:
      <ul>
       <li>syntax wr3 vers XHTML (wr3 est une syntaxe spécifique à WikiRenderer)</li>
       <li>syntax wr3 vers texte </li>
       <li>syntax wr3 vers Docbook</li>
       <li>syntax dokuwiki vers XHTML</li>
       <li>syntax dokuwiki vers Docbook</li>
       <li>syntax jwiki vers XHTML</li>
       <li>syntax phpwiki vers syntax dokuwiki</li>
       <li>syntax trac vers XHTML</li>
       <li>et d'autres...</li>
      </ul>
    </li>
    <li>Vous pouvez développer vos propres règles, en les créant entièrement ou en
    se basant sur d'autres règles.</li>
    <li>Une règle peut être configurée via une classe spécifique. Vous pouvez par exemple
    indiquer des fonctions de callbacks pour effectuer des traitements additionnels
    sur le texte avant et après transformations, spécifiques à votre contexte.
    </li>
    <li>Le moteur de WikiRenderer supporte des syntaxes wiki complexes comme:
      <ul>
       <li>notes de bas de page</li>
       <li>liens CamelCase</li>
       <li>Echappement de tag wiki pour les ignorer</li>
       <li>tableaux, définitions etc.</li>
      </ul>
    </li>
    <li>WikiRenderer peut indiquer les erreurs de syntaxes wiki qu'il trouve.</li>
</ul>

<h2 id="references">Les utilisateurs de WikiRenderer</h2>
<p>Vous utilisez wikirenderer dans votre site ? Dans un projet (CMS, wiki ou autre) ?
 Faites-le-moi savoir et je complèterai la liste ci-dessous ;-).
Si vous avez créé des nouvelles règles et que vous aimeriez les avoirs dans la
distribution officielle de WikiRenderer, envoyez-moi le fichier.</p>

<h2 id="contact">Contact</h2>
<p>WikiRenderer est réalisé par Laurent Jouanneau : dev@ljouanneau.com.
(site : <a href="http://ljouanneau.com">ljouanneau.com</a>).</p>

<?php
require(__DIR__.'/footer.inc.php');
?>