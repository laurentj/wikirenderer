===  Vue d'ensemble ===
[[RèglesDeFormatageDesTextes]]
   ***Liens :** CollerLesMotsEnMajuscule ou utiliAser des crochet pour un [lien vers une autre page] ou un URL [http://www.exemple.com] ou [libelle|http://www.exemple.com].
   * **Pour empêcher des liens :**
      * sur les mots en camelcase, préfixer avec "!": !NePasLier
      * sur les textes entre crochets, doubler le premier crochet : [[texte]
   ***Emphase :** '****' pour mettre en //italique//, _////_ pour mettre en **gras**, '****'_////_ pour //**les deux**//.
   ***Listes :** * pour les listes à puces, # pour les listes numérotées, //**;** term **:** definition// pour les listes définies par des titres.
   ***Références :** Utiliser [1],[2],[3],...
   ***Divers :** "!", "!!", "!!!" crée des titres, "%%////%" provoque un retour à la ligne, "-////---" crée une règle horizontale.


===  Paragraphes ===

   * N'indentez pas les paragraphes
   * Les mots reviennent à la ligne et remplissent les blancs au besoin
   * Utilisez des lignes vides comme séparateurs
   * Quatre tirets ou plus créent une règle horizontale
   * %%////% provoque un retour à la ligne (y compris dans les titres et les listes)


===  Listes ===

   * Un astérisque pour le premier niveau
      * Deux astérisques pour le deuxième niveau, etc.
   * Utilisez * pour les listes à puces, # pour les listes numérotées (mélangez à volonté)
   * point virgule-terme-deux points-définition pour les listes de définitions :
;le terme [[ici:et]] la définition là, à la manière des listes <DL><DT><DD>
   * Une ligne pour chaque élément
   * L'indentation avec des espaces signale un texte préformaté et change la police.

===  Titres ===

   * '!' en début de ligne produit un petit titre
   * '!!' en début de ligne produit un titre moyen
   * '!!!' en début de ligne produit un gros titre

===  Polices ===

   * Indentez avec une ou plusieurs espaces pour utiliser une police à chasse fixe :

<code> Ceci est en chasse fixe</code>
Ceci ne l'est pas

===  Paragraphes indentés ===

   * point virgule-deux points -- fonctionne comme <BLOCKQUOTE>

> ceci est un bloc de texte indenté

===  Emphase ===

   * Utilisez des apostrophes doubles ('****') pour l'emphase (habituellement en //italique//)
   * Utilisez des soulignées doubles (_////_) pour l'emphase forte (habituellement en **gras**)
   * Mélangez-les à volonté : **//gras italique//**
   * L//'emphase// peut être utilisée //plusieurs// fois dans une ligne, mais ne peut //pas// passer à la ligne :

''ceci
ne marche pas''

===  Liens ===
   * Les hyperliens vers d'autres pages au sein du Wiki sont créés en plaçant le nom de la page entre crochets : [[ceci est un hyperlien]] ou en [[UtilisantDesMotsWiki]] (de préférence)
   * Les hyperliens vers des pages externes sont créés de cette façon : [[http://www.wcsb.org/]]
   * Vous pouvez nommer les liens en leur donnant un nom, une barre verticale (|) puis l'hyperlien ou le nom de la page : [[ http://phpwiki.sourceforge.net/|page d'accueil de PhpWiki ]]  - [[ Accueil|la page d'accueil ]]
   * Vous pouvez supprimer les liens vers les références à l'ancienne ou vers les URI en précédant le mot d'un '!', e.g. NonLiéEnModeWiki, http://pas.de.lien.ici/
   * Vous pouvez créer des notes de bas de page en utilisant [1], [2], [3], ... comme ici (( En utilisant [1] une seconde fois (dans la première colonne) la note de bas de page elle-même est //définie//. Vous pouvez vous référer à une note de bas de page autant de fois que vous le voulez, mais vous ne pouvez la définir qu'une seule fois dans la page. Notez que le [1] dans la note renvoie à la première référence, s'il existe plusieurs références il y aura des '+' après le [1] qui renverront aux autres références (il n'y aura pas de lien vers les références venant //après// la //définition// de la note).)). Voir la note pour la contre-partie (si le [ est dans la première colonne, c'est une //définition// de note de bas de page, au lieu d'une //référence// à une note (( En utilisant [1] une seconde fois (dans la première colonne) la note de bas de page elle-même est //définie//. Vous pouvez vous référer à une note de bas de page autant de fois que vous le voulez, mais vous ne pouvez la définir qu'une seule fois dans la page. Notez que le [1] dans la note renvoie à la première référence, s'il existe plusieurs références il y aura des '+' après le [1] qui renverront aux autres références (il n'y aura pas de lien vers les références venant //après// la //définition// de la note).)).)
   * L'ancienne manière de lier les URL est aussi toujours supportée : précédez les URL de "http:", "ftp:" ou "mailto:" pour créer automatiquement des liens comme dans : [[http://c2.com/]]
   * Les URL se terminant par .png, .gif, ou .jpg sont inclus s'ils sont isolés entre crochets : {{http://phpwiki.sourceforge.net/demo/themes/default/images/png.png}}

===  Tableaux ===

   * Les tables simples sont disponibles. Une rangée dans une table est introduite par une barre **|** dans la première colonne. Cela est mieux décrit par un exemple :
<code>      ||  _''''_Nom_''''_                       |v _''''_Coût_''''_           |v _''''_Notes_''''_
      | _''''_Prénom_''''_ | _''''_Nom de famille_''''_
      |> Jeff      |< Dairiki           |^  Pas cher          |< Pas valable
      |> Marco     |< Polo              | Encore moins cher   |< Pas disponible</code>
> produira
| **Nom** || **Coût** | **Notes** |
| **Prénom** | **Nom de famille** | | |
|   Jeff | Dairiki   |   Pas cher   | Pas valable   |
|   Marco | Polo   | Encore moins cher | Pas disponible   |

> Notez que des barres **|** multiples mènent à des colonnes imbriquées, et que des **v** peuvent être utilisés pour imbriquer des rangées. Un **>** produit une colonne cadrée à droite, **<** une colonne cadrée à gauche et **^** une colonne centrée (ce qui est le comportement par défaut).

===  Langage de Marquage HTML ===

   * Ne vous en souciez pas
   * < et > sont eux-mêmes
   * Les caractères & ne fonctionneront pas
   * Si vous devez vraiment utiliser du HTML, votre administrateur système peut valider cette fonctionnalité. Commencez chaque ligne par une barre verticale (|). Notez que cette fonctionnalité est désactivée par défaut.

===  Plus de détails que vous ne voulez en connaître ===

Voir [[URLMagiquesPhpWiki]] pour obtenir des détails gores sur la façon d'écrire divers types de liens de maintenance du wiki.



Références :



[[DocumentationDePhpWiki]]