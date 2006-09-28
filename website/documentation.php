<?php
$path_link=array('documentation'=>'documentation.php');
require('header.inc.php');
?>

<h2>Utilisation de Wikirenderer 3.0</h2>
<p style="font-style:italic">Dernière mise à jour le 29/09/2006</p>
<h3>utilisation simple</h3>
<pre><code> include('WikiRenderer.lib.php');
 $wkr = new WikiRenderer();
 $monTexteXHTML = $wkr->render($monTexteWiki);
</code></pre>

<p>Par défaut, cela utilise les rêgles classicwr_to_xhtml. si vous voulez utilisez d'autres rêgles :</p>

<pre><code> include('WikiRenderer.lib.php');
  include('rules/classicwr_to_text.php');

 $config = new ConfigClassicwrToText();

 $wkr = new WikiRenderer(<strong>$config</strong>);
 $monTexteXHTML = $wkr->render($monTexteWiki);
</code></pre>

<h3>Connaître les erreurs</h3>
<p>Il est possible de savoir si lors de la transformation, WikiRenderer a rencontré
des erreurs (balises wikis malformée, imbriquée...). Il suffit, aprés la
transformation, de regarder le contenu de la propriété <code>errors</code>. Exemple :</p>
<pre><code>include('WikiRenderer.lib.php');
$wkr = new WikiRenderer();
$monTexteXHTML = $wkr->render($monTexteWiki);

if($wkr->errors){
   echo '&lt;p style="color:red;">Il y a des erreurs wiki aux lignes : ';
   echo implode(',',array_keys($wkr->errors)),'&lt/p>' ;
}
</code></pre>
<p>La propriété <code>errors</code> est un tableau d'élements dont la clé
est un numéro de ligne, et la valeur le contenu de la ligne en question. On peut
donc si on le désire, afficher aussi les lignes en erreur.</p>
<p>WikiRenderer ne s'arrete pas à la première erreur rencontrée. Les tags wiki qui
posent problèmes ne sont pas interpretés, ni enlevés dans le texte résultat.</p>

<h3>Les paramètres de configuration</h3>
<p>Ils sont situés dans un objet qui doit avoir les propriétés suivantes : </p>

<dl>
<dt><code>inlinetags</code></dt>
<dd>liste des noms des classes qui prennent en charge les
 tags wiki que l'on peut utiliser à l'intérieur les phrases (tags "inlines"). Voir
<a href="documentation_avancee.php">la partie configuration avançée</a>.
</dd>
<dt><code>textLineContainer</code></dt>
<dd>nom de la classe qui prend en charge le reste du texte à l'intérieur des phrases. En général,
vous n'avez pas à changer ça.
</dd>
<dt><code>bloctags</code></dt>
<dd>liste des noms de classes des tags de type blocs. Voir
<a href="documentation_avancee.php">la partie configuration avançée</a>.</dd>
<dt><code>simpletags</code></dt>
<dd>tags simples pour lesquels il y a juste un remplacement à faire. C'est donc un tableau PHP
d'élements 'chaine à remplacer'=>'chaine remplacante'.</dd>
<dt><code>checkWikiWordFunction</code></dt>
<dd>Indique le nom de la fonction qui sera appelée si la détection des mots wiki "CamelCase" est activée.
Cette fonction devra récupérer en paramètre une liste de mots wiki, et devra
renvoyé une liste des chaines qui remplaceront les mots wiki indiqués.
Cette fonction est à implémenter par vous-même selon votre application. Voir
<a href="documentation_avancee.php">la partie configuration avançée</a>.</dd>
</dl>

<h3>Les tags wiki des rules "classicwr"</h3>

<h4>de types bloc :</h4>
<ul>
<li>Paragraphe       : 2 sauts de lignes</li>
<li>Trait HR          : <code>====</code> (4 signes "égale" ou plus) + saut de ligne</li>
<li>Liste             : une ou plusieurs <code>*</code> ou  <code>-</code> (liste simple) ou
                        <code>#</code> (liste numérotée) par item + saut de ligne</li>
<li>Tableaux          : <code>| texte | texte</code>. <code>|</code> <strong>encadré par des espaces</strong>
(sauf pour le premier)     = caractere séparateur de colonne, chaque ligne écrite =
                     une ligne de tableau</li>
<li>sous titre niveau 1 : <code>!!!</code>titre + saut de ligne</li>
<li>sous titre niveau 2 : <code>!!</code>titre + saut de ligne</li>
<li>sous titre niveau 3 : <code>!</code>titre + saut de ligne</li>
<li>texte préformaté :  un espace + texte + saut de ligne</li>
<li>citation (blockquote) :  un ou plusieurs <code>&gt;</code> + texte + saut de ligne</li>
<li>Définitions : <code>;</code>terme<code> : </code>définition + saut de ligne
(le <code>:</code> doit être <strong>encadré par des espaces</strong>)</li>
</ul>

<h4>de type inline :</h4>
<ul>
<li>emphase forte (gras)   : <code>__</code>texte<code>__</code> (2 underscores)</li>
<li>emphase simple (italique) : <code>''</code>texte<code>''</code> (deux apostrophes)</li>
<li>Retour à la ligne forcée    : <code>%%%</code></li>
<li>Lien    : <code>[</code> nomdulien <code>|</code> lien <code>|</code> langue <code>|</code> déscription (title)<code>]</code></li>
<li>Image    : <code>((</code> lien vers l'image <code>|</code> textalternatif
             <code>|</code> position <code>|</code> longue déscription <code>))</code> .
               valeurs de position : l/L/g/G => gauche, r/R/d/D =>droite,
               rien : en ligne. Dans le code généré, c'est une balise style qui est crée, et non un attribut align (obsolète).</li>
<li>code            : <code>@@</code>code<code>@@</code></li>
<li>citation         : <code>^^</code>phrase<code>|</code>langue<code>|</code>lien source<code>^^</code></li>
<li>reférence (cite)      : <code>{{</code>reference<code>}}</code></li>
<li>acronym         : <code>??</code>acronyme<code>|</code>signification<code>??</code></li>
<li>ancre : <code>~~</code>monancre<code>~~</code></li>
</ul>

<h4>Note</h4>
<p>Dans un texte wiki "classicwr", on peut désactiver l'interpretation d'un tag wiki
en mettant un antislash devant la balise d'ouverture (et de fermeture
pour les tags en lignes). Exemple : <code>\__emphase\__</code>.</p>


<?php

require('footer.inc.php');
?>








