<?php
$path_link=array('Historique'=>'historique.php');
require('header.inc.php');
?>

<h2>Historique de Wikirenderer.</h2>
<p>WikiRenderer est distribué sous <a href="http://www.gnu.org/licenses/licenses.html#LGPL">licence LGPL</a>.</p>

<dl>
   <dt>Version 3.0 RC1, 10/10/2006</dt>
   <dd>
        <ul>
            <li>Ajout d'une classe de base pour la configuration</li>

            <li>La classe de configuration peut rédéfinir des hooks : onStart, onParse. Cela
            permet de modifier le texte en entrée, mais aussi le texte en sortie.</li>

            <li>Ajout d'une propriété pointant vers la config, dans les objets dérivant de wikitag ou
            de WikiRendererBloc</li>

            <li>le constructeur accepte maintenant un nom de config. Les objets de config de rêgles
            doivent avoir le même nom que le fichier de rêgle. renommage en conséquences des noms
            des objets de config existants.</li>

            <li>Nouvelle syntaxe WR3, similaire à classicwr, mais avec la prise en charge de notes
            de bas de page, de blocs type pre entouré de &lt;code&gt; au lieu de chaque ligne
            commençant par un éspace.</li>
            <li>ajout des rêgles classicwr_to_wr3, pour convertir un texte classicwr en syntaxe wr3.</li>
            <li>ajout des rêgles wr3_to_text</li>
        </ul>
   </dd>

   <dt>Version 3.0 beta, 28/09/2006</dt>
   <dd> Refonte complète du moteur pour résoudre certains problèmes :
        <ul>
            <li>[FIX] bug sur les tags de lien : si il n'y avait que l'url et que celle-ci comportait par
               inadvertance des balises wiki, cela générait du code invalide (des balises xhtml dans les attributs par
               exemple)</li>
            <li>On ne parle plus de "configuration", mais de "rêgles" de transformation (rules)</li>
            <li>Il n'y a plus de fonctions de formatage pour les balises type inline : ce sont maintenant
                des objets à part entière</li>
            <li>Caractère de séparation d'attributs dans les tags inlines, paramètrables pour chaque tag</li>
            <li>Possibilité d'indiqué quel attribut servira de contenu, donc quel attribut accepte des
               tag wiki</li>
            <li>Modifications dans l'api des objets traitant les tags wiki de type blocs</li>
            <li>Possiblité d'avoir une syntaxe de bloc utilisant un délimiteur de début et de fin, et non
                pas qu'une syntaxe se reposant sur un caractère significatif en début de chaque ligne de bloc.</li>
       </ul>
   </dd>


   <dt>Version 2.0.6, 26/09/2004.</dt>
   <dd>
    <ul>
 <li>[FIX] problème d'expression régulière lors de la recherche de tags simples comportant certaines lettres ;</li>
 <li>[FIX] bug dans le moteur qui avait un impact sur les bloc commençant par les espaces ;</li>
 <li>[FIX] bug sur les caractères séparateurs : ils ne s'affichaient toujours pas dans les tags inline qui
 n'avaient pas d'attributs.</li>
 <li>[NEW] on peut désormais avoir un caractère | dans la valeur d'un attribut, il suffit de l'échapper. <br/>
 <code>[aaa\|aa|bbb]</code> donne <code>&lt;a href="bbb">aaa|aa&lt;/a></code></li>
 <li>[FIX] suppression d'une erreur "notice" lors de la génération HTML d'un tag wiki vide</li>
 <li>[FIX] problème d'interpretation des balises wiki qui suivent un \\</li>
 <li>[FIX]  generation de la génération d'un attribut lang au lieu de hreflang sur les liens</li>
 </ul>

   </dd>
   <dt>Version 2.0.5, 16/05/2004.</dt>
   <dd><ul>
      <li>[FIX] bug critique : les balises html contenues dans le texte wiki n'étaient pas échappées dans certains cas.</li>
      <li>[FIX] les caractères séparateurs (|) qui étaient en dehors de balises wiki disparaissaient</li>
      <li>[FIX] Le caractère d'échappement \ disparaissait aussi systématiquement, même si il n'échappait rien.
         Dorénavant, pour l'avoir dans un texte, il faut le doubler.</li>

      <li>[NEW] possibilité d'indiquer dans la config si on veut échapper ou non les balises HTML
      et autres caractères spéciaux inclus dans le texte wiki,
      ceci pour les configurations de transformations autre qu'au format xhtml/xml</li>
      <li>[FIX] bug sur la génération des listes dans certains cas</li>
      <li>petite corrections sur le fichier DOCUMENTATION</li>
      </ul>
</dd>


   <dt>Version 2.0.4, <!--<a href="download/WikiRenderer_2.0.4.zip">WikiRenderer_2.0.4.zip</a>-->
  28/01/2004</dt>
   <dd><p>Petite modification au niveau de la syntaxe wiki pour les tableaux et les définitions.
Lors de l'interpretation des tableaux, il y avait confusion entre le | separateur de
   colonne et le | separateur d'attributs pour les tags inlines (comme les liens).
   La syntaxe pour les tableaux impose dorénavant d'avoir un
   éspace <em>avant et aprés</em> chaque séparateur de colonne
   (sauf pour le premier | en début de ligne).</p>
<p>Problème identique pour les définitions, avec le caractère : qui sert de séparateur
  entre le terme et la définition. Quand il y avait un lien complet au niveau du terme
  (http://truc.com), le ':' du lien etait pris comme séparateur.
  Changement de syntaxe donc pour les définitions
  où il faut dorénavant encadrer le ':' séparateur par des espaces.</p></dd>
   <dt>Version 2.0.3, <!--<a href="download/WikiRenderer_2.0.3.zip">WikiRenderer_2.0.3.zip</a>-->
       22/01/2004.</dt>
   <dd>correction d'un bug sur le remplacement des mots wiki lorsque un mot wiki est
   répété plusieurs fois dans une même ligne.</dd>

   <dt>Version 2.0.2, <!--<a href="download/WikiRenderer_2.0.2.zip">WikiRenderer_2.0.2.zip</a>-->
   21/01/2004.</dt>
   <dd>Correction sur les tags inlines qui n'ont pas de fonctions spécialisées :
      mauvaise génération des attributs html.</dd>
   <dt>Version 2.0.1, <!--<a href="download/WikiRenderer_2.0.1.zip">WikiRenderer_2.0.1.zip</a>--> 19/01/2004.</dt>
   <dd>Toute petite correction sur la génération des acronymes (la déscription allait dans
   l'attribut lang)</dd>

   <dt>Version 2.0.0, <!--<a href="download/WikiRenderer_2.0.0.zip">WikiRenderer_2.0.0.zip</a>--> 18/01/2004.</dt>
   <dd> Améliorations par rapport à la 2.0 RC2 :
      <ul>
      <li>légères optimisations</li>
      <li>la méthode WikiRendererBloc::getRenderedLine n'accepte plus la ligne courante
         en paramètre pour des raisons d'optimisations puisqu'en fait, on la
         retrouve dans $this->_detectMatch[0].</li>
      <li>ajout d'un paramètre dans la configuration par défaut, pour indiquer l'ordre
      d'importance des signes de titre ( ! &gt; !! &gt; !!! ou !!! &gt; !! &gt; ! )</li>
      <li>citations imbriquées dorénavant possibles</li>
      <li>correction de bugs sur le traitement des attributs des tags wiki inlines (WikiTag)</li>
      <li>correction de bug sur la détection des mots wiki dans les lignes ne contenant pas de balises wiki</li>
      <li>correction d'un bug sur la numérotation des lignes indiquées dans les erreurs.</li>
      </ul>
   </dd>


   <dt>Version 2.0RC2, <!--<a href="download/WikiRenderer_20RC2.zip">WikiRenderer_20RC2.zip</a>--> 07/01/2004.</dt>
   <dd>Améliorations par rapport à la 2.0 RC1 :
      <ul>
         <li>Meilleure prise en charge pour les liens : interdit les liens de type javascript
         pour plus de sécurité, et pour les liens tout simple (<code>[http://site.com/]</code>),
         mais trés long, troncage à l'affichage.</li>
         <li>Ajout de la détection des mots wiki, désactivé par défaut.</li>
      </ul>
   </dd>
   <dt>Version 2.0RC1, <!--<a href="download/WikiRenderer_20RC1.zip">WikiRenderer_20RC1.zip</a>-->  23/12/2003.</dt>
   <dd>Refonte totale avec un code xhtml généré valide en toute circonstance (sauf bug ;-)</dd>
   <dt>Version 1.0 : <!--<a href="download/WikiRenderer_10.zip">WikiRenderer_10.zip</a>--> , 15/04/2003.</dt>
</dl>





<?php

require('footer.inc.php');
?>








