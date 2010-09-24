<?php
$path_link=array('documentation'=>'documentation.php', 'règles fournies'=>'documentation_rules.php');
require('header.inc.php');
?>

<h2>Les différentes syntaxes wiki fournies avec WikiRenderer</h2>

<h3>Syntaxe "wr3"</h3>

<h4>de types bloc :</h4>
<ul>
<li>Nouveau paragraphe       : 2 sauts de lignes</li>
<li>Trait HR          : <code>====</code> (4 signes "égale" ou plus) + saut de ligne</li>
<li>Liste             : une ou plusieurs <code>*</code> ou  <code>-</code> (liste simple) ou
                        <code>#</code> (liste numérotée) par item + saut de ligne</li>
<li>Tableaux          : <code>| texte | texte</code>. <code>|</code> <strong>encadré par des espaces</strong>
(sauf pour le premier)     = caractere séparateur de colonne, chaque ligne écrite =
                     une ligne de tableau</li>
<li>sous titre niveau 1 : <code>!!!</code>titre + saut de ligne</li>
<li>sous titre niveau 2 : <code>!!</code>titre + saut de ligne</li>
<li>sous titre niveau 3 : <code>!</code>titre + saut de ligne</li>
<li>texte préformaté :  texte dont la première ligne commence par un <code>&lt;code&gt;</code> et la dernière
  ligne se termine par un <code>&lt;/code&gt;</code></li>
<li>citation (blockquote) :  un ou plusieurs <code>&gt;</code> + texte + saut de ligne</li>
<li>Définitions : <code>;</code>terme<code> : </code>définition + saut de ligne
(le <code>:</code> doit être <strong>encadré par des espaces</strong>)</li>
</ul>

<h4>de type inline :</h4>
<ul>
<li>emphase forte (gras)   : <code>__</code>texte<code>__</code> (2 underscores)</li>
<li>emphase simple (italique) : <code>''</code>texte<code>''</code> (deux apostrophes)</li>
<li>Retour à la ligne forcée    : <code>%%%</code></li>
<li>Lien    : <code>[[</code>nomdulien<code>|</code>lien<code>|</code>langue<code>|</code>déscription (title)<code>]]</code></li>
<li>Image    : <code>((</code>lien vers l'image<code>|</code>textalternatif<code>|</code>position<code>|</code>longue déscription<code>))</code> .
               valeurs de position : l/L/g/G => gauche, r/R/d/D =>droite,
               rien : en ligne. Dans le code généré, c'est une balise style qui est crée, et non un attribut align (obsolète).</li>
<li>code            : <code>@@</code>code<code>@@</code></li>
<li>citation         : <code>^^</code>phrase<code>|</code>langue<code>|</code>lien source<code>^^</code></li>
<li>reférence (cite)      : <code>{{</code>reference<code>}}</code></li>
<li>acronym         : <code>??</code>acronyme<code>|</code>signification<code>??</code></li>
<li>ancre : <code>~~</code>monancre<code>~~</code></li>
<li>Note de bas de page : dans le texte, à l'endroit où vous voulez un renvoi vers le bas de page,
 insérez <code>$$</code>phrase<code>$$</code></li>
</ul>

<h4>Note</h4>
<p>Dans un texte wiki "wr3", on peut désactiver l'interpretation d'un tag wiki
en mettant un antislash devant la balise d'ouverture (et de fermeture
pour les tags en lignes). Exemple : <code>\__emphase\__</code>.</p>




<h3>Syntaxe "classicwr"</h3>

<p>C'est la syntaxe utilisée dans la version 2.0 de WikiRenderer. C'est à peu prés la même que wr3,
à ces différences prés :

<ul>
<li>texte préformaté :  un espace + texte + saut de ligne (et non pas encadré par des
 <code>&lt;code&gt;</code>)</li>
 <li>Pas de note de bas de page.</li>
 <li>Pour les liens, c'est une seule accolade au début et à la fin au lieu de deux.</li>
</ul>


<h3>Syntaxe "dokuwiki"</h3>

<p>Il s'agit de la syntaxe utilisée dans le wiki <a href="">Dokuwiki</a>.</p>
<p>TODO: descriptif de la syntaxe.</p>

<h3>Syntaxe "trac"</h3>

<p>Il s'agit de la syntaxe utilisée dans le gestionnaire de projet <a href="">Trac</a>.</p>
<p>TODO: descriptif de la syntaxe.</p>


<h3>Syntaxe "phpwiki"</h3>

<p>Il s'agit de la syntaxe utilisée dans le wiki <a href="">phpwiki</a>.</p>
<p>Pour le moment, n'est fourni qu'une régle pour transformer du contenu
phpwiki vers dokuwiki, utile donc pour migrer de phpwiki vers dokuwiki.</p>

<p>TODO: descriptif de la syntaxe.</p>


<h2>Autre documentations</h2>

<ul>
    <li><a href="documentation.php">Documentation générale</a>.</li>
    <li><a href="documentation_dev.php">Développement de règles</a>.</li>
</ul>




<?php

require('footer.inc.php');
?>








