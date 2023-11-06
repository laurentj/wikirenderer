<?php
$path_link=array('Historique'=>'historique.php');
require('header.inc.php');
?>

<h2>Historique de Wikirenderer.</h2>
<p>WikiRenderer est distribué sous <a href="http://www.gnu.org/licenses/licenses.html#LGPL">licence LGPL</a>.</p>

<dl>
    <dt id="v3.1.10">Version 3.1.10, 06/11/2023</dt>
    <dd>
        <ul>
            <li>Fix <code>Wikirenderer::getVersion()</code></li>
            <li>Nouvelle constante <code>WIKIRENDERER_RULES_PATH</code></li>
        </ul>
    </dd>
    <dt id="v3.1.9">Version 3.1.9, 07/02/2023</dt>
    <dd>
        <ul>
            <li>Correction compatibilité PHP7/PHP8</li>
        </ul>
    </dd>

    <dt id="v3.1.8">Version 3.1.8, 28/05/2016</dt>
    <dd>
        <ul>
            <li>Correction de l'auto-chargement des classes WikiTextLine</li>
        </ul>
    </dd>

    <dt id="v3.1.7">Version 3.1.7, 05/06/2015</dt>
    <dd>
        <ul>
            <li>Installable avec Composer : paquet 'jelix/wikirenderer'</li>
            <li>Correction de conformité sur la génération de Docbook</li>
        </ul>
    </dd>

    <dt id="v3.1.6">Version 3.1.6, 02/02/2015</dt>
    <dd>
        <ul>
            <li>Compatibilité avec PHP 5.4 et +: ajout d'un paramètre charset dans l'objet de configuration, pour htmlspecialchars.</li>
        </ul>
    </dd>
    <dt>Nouvel hebergement, 28/12/2012</dt>
   <dd>
    Hebergement du code source sur https://github.com/laurentj/wikirenderer
   </dd>

    <dt id="v3.1.5">Version 3.1.5, 14/07/2012</dt>
    <dd>
        <ul>
            <li>Amélioration de la rêgle dokuwiki_to_docbook</li>
        </ul>
    </dd>

    <dt id="v3.1.4">Version 3.1.4, 20/04/2012</dt>
    <dd>
        <ul>
            <li>Amélioration de WikiRendererConfig::processLink() :  elle retourne maintenant l'URL et le label</li>
        </ul>
    </dd>
   
    <dt id="v3.1.3">Version 3.1.3, 09/04/2012</dt>
    <dd>
        <ul>
            <li>WikiRendererConfig possède maintenant une méthode processLink que l'on peut rédéfinir pour traiter les URLS de manière spécifique</li>
            <li>Correction de la convertion wr vers wr3</li>
            <li>wr3 rules : les tags doivent être ignorés dans le tag code</li>
        </ul>
    </dd>

    <dt>Nouvel hebergement, 30/10/2011</dt>
   <dd>
        <ul>
            <li>Hebergement du site sur http://wikirenderer.jelix.org</li>
            <li>Hebergement du code source sur https://bitbucket.org/laurentj/wikirenderer</li>
        </ul>
   </dd>
    
    <dt id="v3.1.2">Version 3.1.2, 27/12/2009</dt>
    <dd>
        <ul>
            <li>correction de bugs  dans la rêgle dokuwiki_to_xhtml</li>
        </ul>
    </dd>

    <dt id="v3.1.1">Version 3.1.1, 08/09/2009)</dt>
    <dd>
        <ul>
            <li>Meilleure compatibilité avec PHP 5.3</li>   
            <li>Correction d'une notice sur une variable indéfinie</li>   
            <li>Correction d'un bug sur la rule WR3 : mauvaise génération de contenu quand
             <code>&lt;/code&gt;</code> était sur la même ligne que <code>&lt;code&gt;</code></li>   
        </ul>
    </dd>
    
   <dt id="v3.1">Version 3.1, 19/06/2009</dt>
   <dd>
    <ul>
        
<li> Ne fonctionne plus sur PHP4.</li>
<li>Les mots wiki CamelCase peuvent maintenant être ignoré en mettant un "!" devant</li>
<li> Nouvelle règles de transformation fournies: wr3_to_docbook, dokuwiki_to_docbook, dokuwiki_to_xhtml,
  trac_to_xhtml, phpwiki_to_dokuwiki, jwiki_to_xhtml</li>
<li> [FIX] bug : mauvais comportement quand un tag wiki contenait
uniquement la valeur "0"</li>
<li> [FIX] bug : les mots CamelCase en UTF-8 n'étaient pas reconnus</li>

<li> Corrections de bugs pour les développeurs de règles :
    <ul>
        <li> "/" n'etait pas permis dans les patterns des tags inline</li>
        <li>Le parser inline fait maintenant attention aux attributs qui n'acceptent
        pas de tags wiki</li>
        
    </ul>
</li>
<li>
    Amélioration à l'intention des développeurs de règles :
    <ul>
        <li>Nouvelle propriété <code>WikiTagXhtml::additionnalAttributes</code> :
        vous pouvez ainsi spécifier des attributs statiques à ajouter
        sur l'élement</li>
        <li>Nouvelle propriété <code>WikiTagXhtml::ignoreAttribute</code></li>
        <li>Le caractère d'échappement est maintenant configurable</li>
        <li>Correction sur les valeurs par défaut des propriétés de <code>WikiTag</code>.</li>
        <li>la propriété de configuration <code>checkWikiWordFunction</code>
        peut maintenant être un tableau contenant un nom d'objet et un nom de méthode,
        plus seulement un nom de fonction.</li>
        <li></li>
    </ul>
</li>

<li> Changement d'API pour les objets des règles
    <ul>
        <li>La propriété <code>WikiRendererConfig::$textLineContainer</code> a été renommée
  en <code>WikiRendererConfig::$defaultTextLineContainer</code></li>
        <li>nouvelle propriété <code>WikiRendererConfig::$textLineContainers</code>
        qui remplace maintenant la propriété <code>WikiRendererConfig::$inlineTag</code>,
        et qui a une structure différente.</li>
        <li>Renommage de <code>WikiTag::$separator</code> en <code>WikiTag::$currentSeparator</code></li>
        <li><code>WikiTag::addContent()</code> et <code>WikiTag::addSeparator</code> ne sont plus
des méthodes finales, et peuvent donc être redéfinies.</li>
        <li><code>WikiTag::addSeparator</code> reçoit maintenant un separateur comme argument</li>
        <li>Renommage de  <code>WikiTag::getCurrentSeparator()</code> en <code>WikiTag::isCurrentSeparator($token)</code></li>

    </ul>
</li>

    </ul>
    
   </dd>
    
    
   <dt id="v3.0">Version 3.0, 03/02/2007</dt>
   <dd>
    <ul>
        <li>petit nettoyage de code</li>
        <li>[FIX] bug : la fonction de callback pour les mots wiki n'était jamais appelée</li>
        <li>[FIX] bug : il y avait une erreur quand on utilisait la rule par défaut (nom de classe invalide)</li>
    </ul>
   </dd>

   <dt id="v3.0RC1">Version 3.0 RC1, 10/10/2006</dt>
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

   <dt>Nouvel hebergement, 23/11/2005</dt>
   <dd>
    Hebergement sur developer.berlios.de.
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
      <li>[FIX] Le caractère d'échappement \ disparaissait aussi systématiquement, même si il
        n'échappait rien. Dorénavant, pour l'avoir dans un texte, il faut le doubler.</li>
      <li>[NEW] possibilité d'indiquer dans la config si on veut échapper ou non les balises HTML
      et autres caractères spéciaux inclus dans le texte wiki,
      ceci pour les configurations de transformations autre qu'au format xhtml/xml</li>
      <li>[FIX] bug sur la génération des listes dans certains cas</li>
      <li>petite corrections sur le fichier DOCUMENTATION</li>
      </ul>
    </dd>


   <dt>Version 2.0.4, 28/01/2004</dt>
   <dd><ul><li>Petite modification au niveau de la syntaxe wiki pour les tableaux et les définitions.
Lors de l'interpretation des tableaux, il y avait confusion entre le <code>|</code> separateur de
   colonne et le <code>|</code> separateur d'attributs pour les tags inlines (comme les liens).
   La syntaxe pour les tableaux impose dorénavant d'avoir un
   éspace <em>avant et aprés</em> chaque séparateur de colonne
   (sauf pour le premier <code>|</code> en début de ligne).</li>
  <li>Problème identique pour les définitions, avec le caractère : qui sert de séparateur
  entre le terme et la définition. Quand il y avait un lien complet au niveau du terme
  (http://truc.com), le ':' du lien etait pris comme séparateur.
  Changement de syntaxe donc pour les définitions
  où il faut dorénavant encadrer le ':' séparateur par des espaces.</li></ul></dd>
   <dt>Version 2.0.3, 22/01/2004.</dt>
   <dd>correction d'un bug sur le remplacement des mots wiki lorsque un mot wiki est
   répété plusieurs fois dans une même ligne.</dd>

   <dt>Version 2.0.2, 21/01/2004.</dt>
   <dd>Correction sur les tags inlines qui n'ont pas de fonctions spécialisées :
      mauvaise génération des attributs html.</dd>
   <dt>Version 2.0.1, 19/01/2004.</dt>
   <dd>Toute petite correction sur la génération des acronymes (la déscription allait dans
   l'attribut lang)</dd>

   <dt>Version 2.0.0,  18/01/2004.</dt>
   <dd><ul>
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


   <dt>Version 2.0RC2, 07/01/2004.</dt>
   <dd> <ul>
         <li>Meilleure prise en charge pour les liens : interdit les liens de type javascript
         pour plus de sécurité, et pour les liens tout simple (<code>[http://site.com/]</code>),
         mais trés long, troncage à l'affichage.</li>
         <li>Ajout de la détection des mots wiki, désactivé par défaut.</li>
      </ul>
   </dd>
   <dt>Version 2.0RC1,   23/12/2003.</dt>
   <dd>Refonte totale avec un code xhtml généré valide en toute circonstance (sauf bug ;-)</dd>
   <dt>Version 1.0 , 15/04/2003.</dt>
</dl>





<?php

require('footer.inc.php');
?>








