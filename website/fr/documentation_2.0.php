<?php
$path_link=array('documentation'=>'documentation.php');
require('header.inc.php');
?>

<h2>Utilisation de Wikirenderer 2.0</h2>
<p style="font-style:italic">Dernière mise à jour le 16/05/2004</p>
<h3>Simple</h3>
<pre><code> include('WikiRenderer.lib.php');
 $wkr = new WikiRenderer();
 $monTexteXHTML = $wkr->render($monTexteWiki);
</code></pre>

<h3>Modifier la configuration par défaut</h3>
<p>Il suffit d'instancier l'objet WikiRendererConfig et de modifier ses propriétés :</p>
<pre><code> include('WikiRenderer.lib.php');

 $config = new WikiRendererConfig();

 <span style="text-style:italic">// exemple de désactivation de l'interpretation des balises wiki pour les tableaux</span>
 $config->bloctags['table']=false;

  <span style="text-style:italic">// exemple de désactivation de l'interpretation des balises wiki pour les citations</span>
 unset($config->inlinetags['cite']);

  <span style="text-style:italic">// ajout de l'interpretation d'un smiley</span>
 $config->simpletags[';-)']='&lt;img src="smiley_clindoeil.png" alt=""/>';

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
<p>Ils sont situés dans l'objet WikiRendererConfig</p>
<dl>
<dt><code>inlinetags</code></dt>
<dd>liste des tags wiki que l'on peut utiliser à l'intérieur les phrases. Voir
<a href="#confavancee">la partie configuration avançée</a>.
</dd>
<dt><code>bloctags</code></dt>
<dd>liste des tags de type blocs disponible. La clé de chaque élement de la liste
est le nom du bloc et la valeur, <code>true</code> ou <code>false</code>
suivant si on active ou non la détection du bloc. Voir
<a href="#confavancee">la partie configuration avançée</a>.</dd>
<dt><code>simpletags</code></dt>
<dd>tags simples pour lesquels il y a juste un remplacement à faire. C'est donc un tableau PHP
d'élements 'chaine à remplacer'=>'chaine remplacante'.</dd>
<dt><code>minHeaderLevel</code></dt>
<dd>Niveau minimal pour la génération des titres avec la balise <code>&lt;Hx&gt;</code>.
Par exemple, si on met 3, !!! donnera  <code>&lt;H3&gt;</code>, !! donnera <code>&lt;H4&gt;</code>
et ! donnera <code>&lt;H5&gt;</code>.
</dd>
<dt><code>headerOrder</code></dt>
<dd> indique le sens dans lequel il faut interpreter le nombre de signe de titre :
   <ul>
   <li><var>true</var> : ! = titre , !! = sous titre, !!! = sous-sous-titre</li>
   <li><var>false</var> : !!! = titre , !! = sous titre, ! = sous-sous-titre</li>
   </ul>
</dd>
<dt><code>inlineTagSeparator</code></dt>
<dd>Séparateur des differents attributs des tags wiki. Par defaut : <code>|</code></dd>
<dt><code>checkWikiWord</code></dt>
<dd>Indique si il faut détecter les mots wiki (un mot wiki est un mot commençant
par une majuscule, et contenant au moins une deuxième majuscule à l'interieur du mot)</dd>
<dt><code>checkWikiWordFunction</code></dt>
<dd>Indique le nom de la fonction qui sera appelée si la détection des mots wiki est activé.
Cette fonction devra recuperer en paramètre une liste de mots wiki, et devra
renvoyé une liste des chaines qui remplaceront les mots wiki indiqués.
Cette fonction est à implémenter par vous-même selon votre application. Voir
<a href="#confavancee">la partie configuration avançée</a>.</dd>
<dt><code>escapeSpecialChars</code> (version >= 2.0.5)</dt>
<dd>Indique si il faut échapper (true) ou non les balises html incluses dans le texte wiki pour ne
pas qu'elles soient interpretées par le navigateur. Par mesure de sécurité, toujours
laisser à <var>true</var> sauf si vous vous faîtes une configuration pour transformer dans
un format autre que XHTML/HTML.</dd>
</dl>

<h3>Les tags wiki par défauts</h3>

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
<p>Dans un texte wiki, on peut désactiver l'interpretation d'un tag wiki
en mettant un antislash devant la balise d'ouverture (et de fermeture
pour les tags en lignes). Exemple : <code>\__emphase\__</code>.</p>

<h2 id="confavancee">Configuration avançée</h2>

<p>Si le balisage wiki proposée par défaut ne vous convient pas, il faut le redéfinir.
Voici comment.</p>

<h3>Principes</h3>
<p>Il faut :</p>

<ol>
<li>créer un objet de configuration selon le modèle de WikiRendererConfig (ou surcharger WikiRendererConfig)</li>
<li>Créer des nouveaux objets de type WikiRendererBloc pour les balises
de type blocs et les indiquer dans votre objet de configuration</li>
<li>Passer cet objet de configuration en paramètre au constructeur de WikiRenderer</li>
</ol>
<p>Voir l'exemple avec le fichier WikiRenderer_w2x.conf.php, qui redefinit
un balisage compatible avec <a href="http://www.neokraft.net/sottises/wiki2xhtml/">wiki2xhtml</a> : </p>

<pre><code>
 include('WikiRenderer.lib.php');
 include('WikiRenderer_w2x.conf.php');

 $wkr = new WikiRenderer(<strong>new Wiki2XhtmlConfig()</strong>);
 $monTexteXHTML = $wkr->render($monTexteWiki);
</code></pre>


<h3>Modifier les tags wiki inlines</h3>

<p>Les tags wiki inlines sont les tags que l'on utilise à l'interieur des textes :
liens, emphases (gras, italique...), acronymes etc.. Ils sont définis dans la
variable <code>inlinetags</code> de la classe de configuration
WikiRendererConfig.</p>

<h4>Les propriétés d'un tag wiki</h4>

<p><code>inlinetags</code> est un tableau d'élements définissant chaque tag wiki :</p>
<pre><code>array(
  'nomtagwiki'=>array( propriétés du tag...),
  'nomtagwiki2'=>array( propriétés du tag...),
  ...);
</code></pre>
<p>Les propriétés du tag sont, dans l'ordre : </p>
<ol>
<li>symbole de début (chaîne);</li>
<li>symbole de fin (chaîne);</li>
<li>liste (tableau) des attributs xhtml (Si il n'y en a pas : null );</li>
<li>nom d'une fonction à appeler pour générer la balise xhtml, pour les balises
au fonctionnement complexe (si il n'y en a pas : null).</li>
</ol>

<h4>Génération du xhtml par défaut</h4>
<p>Quand il n'y a pas de fonction indiquée pour générer la balise xhtml,
WikiRenderer la générera automatiquement. Il
prendra le nom du tag wiki comme nom de balise xhtml.</p>
<p>Définissons par exemple une balise wiki pour faire une emphase
(balise html <code>strong</code>)
avec pour délimiteurs <code>__</code> : </p>
<pre><code>var $inlinetags= array(
   'strong' =>array('__','__', null,null),
   ...
   );
</code></pre>
<p>Si on écrit donc <code>__mon emphase__</code>, cela prendra <code>strong</code> comme
nom de balise, et sera transformé alors en <code>&lt;strong&gt;mon emphase&lt;/strong&gt;</code>.</p>

<p>On a vu que l'on pouvait indiquer une liste d'attributs xhtml dans les propriétés du tag.
Dans ce cas, WikiRenderer récuperera chaque chaîne se trouvant entre le séparateur
<code>|</code> (séparateur configurable) dans le tag wiki, et
seront utilisées comme valeur aux attributs indiqués.</p>
<p>Par exemple, admettons que l'on définisse ceci :</p>
<pre><code>var $inlinetags= array(
   'acronym'=>array('??','??', array('lang','title'),null),
   ...
   );
</code></pre>
<p>Si on écrit alors <code>??aaaa|bbbb|cccc??</code> :</p>
<ul>
<li>La valeur <code>aaaa</code>
sera utilisée comme valeur entre la balise ouvrante et fermante XHTML,</li>
<li>La valeur <code>bbbb</code> sera la valeur de l'attribut <code>lang</code></li>
<li>La valeur <code>cccc</code> sera la valeur de l'attribut <code>title</code></li>
</ul>
<p>Le code XHTML résultant sera donc
 <code>&lt;acronym lang="bbbb" title="cccc"&gt;aaaa&lt;/acronym&gt;.</code>.</p>


<h4>Utilisation d'une fonction génératrice spécifique</h4>
<p>Quand la génération par défaut ne suffit pas, qu'il faille un traitement particulier,
il faut alors indiquer une fonction de génération xhtml. Dans ce cas, le nom du tag
importe peu, voir même la liste des attributs.
Il faut juste que le nom soit différent des autres.
Cette fonction devra accepter en paramètre deux tableaux :</p>
<ol>
<li>Liste des chaines trouvées entre le symbole de début et le symbole de fin;</li>
<li>Liste des noms d'attributs de la propriété 3 du tag.</li>
</ol>
<p>Par exemple, si les propriétés d'un tag sont  :</p>
<pre><code>var $inlinetags= array(
   'link'   =>array('[',']', array('href','lang','title'),'wikibuildlink'),
   ...
   );
</code></pre>
<p>Et si on écrit <code>[aaaa|bbbb|cccc|dddd]</code>, la fonction <code>wikibuildlink</code>
sera appelée avec les paramètres suivants :</p>
<ul>
   <li><code>array('aaaa','bbbb','cccc','dddd')</code></li>
   <li><code>array('href','lang','title')</code></li>
</ul>

<p>La fonction devra retourner une chaîne contenant le code XHTML généré.
Vous pouvez voir des exemples de telles fonctions dans WikiRenderer.conf.php : <code>wikibuildlink</code>,
<code>wikibuildimage</code>, <code>wikibuildanchor</code>.</p>


<h3>Modifier les tags wiki de bloc de texte</h3>

<p>Les tags wiki de blocs permettent d'indiquer la nature d'un bloc de texte : titre, paragraphe,
liste, citation etc.. Pour prendre en charge un type de bloc de texte, il faut
développer une classe dérivant de <code>WikiRendererBloc</code>. Et ensuite indiquer
cette classe dans la classe de configuration.</p>

<p>Si vous voulez seulement modifier quelques propriétés d'un bloc existant
dans la configuration par défaut (par exemple redéfinir l'expression régulière, donc
le tag du bloc), vous pouvez simplement écrire une classe dérivant du blog d'origine
et indiquer la nouvelle expression régulière, comme ceci :</p>
<pre><code>class WRB_monTitleAMoi extends WRB_title {
   var $type='titleamoi';
   var $regexp="/^(\={1,3})(.*)/"; // et non plus /^(\!{1,3})(.*)/
}</code></pre>

<h4>Les propriétés</h4>
<p>Voici les propriétés de WikiRendererBloc que vous pouvez modifier dans votre
propre classe :</p>
<dl>
<dt><code>type</code></dt>
<dd>C'est un nom que vous donnez arbitrairement à votre tag. Il doit être
unique parmis les noms des autres tag wiki de blocs (propriété obligatoire).</dd>

<dt><code>regexp</code></dt>
<dd>Expression régulière qui sera appliquée sur chaque ligne du texte, pour savoir
si la ligne appartient au bloc (Propriété obligatoire).</dd>

<dt><code>_openTag</code></dt>
<dd>C'est la balise XHTML qui sera insérée au début du bloc de texte. Propriété
obligatoire si la méthode <code>open</code> n'est pas redéfinie
ou si la propriété <code>_closeNow</code>
est à false et/ou que vous n'avez pas redefini <code>getRenderedLine</code>.</dd>

<dt><code>_closeTag</code></dt>
<dd>C'est la balise XHTML qui sera insérée à la fin du bloc de texte. Propriété
obligatoire si la méthode <code>close</code> n'est pas redéfinie ou
si la propriété <code>_closeNow</code>
est à false et/ou que vous n'avez pas redefini <code>getRenderedLine</code>.</dd>

<dt><code>_closeNow</code></dt>
<dd>C'est un boolean (<code>true</code> ou <code>false</code>), qui indique si le bloc doit être
fermée immediatement aprés son ouverture. On mettra donc <code>true</code> si le
bloc ne fait qu'une ligne, comme c'est le cas pour les titres ou les séparateurs
HTML <code>&lt;hr /&gt;</code>. (Propriété obligatoire).</dd>

</dl>

<p>Il existe également une propriété, <code>_detectMatch</code>, qui contient ce
qui a été trouvée par l'expression régulière, si celle-ci a des parenthèses capturantes.
Vous pourrez donc faire appel à cette propriété dans les méthodes <code>open</code>
 ou <code>getRenderedLine</code> pour éviter éventuellement d'avoir à refaire une analyse
 de la ligne de texte pour la transformer.</p>


<h4>Les méthodes</h4>
<dl>
<dt><code>constructeur</code></dt>
<dd>C'est dans le constructeur que vous pourrez initialiser les propriétés de
votre objet. Le constructeur doit accepter en paramètre l'objet WikiRenderer, passé
en référence. Ainsi, si votre classe s'appelle <code>WRB_title</code>, vous devrez
débuter la déclaration du constructeur comme ceci: <code>function WRB_title(&amp;$wr){</code>.<br />
Le fait d'avoir l'objet <code>WikiRenderer</code> en paramètre vous permet
d'accéder éventuellement à la configuration. Ex: <code>$this->_minlevel = $wr->config->minHeaderLevel;</code>.<br />
Vous devrez également impérativement faire appel au constructeur de
<code>WikiRendererBloc</code> comme ceci : <code>parent::WikiRendererBloc($wr);</code>.
</dd>

<dt><code>detect</code></dt>
<dd>Cette méthode est appelée pour detecter si la ligne de texte courante
fait partie du bloc ou pas. En temps normal, vous ne devriez pas avoir
à redefinir cette méthode.</dd>

<dt><code>open</code></dt>
<dd>C'est une méthode appelée quand le début du bloc a été détécté. Elle
doit renvoyer du texte HTML à inserer au début du bloc généré (<code>&lt;ul&gt;</code>
pour une liste par exemple). Par défaut,
renvoi la valeur de la propriété <code>_openTag</code>. Vous
pouvez redefinir cette méthode si vous voulez éffectuer d'autres
traitements à ce moment là.</dd>

<dt><code>close</code></dt>
<dd>C'est une méthode appelée quand la fin du bloc a été détéctée. Elle
doit renvoyer du texte HTML à inserer à la fin du bloc généré
 (<code>&lt;/ul&gt;</code> pour une liste par exemple). Par défaut,
renvoi la valeur de la propriété <code>_closeTag</code>. Vous
pouvez redefinir cette méthode si vous voulez effectuer d'autres
traitements à ce moment là.</dd>

<dt><code>closeNow</code></dt>
<dd>Renvoi par défaut la valeur de la propriété <code>_closeNow</code> (un booléen).
Elle indique donc au moteur de WikiRenderer si il faut fermer
immediatement le bloc juste aprés l'ouverture. En temps normal, vous ne devriez pas avoir
à redefinir cette méthode.</dd>

<dt><code>getRenderedLine</code></dt>
<dd>Elle doit renvoyer la ligne courante transformée en XHTML, en utilisant notamment
la méthode <code>_renderInlineTag</code>.
(<strong>Note : </strong> Avant la version 2.0 finale, <code>getRenderedLine</code> acceptait
en paramètre la ligne de texte courante. Ce n'est plus le cas pour des raisons
d'optimisation. En effet, on trouve celle ci dans le premier élement de
<code>_detectMatch</code> : <code>$ligneOriginale=$this->_detectMatch[0]</code>).<br />

Par défaut, elle fait juste ça : <code>return $this->_renderInlineTag($this->_detectMatch[1]);</code>.<br />
<code>_detectMatch</code> contenant le résultat de l'évaluation de l'expression régulière
<code>regexp</code> de votre bloc, cela signifie donc qu'il doit y avoir au moins
une parenthèse capturante dans l'expression. Si il y a plus d'une parenthèse capturante
ou pas du tout, il vous faudra donc redéfinir getRenderedLine pour en tenir compte.<br />
Vous pourriez aussi avoir besoin de faire des choses supplémentaires. Par exemple, si il
s'agit d'un bloc de liste, rajouter les balises XHTML <code>&lt;li&gt;</code> et
<code>&lt;/li&gt;</code>, avant et aprés le texte transformé. Cela donnerait :
<code>return '&lt;li&gt;'.$this->_renderInlineTag($this->_detectMatch[1]).'&lt;/li&gt;';</code>.
<br />
Il peut arriver aussi parfois, de ne pas tenir compte de la ligne de texte, et de
renvoyer directement un contenu, comme cela peut être le cas pour la séparation <code>&lt;hr /&gt;</code> :
<code>return '&lt;hr /&gt;';</code>.
</dd>

<dt><code>_renderInlineTag</code></dt>
<dd>Cette méthode appelle le moteur de rendu des tags wiki inline (WikiInlineParser). Elle
prend en argument une chaine formatée wiki et renvoie la chaine correspondante en XHTML.
En principe, vous n'avez pas à la redéfinir.</dd>
</dl>

<h4>Nommage de votre classe</h4>
<p>Le nom de votre classe doit commencer par <code>WRB_</code> et se finir
par un nom que vous indiquerez dans la propriété <code>bloctags</code>
de la configuration. Ainsi, si vous nommez votre classe <code>WRB_titre</code>,
vous mettrez dans la configuration :</p>
<pre><code>var $blogtags = array( ... , 'titre'=>true, ... );</code></pre>

<h4>Principes de fonctionnement</h4>
<p>Voici quelques informations qui vont vous permettre de mieux comprendre comment
est utilisé un objet WikiRendererBloc par le moteur WikiRenderer.</p>
<ul>
<li>WikiRenderer analyse une à une les lignes du texte wiki.</li>
<li>À chaque ligne, il va appeler la méthode <code>detect</code> du bloc courant.</li>
<li>Si elle renvoie <code>true</code>, c'est que la ligne fait encore partie du bloc.
Il va donc demander au bloc de transformer la ligne en XHTML en appelant <code>getRenderedLine</code>.</li>
<li>Si la détection a échoué, WikiRenderer ferme le bloc (en éxecutant la méthode <code>close</code>
du bloc), et va appeler la méthode <code>detect</code> de chaque type de bloc qui sont
référencés dans la propriété <code>bloctags</code> de la configuration.</li>
<li>Il va ainsi savoir quel est le type du nouveau bloc. Celui-ci deviendra le bloc courant
et la méthode <code>open</code> sera appelé, ainsi que <code>getRenderedLine</code>.</li>
<li>Ainsi de suite jusqu'à la fin</li>
</ul>

<h4>Pour en savoir plus sur les blocs</h4>
<p>Regardez comment sont développés les blocs par défaut, dans le fichier
<code>WikiRenderer.conf.php</code>.</p>

<h3>Fonction de traitement des mots wikis</h3>
<p>Les mots Wiki sont des mots qui commencent par
une majuscule et en contiennent au moins 2. Ex : <code>CeciEstUnMotWiki</code>. Cela est utilisé
dans les systèmes wiki, pour faire automatiquement des liens  vers les pages qui portent
le même nom.</p>
<p>WikiRenderer permet de détecter ces mots Wiki, mais ce n'est pas activé par défaut, car
le traitement des mots Wiki est spécifique à l'usage que vous en faites. Pour utiliser
les mots wiki vous devez donc : </p>
<ol>
   <li>Modifier dans l'objet de configuration les propriétés <code>checkWikiWord</code>
   (activer la détection)
   et <code>checkWikiWordFunction</code> (indiquant la fonction de traitement des mots wiki).</li>

   <li>Définir une fonction de traitement des mots wiki</li>
</ol>

<p>Voici un exemple de configuration :</p>
<pre><code>class ConfWikiRenderer extends CopixWikiRendererConfig {
  var $checkWikiWord = true;
  var $checkWikiWordFunction = 'evalWikiWord';
}</code></pre>
<p>Ici WikiRenderer fera appel à la fonction <code>evalWikiWord</code>.</p>

<p>La fonction que vous indiquerez devra accepter en paramètre une liste de mots
wiki qui ont été trouvé dans la ligne de texte courante. Et devra retourner
une liste de chaine qui remplaceront ces mots wiki dans le texte. Le contenu
de cette liste est dans le même ordre que la liste des mots wiki : la
première chaîne correspond au premier mot wiki, la deuxième au deuxième
mot wiki etc.</p>
<p>Exemple de fonction pour un système d'edition wiki, qui retourne des liens
HTML pour chaque mot wiki, liens qui sont différents si ces mots correspondent ou pas
à des pages wiki : </p>
<pre><code>function evalWikiWord($wikiWordList){

   $result=array();

   foreach($wikiWordList as $word){
      // findWikiPage = fonction imaginaire, qui tenterait de trouver dans un système wiki, la page correspondante au mot
      if(findWikiPage($word))
         // page wiki trouvée
         $result[]='&lt;a href="wiki.php?wiki='.$word.'" class="wikiword">'.$word.'&lt;/a>';
      else
         // page wiki non trouvée
         $result[]='&lt;a href="wiki.php?wiki='.$word.'&amp;action=edit" class="unknowwikiword">'.$word.'&lt;/a>';
   }
   return $result;
}
</code></pre>



<?php

require('footer.inc.php');
?>








