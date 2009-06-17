<?php
$path_link=array('documentation'=>'documentation.php');
require('header.inc.php');
?>

<h2>Utilisation de Wikirenderer 3.1</h2>
<p style="font-style:italic">Dernière mise à jour le 20/06/2009</p>

<h3>Utilisation simple</h3>
<pre><code> include('WikiRenderer.lib.php');
 $wkr = new WikiRenderer();
 $monTexteXHTML = $wkr->render($monTexteWiki);
</code></pre>

<p>Par défaut, cela utilise la règle wr3_to_xhtml. Si vous voulez utilisez d'autres règles :</p>

<pre><code> include('WikiRenderer.lib.php');
  include('rules/dokuwiki_to_xhtml.php');

  $wkr = new WikiRenderer('dokuwiki_to_xhtml');
  $monTexteXHTML = $wkr->render($monTexteWiki);
</code></pre>

<p>Ou si vous voulez changer des choses dans la configuration  de la règle utilisée :</p>

<pre><code> include('WikiRenderer.lib.php');
  include('rules/classicwr_to_xhtml.php');
  $config = new classicwr_to_xhtml();

  $config->simpletags = array('%%%'=>'<br />',
        ':-)'=>'&lt;img src="laugh.png" alt=":-)" /&gt;',
        ':-('=>'&lt;img src="sad.png" alt=":-(" /&gt;'
        );

  $wkr = new WikiRenderer($config);
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
   echo implode(',',array_keys($wkr->errors)),'&lt;/p>' ;
}
</code></pre>

<p>La propriété <code>errors</code> est un tableau d'élements dont la clé
est un numéro de ligne, et la valeur le contenu de la ligne en question. On peut
donc si on le désire, afficher aussi les lignes en erreur.</p>
<p>WikiRenderer ne s'arrete pas à la première erreur rencontrée. Les tags wiki qui
posent problèmes ne sont pas interpretés, ni enlevés dans le texte résultat.</p>

<h3>Les paramètres de configuration</h3>
<p>Ils sont situés dans un objet, héritant de la classe WikiRendererConfig,
et qui doit avoir les propriétés suivantes : </p>

<dl>
<dt><code>inlinetags</code></dt>
<dd>liste des noms des classes qui prennent en charge les
 tags wiki que l'on peut utiliser à l'intérieur les phrases (tags "inlines"). Voir
<a href="documentation_dev.php">la partie configuration avançée</a>.
</dd>
<dt><code>bloctags</code></dt>
<dd>Liste des noms de classes des tags de type blocs. Voir
<a href="documentation_avancee.php">la partie configuration avançée</a>.</dd>
<dt><code>simpletags</code></dt>
<dd>tags simples pour lesquels il y a juste un remplacement à faire. C'est donc un tableau PHP
d'élements <code>'chaine à remplacer'=>'chaine remplacante'</code>.</dd>
<dt><code>checkWikiWordFunction</code></dt>
<dd>Indique le nom de la fonction qui sera appelée lorsque WikiRenderer détectera
des mots wiki en "CamelCase". (laissez à null si vous ne voulez pas ce genre de détéction).
Cette fonction devra récupérer en paramètre une liste de mots wiki, et devra
renvoyé une liste des chaines qui remplaceront les mots wiki indiqués.
Cette fonction est à implémenter par vous-même selon votre application. Voir
<a href="documentation_dev.php">la partie configuration avançée</a>.</dd>

</dl>

<h2>Autre documentations</h2>

<ul>
    <li><a href="documentation_rules.php">Liste des règles</a> fournies par WikiRenderer.</li>
    <li><a href="documentation_dev.php">Développement de règles</a>.</li>
</ul>


<?php

require('footer.inc.php');
?>








