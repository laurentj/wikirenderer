<?php $list=array (
  0 => 
  array (
    0 => 'Bonjour,

Je suis actuellement en train d\'essayer de créer un certificat en vue de signer des extensions en me basant sur la page 
[ Applis Web/Signer Une Appli | http://www.xulfr.org/wiki/ApplisWeb/SignerUneAppli | fr | Article sur la signature d\'une appli web]

Après pas mal de tâtonnements, recherche de dll manquantes, et autres joyeusetés, j\'arrive enfin à lancer certutil, j\'ai créé un certificat racine, req.txt est bien placé au bon endroit et semble avoir un contenu normal, par contre l\'étape suivante avec le code @@certutil.exe -C -d CA -c "Mon.Certificat" -i CA\\req.txt -a -o CA\\cert.txt -1 -2 -5@@ plante et me donne le message d\'erreur suivant : 
 Microsoft Visual C++ Debug Library
 Debug Assertion Failed!
 Program D:\\.....\\certutil.exe
 File dbgheap.c
 Line 1044
 
 Expression: _CrtIsValidHeapPointer(pUserData)
 ...
Au final j\'ai bien un fichier cert.txt qui est créé mais il est désespérément vide.

Quelqu\'un l\'a-t-il déjà rencontré et/ou saurait-il de quoi ça peut venir ? Et surtout comment résoudre ce problème ?

Merci d\'avance ;-)',
    1 => '<p>
Bonjour,
</p>
<p>
Je suis actuellement en train d\'essayer de créer un certificat en vue de signer des extensions en me basant sur la page 
<a href=" http://www.xulfr.org/wiki/ApplisWeb/SignerUneAppli " hreflang=" fr " title=" Article sur la signature d\'une appli web"> Applis Web/Signer Une Appli </a>
</p>
<p>
Après pas mal de tâtonnements, recherche de dll manquantes, et autres joyeusetés, j\'arrive enfin à lancer certutil, j\'ai créé un certificat racine, req.txt est bien placé au bon endroit et semble avoir un contenu normal, par contre l\'étape suivante avec le code <code>certutil.exe -C -d CA -c &quot;Mon.Certificat&quot; -i CA\\req.txt -a -o CA\\cert.txt -1 -2 -5</code> plante et me donne le message d\'erreur suivant : 
</p>
<pre>
Microsoft Visual C++ Debug Library
Debug Assertion Failed!
Program D:\\.....\\certutil.exe
File dbgheap.c
Line 1044

Expression: _CrtIsValidHeapPointer(pUserData)
...
</pre>
<p>
Au final j\'ai bien un fichier cert.txt qui est créé mais il est désespérément vide.
</p>
<p>
Quelqu\'un l\'a-t-il déjà rencontré et/ou saurait-il de quoi ça peut venir ? Et surtout comment résoudre ce problème ?
</p>
<p>
Merci d\'avance ;-)
</p>',
    2 => '<p>Bonjour,</p>

<p>Je suis actuellement en train d\'essayer de créer un certificat en vue de signer des extensions en me basant sur la page 
<a href=" http://www.xulfr.org/wiki/ApplisWeb/SignerUneAppli " hreflang=" fr " title=" Article sur la signature d\'une appli web"> Applis Web/Signer Une Appli </a></p>

<p>Après pas mal de tâtonnements, recherche de dll manquantes, et autres joyeusetés, j\'arrive enfin à lancer certutil, j\'ai créé un certificat racine, req.txt est bien placé au bon endroit et semble avoir un contenu normal, par contre l\'étape suivante avec le code <code>certutil.exe -C -d CA -c &quot;Mon.Certificat&quot; -i CA\\req.txt -a -o CA\\cert.txt -1 -2 -5</code> plante et me donne le message d\'erreur suivant : </p>
<pre>Microsoft Visual C++ Debug Library
Debug Assertion Failed!
Program D:\\.....\\certutil.exe
File dbgheap.c
Line 1044

Expression: _CrtIsValidHeapPointer(pUserData)
...
</pre>
<p>Au final j\'ai bien un fichier cert.txt qui est créé mais il est désespérément vide.</p>

<p>Quelqu\'un l\'a-t-il déjà rencontré et/ou saurait-il de quoi ça peut venir ? Et surtout comment résoudre ce problème ?</p>

<p>Merci d\'avance ;-)</p>',
  ),
  1 => 
  array (
    0 => 'Changer sa valeur :

 document.getElementById(\'wait\').setAttribute(\'value\',\'10%\');

Pour désactiver un progressmeter en undetermined, il faut mettre sa value à 0%, et changer son mode à "determined"',
    1 => '<p>
Changer sa valeur :
</p>
<pre>
document.getElementById(\'wait\').setAttribute(\'value\',\'10%\');
</pre>
<p>
Pour désactiver un progressmeter en undetermined, il faut mettre sa value à 0%, et changer son mode à &quot;determined&quot;
</p>',
    2 => '<p>Changer sa valeur :</p>

<pre>document.getElementById(\'wait\').setAttribute(\'value\',\'10%\');
</pre>

<p>Pour désactiver un progressmeter en undetermined, il faut mettre sa value à 0%, et changer son mode à &quot;determined&quot;</p>',
  ),
  2 => 
  array (
    0 => 'Balinette, pour le RDF ok tu as raison alors inspire toi de cet exemple [http://xulfr.org/xulplanet/xultu/exemples/animals.txt] que l\'on trouve dans ce chapitre [http://xulfr.org/xulplanet/xultu/datasrc.php] c\'est exactement un RDF de ce type qu\'il te faut, qd ca marchera on reviendra au tri, a ce propos dans ton tree ton datasources ne me plait guere, essai avec une URI du type chrome:// ca ira deja mieux.

@+
David',
    1 => '<p>
Balinette, pour le RDF ok tu as raison alors inspire toi de cet exemple <a href="http://xulfr.org/xulplanet/xultu/exemples/animals.txt">http://xulfr.org/xulplanet/xultu/exemple(..)</a> que l\'on trouve dans ce chapitre <a href="http://xulfr.org/xulplanet/xultu/datasrc.php">http://xulfr.org/xulplanet/xultu/datasrc(..)</a> c\'est exactement un RDF de ce type qu\'il te faut, qd ca marchera on reviendra au tri, a ce propos dans ton tree ton datasources ne me plait guere, essai avec une URI du type chrome:// ca ira deja mieux.
</p>
<p>
@+
David
</p>',
    2 => '<p>Balinette, pour le RDF ok tu as raison alors inspire toi de cet exemple <a href="http://xulfr.org/xulplanet/xultu/exemples/animals.txt">http://xulfr.org/xulplanet/xultu/exemple(..)</a> que l\'on trouve dans ce chapitre <a href="http://xulfr.org/xulplanet/xultu/datasrc.php">http://xulfr.org/xulplanet/xultu/datasrc(..)</a> c\'est exactement un RDF de ce type qu\'il te faut, qd ca marchera on reviendra au tri, a ce propos dans ton tree ton datasources ne me plait guere, essai avec une URI du type chrome:// ca ira deja mieux.</p>

<p>@+
David</p>',
  ),
  3 => 
  array (
    0 => 'Peut on utiliser XUL avec le navigateur safari ? 

',
    1 => '<p>
Peut on utiliser XUL avec le navigateur safari ? 
</p>',
    2 => '<p>Peut on utiliser XUL avec le navigateur safari ? </p>

',
  ),
  4 => 
  array (
    0 => 'non. faut passer par les overlays. Ils ont été conçus en parti pour ça !

Pourquoi ne voudrais tu pas les utiliser ?',
    1 => '<p>
non. faut passer par les overlays. Ils ont été conçus en parti pour ça !
</p>
<p>
Pourquoi ne voudrais tu pas les utiliser ?
</p>',
    2 => '<p>non. faut passer par les overlays. Ils ont été conçus en parti pour ça !</p>

<p>Pourquoi ne voudrais tu pas les utiliser ?</p>',
  ),
  5 => 
  array (
    0 => 'qdqsdqsdqsd',
    1 => '<p>
qdqsdqsdqsd
</p>',
    2 => '<p>qdqsdqsdqsd</p>',
  ),
  6 => 
  array (
    0 => 'Définition :

>Un cadre qui fonctionne de façon similaire aux iframe du HTML. L\'attribut src permet de spécifier l\'?URI du document source. Le contenu est un document séparé (qui peut être du HTML, du XUL...). __Les enfants de cet élément sont ignorés.__

Est-ce que ça veut dire qu\'on ne peut pas récupérer de données avec un getelement ?',
    1 => '<p>
Définition :
</p>
<blockquote>
<p>
Un cadre qui fonctionne de façon similaire aux iframe du HTML. L\'attribut src permet de spécifier l\'?URI du document source. Le contenu est un document séparé (qui peut être du HTML, du XUL...). <strong>Les enfants de cet élément sont ignorés.</strong>
</p></blockquote>
<p>
Est-ce que ça veut dire qu\'on ne peut pas récupérer de données avec un getelement ?
</p>',
    2 => '<p>Définition :</p>

<blockquote>
<p>Un cadre qui fonctionne de façon similaire aux iframe du HTML. L\'attribut src permet de spécifier l\'?URI du document source. Le contenu est un document séparé (qui peut être du HTML, du XUL...). <strong>Les enfants de cet élément sont ignorés.</strong></p></blockquote>

<p>Est-ce que ça veut dire qu\'on ne peut pas récupérer de données avec un getelement ?</p>',
  ),
  7 => 
  array (
    0 => 'remplace
 var corps = "pseudo="+login"&mot_de_passe="+pass;
par
 var corps = "pseudo="+login+"&mot_de_passe="+pass;

quand la console javascript te dit que ta fonction n\'est pas définie, c\'est qu\'il y a une erreur de syntaxe quelque part.',
    1 => '<p>
remplace
</p>
<pre>
var corps = &quot;pseudo=&quot;+login&quot;&amp;mot_de_passe=&quot;+pass;
</pre>
<p>
par
</p>
<pre>
var corps = &quot;pseudo=&quot;+login+&quot;&amp;mot_de_passe=&quot;+pass;
</pre>
<p>
quand la console javascript te dit que ta fonction n\'est pas définie, c\'est qu\'il y a une erreur de syntaxe quelque part.
</p>',
    2 => '<p>remplace</p>
<pre>var corps = &quot;pseudo=&quot;+login&quot;&amp;mot_de_passe=&quot;+pass;
</pre>
<p>par</p>
<pre>var corps = &quot;pseudo=&quot;+login+&quot;&amp;mot_de_passe=&quot;+pass;
</pre>

<p>quand la console javascript te dit que ta fonction n\'est pas définie, c\'est qu\'il y a une erreur de syntaxe quelque part.</p>',
  ),
  8 => 
  array (
    0 => 'Hop, ajout !

Quand je fais comme ça par exemple (donc méthode 2) :
 var x=window.frames[\'nomIfr\'].document;
 var y=x.body.textContent;

ça marche pas, mais si je crée une extension et que j\'utilise une url chrome://, ça fonctionne nickel (quoique, y\'a pas moyen d\'obtenir le code source HTML de la page, pas seulement le texte ?)...
Donc, suis-je vraiment obligé d\'être en chrome:// ?

Merci d\'avance.',
    1 => '<p>
Hop, ajout !
</p>
<p>
Quand je fais comme ça par exemple (donc méthode 2) :
</p>
<pre>
var x=window.frames[\'nomIfr\'].document;
var y=x.body.textContent;
</pre>
<p>
ça marche pas, mais si je crée une extension et que j\'utilise une url chrome://, ça fonctionne nickel (quoique, y\'a pas moyen d\'obtenir le code source HTML de la page, pas seulement le texte ?)...
Donc, suis-je vraiment obligé d\'être en chrome:// ?
</p>
<p>
Merci d\'avance.
</p>',
    2 => '<p>Hop, ajout !</p>

<p>Quand je fais comme ça par exemple (donc méthode 2) :</p>
<pre>var x=window.frames[\'nomIfr\'].document;
var y=x.body.textContent;
</pre>

<p>ça marche pas, mais si je crée une extension et que j\'utilise une url chrome://, ça fonctionne nickel (quoique, y\'a pas moyen d\'obtenir le code source HTML de la page, pas seulement le texte ?)...
Donc, suis-je vraiment obligé d\'être en chrome:// ?</p>

<p>Merci d\'avance.</p>',
  ),
  9 => 
  array (
    0 => 'je ne comprend pas. Pourquoi vouloir mettre du XUL dans ton flux RSS ? Je ne comprend pas ce que ça va apporter.',
    1 => '<p>
je ne comprend pas. Pourquoi vouloir mettre du XUL dans ton flux RSS ? Je ne comprend pas ce que ça va apporter.
</p>',
    2 => '<p>je ne comprend pas. Pourquoi vouloir mettre du XUL dans ton flux RSS ? Je ne comprend pas ce que ça va apporter.</p>',
  ),
  10 => 
  array (
    0 => 'Bonjour,

J\'ai un pb et ça fait plusieurs jours que je passe dessus sans le résoudre, donc je viens demander de l\'aide : 

*comment fait-on pour utiliser un fichier dtd avec un fichier xul ?
J\'ai essayé ça dans mon fichier xul (les deux fichiers sont dans le même repertoire) : 
 <!DOCTYPE window SYSTEM "exemple1.dtd">

Mais lorsque je charge ma page, j\'ai une erreur : 
 Emplacement : file:///G:/testxul/exemple1.xul
 Numéro de ligne 7, Colonne 3 :	
 	<button label="&exemple.1.hello;" />
 --^

*Faut il obligatoirement pointer vers un fichier qui se trouve dans le __chrome__ :
 <!DOCTYPE window SYSTEM "chrome://exemple1/locale/exemple1.dtd">
Dans ce cas faut-il que je développe directement dans le __chrome__ et que je déclare l\'application dans le fichier __installed-chrome.txt__.

*Dernière question : L\'utilisation des fichiers dtd est-elle possible dans le développement d\'appli web ?

Voilà, merci d\'avance pour vos réponses.',
    1 => '<p>
Bonjour,
</p>
<p>
J\'ai un pb et ça fait plusieurs jours que je passe dessus sans le résoudre, donc je viens demander de l\'aide : 
</p>
<ul>

<li>comment fait-on pour utiliser un fichier dtd avec un fichier xul ?
</li>
</ul>

<p>
J\'ai essayé ça dans mon fichier xul (les deux fichiers sont dans le même repertoire) : 
</p>
<pre>
&lt;!DOCTYPE window SYSTEM &quot;exemple1.dtd&quot;&gt;
</pre>
<p>
Mais lorsque je charge ma page, j\'ai une erreur : 
</p>
<pre>
Emplacement : file:///G:/testxul/exemple1.xul
Numéro de ligne 7, Colonne 3 :	
	&lt;button label=&quot;&amp;exemple.1.hello;&quot; /&gt;
--^
</pre>
<ul>

<li>Faut il obligatoirement pointer vers un fichier qui se trouve dans le <strong>chrome</strong> :
</li>
</ul>

<pre>
&lt;!DOCTYPE window SYSTEM &quot;chrome://exemple1/locale/exemple1.dtd&quot;&gt;
</pre>
<p>
Dans ce cas faut-il que je développe directement dans le <strong>chrome</strong> et que je déclare l\'application dans le fichier <strong>installed-chrome.txt</strong>.
</p>
<ul>

<li>Dernière question : L\'utilisation des fichiers dtd est-elle possible dans le développement d\'appli web ?
</li>
</ul>

<p>
Voilà, merci d\'avance pour vos réponses.
</p>',
    2 => '<p>Bonjour,</p>

<p>J\'ai un pb et ça fait plusieurs jours que je passe dessus sans le résoudre, donc je viens demander de l\'aide : </p>

<ul>
<li>comment fait-on pour utiliser un fichier dtd avec un fichier xul ?</li>
</ul>
<p>J\'ai essayé ça dans mon fichier xul (les deux fichiers sont dans le même repertoire) : </p>
<pre>&lt;!DOCTYPE window SYSTEM &quot;exemple1.dtd&quot;&gt;
</pre>

<p>Mais lorsque je charge ma page, j\'ai une erreur : </p>
<pre>Emplacement : file:///G:/testxul/exemple1.xul
Numéro de ligne 7, Colonne 3 :	
	&lt;button label=&quot;&amp;exemple.1.hello;&quot; /&gt;
--^
</pre>

<ul>
<li>Faut il obligatoirement pointer vers un fichier qui se trouve dans le <strong>chrome</strong> :</li>
</ul>
<pre>&lt;!DOCTYPE window SYSTEM &quot;chrome://exemple1/locale/exemple1.dtd&quot;&gt;
</pre>
<p>Dans ce cas faut-il que je développe directement dans le <strong>chrome</strong> et que je déclare l\'application dans le fichier <strong>installed-chrome.txt</strong>.</p>

<ul>
<li>Dernière question : L\'utilisation des fichiers dtd est-elle possible dans le développement d\'appli web ?</li>
</ul>

<p>Voilà, merci d\'avance pour vos réponses.</p>',
  ),
  11 => 
  array (
    0 => 'J\'ai la réponse à ma question. - La réponse est oui.

Voir :
http://www-128.ibm.com/developerworks/webservices/library/co-xpcom3.html',
    1 => '<p>
J\'ai la réponse à ma question. - La réponse est oui.
</p>
<p>
Voir :
http://www-128.ibm.com/developerworks/webservices/library/co-xpcom3.html
</p>',
    2 => '<p>J\'ai la réponse à ma question. - La réponse est oui.</p>

<p>Voir :
http://www-128.ibm.com/developerworks/webservices/library/co-xpcom3.html</p>',
  ),
  12 => 
  array (
    0 => 'merci, je ne pensais pas qu\'on pouvait.
mais je ne suis pas encore sur, en fait au debut je voulais faire une applet java a appeler dans le fichier xul, mais je ne sais pas si la solution que tu me donne est facile a utiliser.
',
    1 => '<p>
merci, je ne pensais pas qu\'on pouvait.
mais je ne suis pas encore sur, en fait au debut je voulais faire une applet java a appeler dans le fichier xul, mais je ne sais pas si la solution que tu me donne est facile a utiliser.
</p>',
    2 => '<p>merci, je ne pensais pas qu\'on pouvait.
mais je ne suis pas encore sur, en fait au debut je voulais faire une applet java a appeler dans le fichier xul, mais je ne sais pas si la solution que tu me donne est facile a utiliser.</p>
',
  ),
  13 => 
  array (
    0 => 'Par exemple là je voudrais extraire les fichiers d\'un zip avec ceci :

int8 extract(in string,in nsIFile)

Mais de quoi la fonction a-t-elle besoin comme String et comme nsIFile ? J\'imagine qu\'il doit y avoir le nom du fichier à extraire et le dossier de destination. Est-ce que quelqu\'un s\'est déjà servi de cette fonction ?',
    1 => '<p>
Par exemple là je voudrais extraire les fichiers d\'un zip avec ceci :
</p>
<p>
int8 extract(in string,in nsIFile)
</p>
<p>
Mais de quoi la fonction a-t-elle besoin comme String et comme nsIFile ? J\'imagine qu\'il doit y avoir le nom du fichier à extraire et le dossier de destination. Est-ce que quelqu\'un s\'est déjà servi de cette fonction ?
</p>',
    2 => '<p>Par exemple là je voudrais extraire les fichiers d\'un zip avec ceci :</p>

<p>int8 extract(in string,in nsIFile)</p>

<p>Mais de quoi la fonction a-t-elle besoin comme String et comme nsIFile ? J\'imagine qu\'il doit y avoir le nom du fichier à extraire et le dossier de destination. Est-ce que quelqu\'un s\'est déjà servi de cette fonction ?</p>',
  ),
  14 => 
  array (
    0 => 'Salut a tous

J essaie de faire un menu demarrer a la windows en XUL avec le bouton en bas a gauche et le truc que j arrive pas faire, avoir le menu qui s affiche vers le haut.

Quelqu un a une idee des widgets a utiliser, un site ou du code?

Merci et a+

Cyril',
    1 => '<p>
Salut a tous
</p>
<p>
J essaie de faire un menu demarrer a la windows en XUL avec le bouton en bas a gauche et le truc que j arrive pas faire, avoir le menu qui s affiche vers le haut.
</p>
<p>
Quelqu un a une idee des widgets a utiliser, un site ou du code?
</p>
<p>
Merci et a+
</p>
<p>
Cyril
</p>',
    2 => '<p>Salut a tous</p>

<p>J essaie de faire un menu demarrer a la windows en XUL avec le bouton en bas a gauche et le truc que j arrive pas faire, avoir le menu qui s affiche vers le haut.</p>

<p>Quelqu un a une idee des widgets a utiliser, un site ou du code?</p>

<p>Merci et a+</p>

<p>Cyril</p>',
  ),
  15 => 
  array (
    0 => 'Apres test ... snif ça marche pas..
ni sous firefox ni sous mozilla ..
si quelqu\'un à d\'autre sugestion ..

',
    1 => '<p>
Apres test ... snif ça marche pas..
ni sous firefox ni sous mozilla ..
si quelqu\'un à d\'autre sugestion ..
</p>',
    2 => '<p>Apres test ... snif ça marche pas..
ni sous firefox ni sous mozilla ..
si quelqu\'un à d\'autre sugestion ..</p>

',
  ),
  16 => 
  array (
    0 => 'D\'après le chapitre 16 du livre "Rapid Application Development with Mozilla", le composant XPCOM pour se connecter aux bases de données MySQL est disponible sur toute les plateformes.',
    1 => '<p>
D\'après le chapitre 16 du livre &quot;Rapid Application Development with Mozilla&quot;, le composant XPCOM pour se connecter aux bases de données MySQL est disponible sur toute les plateformes.
</p>',
    2 => '<p>D\'après le chapitre 16 du livre &quot;Rapid Application Development with Mozilla&quot;, le composant XPCOM pour se connecter aux bases de données MySQL est disponible sur toute les plateformes.</p>',
  ),
  17 => 
  array (
    0 => 'C\'est mon avis un choix des développeurs d\'avoir restreint ce qu\'on peut mettre dans un tree.

L\'objet tree est optimisé pour pouvoir gérer très rapidement de grandes quantités d\'informations et le fait de pouvoir mettre tout et n\'importe quoi dedans ferait chuter considérablement les perfs.

Du coup si tu veux mettre autre chose dedans il faut tout refaire à la main, avec un grid à 2 ou n colonnes, un padding sur tous les elements "fils" et tu peux jouer avec la propriété "collapse" de "box".

En ce qui me concerne c\'est ce que j\'ai été obligé de faire.

La structure est simple : 
__une entree dans un arbre = une ligne + des lignes filles__

chaque ligne qui est un conteneur est "collapsable" et ses lignes filles  héritent du margin-left de la ligne mère.',
    1 => '<p>
C\'est mon avis un choix des développeurs d\'avoir restreint ce qu\'on peut mettre dans un tree.
</p>
<p>
L\'objet tree est optimisé pour pouvoir gérer très rapidement de grandes quantités d\'informations et le fait de pouvoir mettre tout et n\'importe quoi dedans ferait chuter considérablement les perfs.
</p>
<p>
Du coup si tu veux mettre autre chose dedans il faut tout refaire à la main, avec un grid à 2 ou n colonnes, un padding sur tous les elements &quot;fils&quot; et tu peux jouer avec la propriété &quot;collapse&quot; de &quot;box&quot;.
</p>
<p>
En ce qui me concerne c\'est ce que j\'ai été obligé de faire.
</p>
<p>
La structure est simple : 
<strong>une entree dans un arbre = une ligne + des lignes filles</strong>
</p>
<p>
chaque ligne qui est un conteneur est &quot;collapsable&quot; et ses lignes filles  héritent du margin-left de la ligne mère.
</p>',
    2 => '<p>C\'est mon avis un choix des développeurs d\'avoir restreint ce qu\'on peut mettre dans un tree.</p>

<p>L\'objet tree est optimisé pour pouvoir gérer très rapidement de grandes quantités d\'informations et le fait de pouvoir mettre tout et n\'importe quoi dedans ferait chuter considérablement les perfs.</p>

<p>Du coup si tu veux mettre autre chose dedans il faut tout refaire à la main, avec un grid à 2 ou n colonnes, un padding sur tous les elements &quot;fils&quot; et tu peux jouer avec la propriété &quot;collapse&quot; de &quot;box&quot;.</p>

<p>En ce qui me concerne c\'est ce que j\'ai été obligé de faire.</p>

<p>La structure est simple : 
<strong>une entree dans un arbre = une ligne + des lignes filles</strong></p>

<p>chaque ligne qui est un conteneur est &quot;collapsable&quot; et ses lignes filles  héritent du margin-left de la ligne mère.</p>',
  ),
  18 => 
  array (
    0 => 'je suis en train de lire le tutoriel, et suis à la partie
XPCOM (bravo les traducteurs et merci pour ce travail)
bref je cherche à tester l\'exemple de suppression/déplacement
d\'un fichier txt. Jai donc créé un fichier xul avec un simple bouton
et un autre avec le javascript faisant appel au composant XPCOM
comme décrit dans lexemple, bien sur jai lié le fichier js avec le xul
et posé ceux-ci dans un répertoire à la racine de chrome de firefox.
 
 chrome
     --> montest (dir)
           ----> montest.xul
           ----> montest.js
           ----> montest.rdf

Le bouton fonctionne bien mais cest lappel au composant qui me renvoi Une erreur.
Erreur : uncaught exception: Permission refusée d\'obtenir la propriété UnnamedClass.classes

1ere question est : est ce la bonne méthode pour testé une 
Appli xul et y a t-il des erreurs dans les chemins?

2eme question : ci-dessous le code du xul et js
y a t-il des erreurs dans le code?

3eme question: y a t-il quelque chose que je n\'ais pas pigé
et que je ne voi pas?

////////////////
montest.xul

 <?xml version="1.0" encoding="ISO-8859-1"?>
 
 <?xml-stylesheet href="chrome://global/skin/" type="text/css"?>
 
 <window
     id="copier-window"
     title="Recherche de fichiers"
     orient="horizontal"
     xmlns="http://www.mozilla.org/keymaster/gatekeeper/there.is.only.xul">
 
     <script src="montest.js" />
 
 
   <button id="copier-button"   label="Copier fichier" default="true"
   onclick="copyFile(\'C:/testfile.txt\',\'C:/PerfLogs\');" />
 </window>

//////////////////
montest.js

 function copyFile(sourcefile,destdir) {
      
      //alert(sourcefile); pour verifier l\'appel a la fonction
      
      // récupérer un composant pour le fichier à copier
      var aFile = Components.classes["@mozilla.org/file/local;1"]
          .createInstance(Components.interfaces.nsILocalFile);
      if (!aFile) return false;
       // récupérer un composant pour le répertoire où la copie va  
       // s\'effectuer.
      var aDir = Components.classes["@mozilla.org/file/local;1"]
        .createInstance(Components.interfaces.nsILocalFile);
      if (!aDir) return false;
       // ensuite, on initialise les chemins
      aFile.initWithPath(sourcefile);
      aDir.initWithPath(destdir);
      // Au final, on copie le fichier sans le renommer
      aFile.copyTo(aDir,null);
   }

///////////////
montest.rdf

 <?xml version="1.0"?>
 
 <RDF:RDF xmlns:RDF="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
          xmlns:chrome="http://www.mozilla.org/rdf/chrome#">
 
   <RDF:Seq RDF:about="urn:mozilla:package:root">
     <RDF:li RDF:resource="urn:mozilla:package:montest"/>
   </RDF:Seq>
 
   <RDF:Description RDF:about="urn:mozilla:package:montest"
           chrome:displayName="Application XPCOM"
           chrome:author="macgile"
           chrome:name="montest"
           chrome:extension="true"/>
 
 </RDF:RDF>

merci de votre aide

 macgile


',
    1 => '<p>
je suis en train de lire le tutoriel, et suis à la partie
XPCOM (bravo les traducteurs et merci pour ce travail)
bref je cherche à tester l\'exemple de suppression/déplacement
d\'un fichier txt. Jai donc créé un fichier xul avec un simple bouton
et un autre avec le javascript faisant appel au composant XPCOM
comme décrit dans lexemple, bien sur jai lié le fichier js avec le xul
et posé ceux-ci dans un répertoire à la racine de chrome de firefox.
</p>
<pre>

chrome
    --&gt; montest (dir)
          ----&gt; montest.xul
          ----&gt; montest.js
          ----&gt; montest.rdf
</pre>
<p>
Le bouton fonctionne bien mais cest lappel au composant qui me renvoi Une erreur.
Erreur : uncaught exception: Permission refusée d\'obtenir la propriété UnnamedClass.classes
</p>
<p>
1ere question est : est ce la bonne méthode pour testé une 
Appli xul et y a t-il des erreurs dans les chemins?
</p>
<p>
2eme question : ci-dessous le code du xul et js
y a t-il des erreurs dans le code?
</p>
<p>
3eme question: y a t-il quelque chose que je n\'ais pas pigé
et que je ne voi pas?
</p>
<p>
////////////////
montest.xul
</p>
<pre>
&lt;?xml version=&quot;1.0&quot; encoding=&quot;ISO-8859-1&quot;?&gt;

&lt;?xml-stylesheet href=&quot;chrome://global/skin/&quot; type=&quot;text/css&quot;?&gt;

&lt;window
    id=&quot;copier-window&quot;
    title=&quot;Recherche de fichiers&quot;
    orient=&quot;horizontal&quot;
    xmlns=&quot;http://www.mozilla.org/keymaster/gatekeeper/there.is.only.xul&quot;&gt;

    &lt;script src=&quot;montest.js&quot; /&gt;


  &lt;button id=&quot;copier-button&quot;   label=&quot;Copier fichier&quot; default=&quot;true&quot;
  onclick=&quot;copyFile(\'C:/testfile.txt\',\'C:/PerfLogs\');&quot; /&gt;
&lt;/window&gt;
</pre>
<p>
//////////////////
montest.js
</p>
<pre>
function copyFile(sourcefile,destdir) {
     
     //alert(sourcefile); pour verifier l\'appel a la fonction
     
     // récupérer un composant pour le fichier à copier
     var aFile = Components.classes[&quot;@mozilla.org/file/local;1&quot;]
         .createInstance(Components.interfaces.nsILocalFile);
     if (!aFile) return false;
      // récupérer un composant pour le répertoire où la copie va  
      // s\'effectuer.
     var aDir = Components.classes[&quot;@mozilla.org/file/local;1&quot;]
       .createInstance(Components.interfaces.nsILocalFile);
     if (!aDir) return false;
      // ensuite, on initialise les chemins
     aFile.initWithPath(sourcefile);
     aDir.initWithPath(destdir);
     // Au final, on copie le fichier sans le renommer
     aFile.copyTo(aDir,null);
  }
</pre>
<p>
///////////////
montest.rdf
</p>
<pre>
&lt;?xml version=&quot;1.0&quot;?&gt;

&lt;RDF:RDF xmlns:RDF=&quot;http://www.w3.org/1999/02/22-rdf-syntax-ns#&quot;
         xmlns:chrome=&quot;http://www.mozilla.org/rdf/chrome#&quot;&gt;

  &lt;RDF:Seq RDF:about=&quot;urn:mozilla:package:root&quot;&gt;
    &lt;RDF:li RDF:resource=&quot;urn:mozilla:package:montest&quot;/&gt;
  &lt;/RDF:Seq&gt;

  &lt;RDF:Description RDF:about=&quot;urn:mozilla:package:montest&quot;
          chrome:displayName=&quot;Application XPCOM&quot;
          chrome:author=&quot;macgile&quot;
          chrome:name=&quot;montest&quot;
          chrome:extension=&quot;true&quot;/&gt;

&lt;/RDF:RDF&gt;
</pre>
<p>
merci de votre aide
</p>
<pre>
macgile
</pre>',
    2 => '<p>je suis en train de lire le tutoriel, et suis à la partie
XPCOM (bravo les traducteurs et merci pour ce travail)
bref je cherche à tester l\'exemple de suppression/déplacement
d\'un fichier txt. Jai donc créé un fichier xul avec un simple bouton
et un autre avec le javascript faisant appel au composant XPCOM
comme décrit dans lexemple, bien sur jai lié le fichier js avec le xul
et posé ceux-ci dans un répertoire à la racine de chrome de firefox.</p>
<pre>
chrome
    --&gt; montest (dir)
          ----&gt; montest.xul
          ----&gt; montest.js
          ----&gt; montest.rdf
</pre>

<p>Le bouton fonctionne bien mais cest lappel au composant qui me renvoi Une erreur.
Erreur : uncaught exception: Permission refusée d\'obtenir la propriété UnnamedClass.classes</p>

<p>1ere question est : est ce la bonne méthode pour testé une 
Appli xul et y a t-il des erreurs dans les chemins?</p>

<p>2eme question : ci-dessous le code du xul et js
y a t-il des erreurs dans le code?</p>

<p>3eme question: y a t-il quelque chose que je n\'ais pas pigé
et que je ne voi pas?</p>

<p>////////////////
montest.xul</p>

<pre>&lt;?xml version=&quot;1.0&quot; encoding=&quot;ISO-8859-1&quot;?&gt;

&lt;?xml-stylesheet href=&quot;chrome://global/skin/&quot; type=&quot;text/css&quot;?&gt;

&lt;window
    id=&quot;copier-window&quot;
    title=&quot;Recherche de fichiers&quot;
    orient=&quot;horizontal&quot;
    xmlns=&quot;http://www.mozilla.org/keymaster/gatekeeper/there.is.only.xul&quot;&gt;

    &lt;script src=&quot;montest.js&quot; /&gt;


  &lt;button id=&quot;copier-button&quot;   label=&quot;Copier fichier&quot; default=&quot;true&quot;
  onclick=&quot;copyFile(\'C:/testfile.txt\',\'C:/PerfLogs\');&quot; /&gt;
&lt;/window&gt;
</pre>

<p>//////////////////
montest.js</p>

<pre>function copyFile(sourcefile,destdir) {
     
     //alert(sourcefile); pour verifier l\'appel a la fonction
     
     // récupérer un composant pour le fichier à copier
     var aFile = Components.classes[&quot;@mozilla.org/file/local;1&quot;]
         .createInstance(Components.interfaces.nsILocalFile);
     if (!aFile) return false;
      // récupérer un composant pour le répertoire où la copie va  
      // s\'effectuer.
     var aDir = Components.classes[&quot;@mozilla.org/file/local;1&quot;]
       .createInstance(Components.interfaces.nsILocalFile);
     if (!aDir) return false;
      // ensuite, on initialise les chemins
     aFile.initWithPath(sourcefile);
     aDir.initWithPath(destdir);
     // Au final, on copie le fichier sans le renommer
     aFile.copyTo(aDir,null);
  }
</pre>

<p>///////////////
montest.rdf</p>

<pre>&lt;?xml version=&quot;1.0&quot;?&gt;

&lt;RDF:RDF xmlns:RDF=&quot;http://www.w3.org/1999/02/22-rdf-syntax-ns#&quot;
         xmlns:chrome=&quot;http://www.mozilla.org/rdf/chrome#&quot;&gt;

  &lt;RDF:Seq RDF:about=&quot;urn:mozilla:package:root&quot;&gt;
    &lt;RDF:li RDF:resource=&quot;urn:mozilla:package:montest&quot;/&gt;
  &lt;/RDF:Seq&gt;

  &lt;RDF:Description RDF:about=&quot;urn:mozilla:package:montest&quot;
          chrome:displayName=&quot;Application XPCOM&quot;
          chrome:author=&quot;macgile&quot;
          chrome:name=&quot;montest&quot;
          chrome:extension=&quot;true&quot;/&gt;

&lt;/RDF:RDF&gt;
</pre>

<p>merci de votre aide</p>

<pre>macgile
</pre>


',
  ),
  19 => 
  array (
    0 => 'Bonjour,

j\'ai deux onglet dont le contenu est dynamique (action Struts)
le problème c\'est qu\'à l\'appel de la page, le contenu des onglets est 
aléatoire:
soit les deux onglets contiennent le résultat de l\'action avec le paramètre "onglet1"

soit les deux onglets contiennent le résultat de l\'action avec le paramètre "onglet2"

soit l\'onglet 1 contient le résultat de l\'action avec le paramètre "onglet2" et l\'onglet 2 contient le résultat de l\'action avec le paramètre "onglet1"

etc...

voici mon code:

<tabcontrol>
 <tabbox align="start">
  <tabs>
   <tab label="onglet1" selected="true"/>
   <tab label="onglet2"/>
  </tabs>
  <tabpanels>
   <tabpanel id="onglet1" orient="vertical">
     <iframe src="action.do?type=onglet1" width="1024" height="550"/>
   </tabpanel>
   <tabpanel id="onglet2" orient="vertical">
     <iframe src="action.do?type=onglet2" width="1024" height="550"/>
   </tabpanel>
  </tabpanels>
 </tabbox>
</tabcontrol>

merci pour votre aide.
',
    1 => '<p>
Bonjour,
</p>
<p>
j\'ai deux onglet dont le contenu est dynamique (action Struts)
le problème c\'est qu\'à l\'appel de la page, le contenu des onglets est 
aléatoire:
soit les deux onglets contiennent le résultat de l\'action avec le paramètre &quot;onglet1&quot;
</p>
<p>
soit les deux onglets contiennent le résultat de l\'action avec le paramètre &quot;onglet2&quot;
</p>
<p>
soit l\'onglet 1 contient le résultat de l\'action avec le paramètre &quot;onglet2&quot; et l\'onglet 2 contient le résultat de l\'action avec le paramètre &quot;onglet1&quot;
</p>
<p>
etc...
</p>
<p>
voici mon code:
</p>
<p>
&lt;tabcontrol&gt;
</p>
<pre>
&lt;tabbox align=&quot;start&quot;&gt;
 &lt;tabs&gt;
  &lt;tab label=&quot;onglet1&quot; selected=&quot;true&quot;/&gt;
  &lt;tab label=&quot;onglet2&quot;/&gt;
 &lt;/tabs&gt;
 &lt;tabpanels&gt;
  &lt;tabpanel id=&quot;onglet1&quot; orient=&quot;vertical&quot;&gt;
    &lt;iframe src=&quot;action.do?type=onglet1&quot; width=&quot;1024&quot; height=&quot;550&quot;/&gt;
  &lt;/tabpanel&gt;
  &lt;tabpanel id=&quot;onglet2&quot; orient=&quot;vertical&quot;&gt;
    &lt;iframe src=&quot;action.do?type=onglet2&quot; width=&quot;1024&quot; height=&quot;550&quot;/&gt;
  &lt;/tabpanel&gt;
 &lt;/tabpanels&gt;
&lt;/tabbox&gt;
</pre>
<p>
&lt;/tabcontrol&gt;
</p>
<p>
merci pour votre aide.
</p>',
    2 => '<p>Bonjour,</p>

<p>j\'ai deux onglet dont le contenu est dynamique (action Struts)
le problème c\'est qu\'à l\'appel de la page, le contenu des onglets est 
aléatoire:
soit les deux onglets contiennent le résultat de l\'action avec le paramètre &quot;onglet1&quot;</p>

<p>soit les deux onglets contiennent le résultat de l\'action avec le paramètre &quot;onglet2&quot;</p>

<p>soit l\'onglet 1 contient le résultat de l\'action avec le paramètre &quot;onglet2&quot; et l\'onglet 2 contient le résultat de l\'action avec le paramètre &quot;onglet1&quot;</p>

<p>etc...</p>

<p>voici mon code:</p>

<p>&lt;tabcontrol&gt;</p>
<pre>&lt;tabbox align=&quot;start&quot;&gt;
 &lt;tabs&gt;
  &lt;tab label=&quot;onglet1&quot; selected=&quot;true&quot;/&gt;
  &lt;tab label=&quot;onglet2&quot;/&gt;
 &lt;/tabs&gt;
 &lt;tabpanels&gt;
  &lt;tabpanel id=&quot;onglet1&quot; orient=&quot;vertical&quot;&gt;
    &lt;iframe src=&quot;action.do?type=onglet1&quot; width=&quot;1024&quot; height=&quot;550&quot;/&gt;
  &lt;/tabpanel&gt;
  &lt;tabpanel id=&quot;onglet2&quot; orient=&quot;vertical&quot;&gt;
    &lt;iframe src=&quot;action.do?type=onglet2&quot; width=&quot;1024&quot; height=&quot;550&quot;/&gt;
  &lt;/tabpanel&gt;
 &lt;/tabpanels&gt;
&lt;/tabbox&gt;
</pre>
<p>&lt;/tabcontrol&gt;</p>

<p>merci pour votre aide.</p>
',
  ),
  20 => 
  array (
    0 => 'Pour le .exe, je ne peux pas tester, j\'ai pas de windows.

Peux tu expliciter plus clairement ton projet ? je ne vois pas trop l\'interet du truc.
',
    1 => '<p>
Pour le .exe, je ne peux pas tester, j\'ai pas de windows.
</p>
<p>
Peux tu expliciter plus clairement ton projet ? je ne vois pas trop l\'interet du truc.
</p>',
    2 => '<p>Pour le .exe, je ne peux pas tester, j\'ai pas de windows.</p>

<p>Peux tu expliciter plus clairement ton projet ? je ne vois pas trop l\'interet du truc.</p>
',
  ),
  21 => 
  array (
    0 => 'OK pour le SVG, mais pour le support 3D ? mozilla en est où ???',
    1 => '<p>
OK pour le SVG, mais pour le support 3D ? mozilla en est où ???
</p>',
    2 => '<p>OK pour le SVG, mais pour le support 3D ? mozilla en est où ???</p>',
  ),
  22 => 
  array (
    0 => 'Bonjour à tous et bonne année !

Je souhaite réaliser une petite appli xul utilisant un "Canvas" SVG.
Je souhaite incorporer dans une page xul plusieurs scrollbox contenant du SVG.

Par exemple avoir une présentation de ce genre :

 -------------------------------
     Toolbar
 -------------------------------
 +-----------------+
 |                 |  Label1 : xx
 |   SVG           |  Label2 : yy
 |                 |
 +-----------------+      BP OK
 --------------------------------
      Status bar
 --------------------------------

Je ne vois pas dans quel objet inclure mon bloc de SVG...
Pour faire bien il me faudrait une scrollbox par exemple, mais sur
mes derniers tests, j\'arrive juste a faire planter mozilla.

Quelqu\'un à une idée ? un exemple ? des pointeurs vers de la doc ?

Merci !',
    1 => '<p>
Bonjour à tous et bonne année !
</p>
<p>
Je souhaite réaliser une petite appli xul utilisant un &quot;Canvas&quot; SVG.
Je souhaite incorporer dans une page xul plusieurs scrollbox contenant du SVG.
</p>
<p>
Par exemple avoir une présentation de ce genre :
</p>
<pre>
-------------------------------
    Toolbar
-------------------------------
+-----------------+
|                 |  Label1 : xx
|   SVG           |  Label2 : yy
|                 |
+-----------------+      BP OK
--------------------------------
     Status bar
--------------------------------
</pre>
<p>
Je ne vois pas dans quel objet inclure mon bloc de SVG...
Pour faire bien il me faudrait une scrollbox par exemple, mais sur
mes derniers tests, j\'arrive juste a faire planter mozilla.
</p>
<p>
Quelqu\'un à une idée ? un exemple ? des pointeurs vers de la doc ?
</p>
<p>
Merci !
</p>',
    2 => '<p>Bonjour à tous et bonne année !</p>

<p>Je souhaite réaliser une petite appli xul utilisant un &quot;Canvas&quot; SVG.
Je souhaite incorporer dans une page xul plusieurs scrollbox contenant du SVG.</p>

<p>Par exemple avoir une présentation de ce genre :</p>

<pre>-------------------------------
    Toolbar
-------------------------------
+-----------------+
|                 |  Label1 : xx
|   SVG           |  Label2 : yy
|                 |
+-----------------+      BP OK
--------------------------------
     Status bar
--------------------------------
</pre>

<p>Je ne vois pas dans quel objet inclure mon bloc de SVG...
Pour faire bien il me faudrait une scrollbox par exemple, mais sur
mes derniers tests, j\'arrive juste a faire planter mozilla.</p>

<p>Quelqu\'un à une idée ? un exemple ? des pointeurs vers de la doc ?</p>

<p>Merci !</p>',
  ),
  23 => 
  array (
    0 => 'Bonjour,
je pense que je pose une question vraiment très basique mais je n\'ai pas encore trouvé la réponse.
Je developpe une petite extension qui charge une page, remplis un questionnaire et le "submit". Le problème c\'est qu\'entre l\'appel au chargement de la page et le remplissage du questionnaire ca va trop vite. J\'entends par la que mon extension veut dejà remplir les champs alors que la page n\'a pas été chargé dans firefox. Comment je peux lui dire d\'attendre la fin de chargement de la page ? 
J\'epsere avoir été clair et merci d\'avance.

',
    1 => '<p>
Bonjour,
je pense que je pose une question vraiment très basique mais je n\'ai pas encore trouvé la réponse.
Je developpe une petite extension qui charge une page, remplis un questionnaire et le &quot;submit&quot;. Le problème c\'est qu\'entre l\'appel au chargement de la page et le remplissage du questionnaire ca va trop vite. J\'entends par la que mon extension veut dejà remplir les champs alors que la page n\'a pas été chargé dans firefox. Comment je peux lui dire d\'attendre la fin de chargement de la page ? 
J\'epsere avoir été clair et merci d\'avance.
</p>',
    2 => '<p>Bonjour,
je pense que je pose une question vraiment très basique mais je n\'ai pas encore trouvé la réponse.
Je developpe une petite extension qui charge une page, remplis un questionnaire et le &quot;submit&quot;. Le problème c\'est qu\'entre l\'appel au chargement de la page et le remplissage du questionnaire ca va trop vite. J\'entends par la que mon extension veut dejà remplir les champs alors que la page n\'a pas été chargé dans firefox. Comment je peux lui dire d\'attendre la fin de chargement de la page ? 
J\'epsere avoir été clair et merci d\'avance.</p>

',
  ),
  24 => 
  array (
    0 => 'oui ça marche ça mais j\'aimerais bien pouvoir recueperer l\'objet XMLdocument histoire de pouvoir naviguer dans l\'arbre. et lorsque je fais getElementsByTagName bah j\'ai une erreur. En fait j\'ai une erreur à chaque fois que j\'essaye d\'executer une méthode de l\'objet XMLdocument ou bien d\'acceder à un attribut.',
    1 => '<p>
oui ça marche ça mais j\'aimerais bien pouvoir recueperer l\'objet XMLdocument histoire de pouvoir naviguer dans l\'arbre. et lorsque je fais getElementsByTagName bah j\'ai une erreur. En fait j\'ai une erreur à chaque fois que j\'essaye d\'executer une méthode de l\'objet XMLdocument ou bien d\'acceder à un attribut.
</p>',
    2 => '<p>oui ça marche ça mais j\'aimerais bien pouvoir recueperer l\'objet XMLdocument histoire de pouvoir naviguer dans l\'arbre. et lorsque je fais getElementsByTagName bah j\'ai une erreur. En fait j\'ai une erreur à chaque fois que j\'essaye d\'executer une méthode de l\'objet XMLdocument ou bien d\'acceder à un attribut.</p>',
  ),
  25 => 
  array (
    0 => 'Bon j\'ai trouvé en fait c\'est tout bête ...

 top.document.getElementById(\'content\')',
    1 => '<p>
Bon j\'ai trouvé en fait c\'est tout bête ...
</p>
<pre>
top.document.getElementById(\'content\')
</pre>',
    2 => '<p>Bon j\'ai trouvé en fait c\'est tout bête ...</p>

<pre>top.document.getElementById(\'content\')
</pre>',
  ),
  26 => 
  array (
    0 => 'D\'accord avec toi si on considère le contenu comme une liste, ce qu\'il doit être au fond. Mais on pourrait imaginer un système d\'exclusion, où l\'on dirait dans la classe fille les éléments que l\'on ne veut pas garder, mais je chipotte :-)

En  tous cas merci de tes précieux conseils, je les testes, dès que possible (j\'ai autre chose sur le feu) et je te tiens au courant.

Nicolas',
    1 => '<p>
D\'accord avec toi si on considère le contenu comme une liste, ce qu\'il doit être au fond. Mais on pourrait imaginer un système d\'exclusion, où l\'on dirait dans la classe fille les éléments que l\'on ne veut pas garder, mais je chipotte <img src="laugh.png" alt=":-)"/>
</p>
<p>
En  tous cas merci de tes précieux conseils, je les testes, dès que possible (j\'ai autre chose sur le feu) et je te tiens au courant.
</p>
<p>
Nicolas
</p>',
    2 => '<p>D\'accord avec toi si on considère le contenu comme une liste, ce qu\'il doit être au fond. Mais on pourrait imaginer un système d\'exclusion, où l\'on dirait dans la classe fille les éléments que l\'on ne veut pas garder, mais je chipotte <img src="laugh.png" alt=":-)"/></p>

<p>En  tous cas merci de tes précieux conseils, je les testes, dès que possible (j\'ai autre chose sur le feu) et je te tiens au courant.</p>

<p>Nicolas</p>',
  ),
  27 => 
  array (
    0 => 'Jim a écrit:

>Merci pour la publicité libre ! ! !
>
>
>http://www.xugle.com
>

De rien :-))
C\'est juste le nom de code pour le développement en interne ;-), je changerai de nom quand mon extension sera prête. C\'est dommage ça me plaisait bien comme nom :-(.

David',
    1 => '<p>
Jim a écrit:
</p>
<blockquote>
<p>
Merci pour la publicité libre ! ! !


http://www.xugle.com

</p></blockquote>
<p>
De rien <img src="laugh.png" alt=":-)"/>)
C\'est juste le nom de code pour le développement en interne ;-), je changerai de nom quand mon extension sera prête. C\'est dommage ça me plaisait bien comme nom :-(.
</p>
<p>
David
</p>',
    2 => '<p>Jim a écrit:</p>

<blockquote>
<p>Merci pour la publicité libre ! ! !


http://www.xugle.com
</p></blockquote>

<p>De rien <img src="laugh.png" alt=":-)"/>)
C\'est juste le nom de code pour le développement en interne ;-), je changerai de nom quand mon extension sera prête. C\'est dommage ça me plaisait bien comme nom :-(.</p>

<p>David</p>',
  ),
  28 => 
  array (
    0 => 'Le projet n\'est pas mort !
l\'état du projet a été remis a jour le 17 mai, et certains fichiers ont été retouchés il y a 2 jours sur le cvs.

Mais comme indiqué sur la page d\'accueil : ^^Until more contributors come forward to apply themselves to this project this may be all there is.|en-US|http://xulmaker.mozdev.org/ ^^
',
    1 => '<p>
Le projet n\'est pas mort !
l\'état du projet a été remis a jour le 17 mai, et certains fichiers ont été retouchés il y a 2 jours sur le cvs.
</p>
<p>
Mais comme indiqué sur la page d\'accueil : <q lang="en-US" cite="http://xulmaker.mozdev.org/ ">Until more contributors come forward to apply themselves to this project this may be all there is.</q>
</p>',
    2 => '<p>Le projet n\'est pas mort !
l\'état du projet a été remis a jour le 17 mai, et certains fichiers ont été retouchés il y a 2 jours sur le cvs.</p>

<p>Mais comme indiqué sur la page d\'accueil : <q lang="en-US" cite="http://xulmaker.mozdev.org/ ">Until more contributors come forward to apply themselves to this project this may be all there is.</q></p>
',
  ),
  29 => 
  array (
    0 => 'C\'est une bonne idée mais ça risque d\'être compliqué...

Il y a des modifs dans:
- mozconfig
- configure.in
- Makefile.in
- config/autoconf.mk.in
- allmakefiles.sh
- toolkit/components/Makefile.in
- xpfe/components/Makefile.in

Et toute l\'appli dans un répertoire avec des trucs du genre:
- HelloWorld/
- HelloWorld/app/
- HelloWorld/base/
- HelloWorld/components/

Après base/ (qui contient l\'ui) et components/ (pour les composants XPCom, il y a au moins un pour enregistrer l\'appli et sa ligne de commande) sont à modifier pour faire une appli. Le nom, l\'uuid et les autres détails sont dans mon .mozconfig.

Je ne sais pas trop comment détailler tout ça dans le wiki.

Sinon le tarball des fichiers cités ci-dessus est là: [http://fynl.free.fr/vrac/MozStandAlone.tar.gz]
ça marche sur le source nvu-0.60 et sous linux, j\'ai pas essayé d\'autres architectures mais il doit certainement manquer des bricoles.
',
    1 => '<p>
C\'est une bonne idée mais ça risque d\'être compliqué...
</p>
<p>
Il y a des modifs dans:
</p>
<ul>

<li> mozconfig
</li>
<li> configure.in
</li>
<li> Makefile.in
</li>
<li> config/autoconf.mk.in
</li>
<li> allmakefiles.sh
</li>
<li> toolkit/components/Makefile.in
</li>
<li> xpfe/components/Makefile.in
</li>
</ul>

<p>
Et toute l\'appli dans un répertoire avec des trucs du genre:
</p>
<ul>

<li> HelloWorld/
</li>
<li> HelloWorld/app/
</li>
<li> HelloWorld/base/
</li>
<li> HelloWorld/components/
</li>
</ul>

<p>
Après base/ (qui contient l\'ui) et components/ (pour les composants XPCom, il y a au moins un pour enregistrer l\'appli et sa ligne de commande) sont à modifier pour faire une appli. Le nom, l\'uuid et les autres détails sont dans mon .mozconfig.
</p>
<p>
Je ne sais pas trop comment détailler tout ça dans le wiki.
</p>
<p>
Sinon le tarball des fichiers cités ci-dessus est là: <a href="http://fynl.free.fr/vrac/MozStandAlone.tar.gz">http://fynl.free.fr/vrac/MozStandAlone.t(..)</a>
ça marche sur le source nvu-0.60 et sous linux, j\'ai pas essayé d\'autres architectures mais il doit certainement manquer des bricoles.
</p>',
    2 => '<p>C\'est une bonne idée mais ça risque d\'être compliqué...</p>

<p>Il y a des modifs dans:</p>
<ul>
<li>mozconfig</li>
<li>configure.in</li>
<li>Makefile.in</li>
<li>config/autoconf.mk.in</li>
<li>allmakefiles.sh</li>
<li>toolkit/components/Makefile.in</li>
<li>xpfe/components/Makefile.in</li>
</ul>

<p>Et toute l\'appli dans un répertoire avec des trucs du genre:</p>
<ul>
<li>HelloWorld/</li>
<li>HelloWorld/app/</li>
<li>HelloWorld/base/</li>
<li>HelloWorld/components/</li>
</ul>

<p>Après base/ (qui contient l\'ui) et components/ (pour les composants XPCom, il y a au moins un pour enregistrer l\'appli et sa ligne de commande) sont à modifier pour faire une appli. Le nom, l\'uuid et les autres détails sont dans mon .mozconfig.</p>

<p>Je ne sais pas trop comment détailler tout ça dans le wiki.</p>

<p>Sinon le tarball des fichiers cités ci-dessus est là: <a href="http://fynl.free.fr/vrac/MozStandAlone.tar.gz">http://fynl.free.fr/vrac/MozStandAlone.t(..)</a>
ça marche sur le source nvu-0.60 et sous linux, j\'ai pas essayé d\'autres architectures mais il doit certainement manquer des bricoles.</p>
',
  ),
  30 => 
  array (
    0 => 'Bonsoir à tous !
Pour m\'initier à XUL j\'aimerai créer une petite appli web dont le thème serait __totalement__ indépendant du thème utilisateur.
Existe-t-il un moyen de ne pas hériter des règles CSS de ce dernier ?
Merci bien.',
    1 => '<p>
Bonsoir à tous !
Pour m\'initier à XUL j\'aimerai créer une petite appli web dont le thème serait <strong>totalement</strong> indépendant du thème utilisateur.
Existe-t-il un moyen de ne pas hériter des règles CSS de ce dernier ?
Merci bien.
</p>',
    2 => '<p>Bonsoir à tous !
Pour m\'initier à XUL j\'aimerai créer une petite appli web dont le thème serait <strong>totalement</strong> indépendant du thème utilisateur.
Existe-t-il un moyen de ne pas hériter des règles CSS de ce dernier ?
Merci bien.</p>',
  ),
  31 => 
  array (
    0 => 'salut,

j\'ai eu le même pb lorsque je me suis mis au xul.

En fait il faut paramétrer Apache pour exécuter des fichiers xul.
%%%Dans le fichier @@__httpd.conf__@@, il faut ajouter : 

@@__AddType application/vnd.mozilla.xul+xml xul__@@

redémarre ton serveur et normalement tu verras une jolie fenêtre xul.

',
    1 => '<p>
salut,
</p>
<p>
j\'ai eu le même pb lorsque je me suis mis au xul.
</p>
<p>
En fait il faut paramétrer Apache pour exécuter des fichiers xul.
<br />Dans le fichier <code><strong>httpd.conf</strong></code>, il faut ajouter : 
</p>
<p>
<code><strong>AddType application/vnd.mozilla.xul+xml xul</strong></code>
</p>
<p>
redémarre ton serveur et normalement tu verras une jolie fenêtre xul.
</p>',
    2 => '<p>salut,</p>

<p>j\'ai eu le même pb lorsque je me suis mis au xul.</p>

<p>En fait il faut paramétrer Apache pour exécuter des fichiers xul.
<br />Dans le fichier <code><strong>httpd.conf</strong></code>, il faut ajouter : </p>

<p><code><strong>AddType application/vnd.mozilla.xul+xml xul</strong></code></p>

<p>redémarre ton serveur et normalement tu verras une jolie fenêtre xul.</p>

',
  ),
  32 => 
  array (
    0 => 'Voilà comme mes utilisateurs sont sous OSX, j\'aurais aimer pouvoir créer un mac alias du genre ./mozilla -chrome chrome://mon_application/content/

avec la File.macAlias() vers le desktop de celui ci, si quelqu\'un peut m\'aider je suis preneur.

merci par avance.',
    1 => '<p>
Voilà comme mes utilisateurs sont sous OSX, j\'aurais aimer pouvoir créer un mac alias du genre ./mozilla -chrome chrome://mon_application/content/
</p>
<p>
avec la File.macAlias() vers le desktop de celui ci, si quelqu\'un peut m\'aider je suis preneur.
</p>
<p>
merci par avance.
</p>',
    2 => '<p>Voilà comme mes utilisateurs sont sous OSX, j\'aurais aimer pouvoir créer un mac alias du genre ./mozilla -chrome chrome://mon_application/content/</p>

<p>avec la File.macAlias() vers le desktop de celui ci, si quelqu\'un peut m\'aider je suis preneur.</p>

<p>merci par avance.</p>',
  ),
  33 => 
  array (
    0 => 'Tout dépend ce que tu veux réaliser :

- réaliser une application qui necessite Mozilla (comme xulmaker par exemple)
- réaliser une application autonome, embarquant la plateforme


Dans le premier cas, tu peux effectivement avoir quelques soucis de compatibilité. Le jeu de balise XUL évolue sans cesse (même si il tend à se stabiliser). C\'est malheureusement un choix des développeurs de mozilla. Mais ça va changer.
Maintenant, il n\'y a pas non plus de gros changements entre les versions.. Il faut juste faire attention aux quelques différences.

Dans le deuxième cas : le problème ne se pose même pas. Tu te choisi une version et basta.


',
    1 => '<p>
Tout dépend ce que tu veux réaliser :
</p>
<ul>

<li> réaliser une application qui necessite Mozilla (comme xulmaker par exemple)
</li>
<li> réaliser une application autonome, embarquant la plateforme
</li>
</ul>

<p>
Dans le premier cas, tu peux effectivement avoir quelques soucis de compatibilité. Le jeu de balise XUL évolue sans cesse (même si il tend à se stabiliser). C\'est malheureusement un choix des développeurs de mozilla. Mais ça va changer.
Maintenant, il n\'y a pas non plus de gros changements entre les versions.. Il faut juste faire attention aux quelques différences.
</p>
<p>
Dans le deuxième cas : le problème ne se pose même pas. Tu te choisi une version et basta.
</p>',
    2 => '<p>Tout dépend ce que tu veux réaliser :</p>

<ul>
<li>réaliser une application qui necessite Mozilla (comme xulmaker par exemple)</li>
<li>réaliser une application autonome, embarquant la plateforme</li>
</ul>


<p>Dans le premier cas, tu peux effectivement avoir quelques soucis de compatibilité. Le jeu de balise XUL évolue sans cesse (même si il tend à se stabiliser). C\'est malheureusement un choix des développeurs de mozilla. Mais ça va changer.
Maintenant, il n\'y a pas non plus de gros changements entre les versions.. Il faut juste faire attention aux quelques différences.</p>

<p>Dans le deuxième cas : le problème ne se pose même pas. Tu te choisi une version et basta.</p>


',
  ),
  34 => 
  array (
    0 => 'Hello,

je reprends mon XUL pour faire une interface utilisateur pour MapServer (c\'est pour le taff mais si j\'obtiens un truc correct, je publie).
Problème pour lequel je n\'ai pas trouvé de solution: j\'ai besoin d\'avoir des cellules d\'arbre clickables. On retrouve ce genre de cellules dans messenger.jar dans la gestion des mails indésirables (un clic, je dis que ce mail est un spam (logo poubelle), un autre click, je dis que ce mail n\'est pas un spam (logo point)), ou encore dans la gestion des filtres (filtre actif = image de checkbox validée; filtre inactif = image de checkbox vide).
URL de ces images pour mieux se représenter:
chrome://global/skin/checkbox/cbox.gif
chrome://global/skin/checkbox/cbox-check.gif

D\'après la ref XULPlanet, je peux ajouter l\'attribut cycler="true" à une treecol et c\'est censé indiquer que l\'élément est cliquable (ou du moins, prend alternativement une valeur). Je n\'ai pas trouvé d\'exemple parlant ni de code qui l\'utilise. L\'attribut checkbox d\'une treecol ne fonctionne pas avec ma version de mozilla (Debian Sarge -> Moz1.6).

De plus, en essayant de monter un truc moi même, je me suis rendu compte qu\'il m\'est impossible de récupérer les attributs d\'une cellule référencée par un numéro de ligne (row) et une colonne via la fonction getCellValue. Si quelqu\'un sait comment faire (et aussi comment modifier ces attributs), je prends...

Sinon ,j\'ai une autre solution qui est directement copiée du fonctionnement de Mozilla: j\'utilise un RDF local pour l\'arbre; quand je clique , je modifie le RDF par XPCOM et je rafraichis l\'arbre après la modif. Le problème est que cette technique est assez lourde (du moins, ça m\'a l\'air d\'être complexe pour pas grand chose).

Si vous avez besoin de précisions, n\'hésitez pas à demander...

Merci d\'avance pour vos réponses !',
    1 => '<p>
Hello,
</p>
<p>
je reprends mon XUL pour faire une interface utilisateur pour MapServer (c\'est pour le taff mais si j\'obtiens un truc correct, je publie).
Problème pour lequel je n\'ai pas trouvé de solution: j\'ai besoin d\'avoir des cellules d\'arbre clickables. On retrouve ce genre de cellules dans messenger.jar dans la gestion des mails indésirables (un clic, je dis que ce mail est un spam (logo poubelle), un autre click, je dis que ce mail n\'est pas un spam (logo point)), ou encore dans la gestion des filtres (filtre actif = image de checkbox validée; filtre inactif = image de checkbox vide).
URL de ces images pour mieux se représenter:
chrome://global/skin/checkbox/cbox.gif
chrome://global/skin/checkbox/cbox-check.gif
</p>
<p>
D\'après la ref XULPlanet, je peux ajouter l\'attribut cycler=&quot;true&quot; à une treecol et c\'est censé indiquer que l\'élément est cliquable (ou du moins, prend alternativement une valeur). Je n\'ai pas trouvé d\'exemple parlant ni de code qui l\'utilise. L\'attribut checkbox d\'une treecol ne fonctionne pas avec ma version de mozilla (Debian Sarge -&gt; Moz1.6).
</p>
<p>
De plus, en essayant de monter un truc moi même, je me suis rendu compte qu\'il m\'est impossible de récupérer les attributs d\'une cellule référencée par un numéro de ligne (row) et une colonne via la fonction getCellValue. Si quelqu\'un sait comment faire (et aussi comment modifier ces attributs), je prends...
</p>
<p>
Sinon ,j\'ai une autre solution qui est directement copiée du fonctionnement de Mozilla: j\'utilise un RDF local pour l\'arbre; quand je clique , je modifie le RDF par XPCOM et je rafraichis l\'arbre après la modif. Le problème est que cette technique est assez lourde (du moins, ça m\'a l\'air d\'être complexe pour pas grand chose).
</p>
<p>
Si vous avez besoin de précisions, n\'hésitez pas à demander...
</p>
<p>
Merci d\'avance pour vos réponses !
</p>',
    2 => '<p>Hello,</p>

<p>je reprends mon XUL pour faire une interface utilisateur pour MapServer (c\'est pour le taff mais si j\'obtiens un truc correct, je publie).
Problème pour lequel je n\'ai pas trouvé de solution: j\'ai besoin d\'avoir des cellules d\'arbre clickables. On retrouve ce genre de cellules dans messenger.jar dans la gestion des mails indésirables (un clic, je dis que ce mail est un spam (logo poubelle), un autre click, je dis que ce mail n\'est pas un spam (logo point)), ou encore dans la gestion des filtres (filtre actif = image de checkbox validée; filtre inactif = image de checkbox vide).
URL de ces images pour mieux se représenter:
chrome://global/skin/checkbox/cbox.gif
chrome://global/skin/checkbox/cbox-check.gif</p>

<p>D\'après la ref XULPlanet, je peux ajouter l\'attribut cycler=&quot;true&quot; à une treecol et c\'est censé indiquer que l\'élément est cliquable (ou du moins, prend alternativement une valeur). Je n\'ai pas trouvé d\'exemple parlant ni de code qui l\'utilise. L\'attribut checkbox d\'une treecol ne fonctionne pas avec ma version de mozilla (Debian Sarge -&gt; Moz1.6).</p>

<p>De plus, en essayant de monter un truc moi même, je me suis rendu compte qu\'il m\'est impossible de récupérer les attributs d\'une cellule référencée par un numéro de ligne (row) et une colonne via la fonction getCellValue. Si quelqu\'un sait comment faire (et aussi comment modifier ces attributs), je prends...</p>

<p>Sinon ,j\'ai une autre solution qui est directement copiée du fonctionnement de Mozilla: j\'utilise un RDF local pour l\'arbre; quand je clique , je modifie le RDF par XPCOM et je rafraichis l\'arbre après la modif. Le problème est que cette technique est assez lourde (du moins, ça m\'a l\'air d\'être complexe pour pas grand chose).</p>

<p>Si vous avez besoin de précisions, n\'hésitez pas à demander...</p>

<p>Merci d\'avance pour vos réponses !</p>',
  ),
  35 => 
  array (
    0 => 'Ce qu\'il y a d\'amusant, c\'est qu\'ils se privent des utilisateurs de MS Win XP, puisque le site n\'est accessible qu\'au MS Win SE et supérieurs, c\'est à dire le ci-nommé et MS Win Me ;)',
    1 => '<p>
Ce qu\'il y a d\'amusant, c\'est qu\'ils se privent des utilisateurs de MS Win XP, puisque le site n\'est accessible qu\'au MS Win SE et supérieurs, c\'est à dire le ci-nommé et MS Win Me ;)
</p>',
    2 => '<p>Ce qu\'il y a d\'amusant, c\'est qu\'ils se privent des utilisateurs de MS Win XP, puisque le site n\'est accessible qu\'au MS Win SE et supérieurs, c\'est à dire le ci-nommé et MS Win Me ;)</p>',
  ),
  36 => 
  array (
    0 => 'Bonjour, 

Je débute tout juste en XUL et j\'essaye de l\'utiliser pour créer une AppliWeb. Pas de problème pour créer l\'interace. Maintenant, j\'attaque la gestion des comportements... 

Mon problème du moment est le suivant : J\'ai créé un TREE contenant 4 colone (TREECOLS). J\'aimerai pouvoir faire en sorte que le contenu de mes colones se trie par ordre alphabétique lorsqu\'on clique sur l\'entete de la colone. Je suppose qu\'il faut utiliser les attributs "sortActive", "sortDirection" et "sort". Les quelques test que j\'ai fait jusqu\'a présent n\'on rien donné. J\'ai un peu de mal à comprendre comment ça marche, surtout "sort".

Si vous aviez quelques piste de recherche, ce serait pas de refus. Merci.',
    1 => '<p>
Bonjour, 
</p>
<p>
Je débute tout juste en XUL et j\'essaye de l\'utiliser pour créer une AppliWeb. Pas de problème pour créer l\'interace. Maintenant, j\'attaque la gestion des comportements... 
</p>
<p>
Mon problème du moment est le suivant : J\'ai créé un TREE contenant 4 colone (TREECOLS). J\'aimerai pouvoir faire en sorte que le contenu de mes colones se trie par ordre alphabétique lorsqu\'on clique sur l\'entete de la colone. Je suppose qu\'il faut utiliser les attributs &quot;sortActive&quot;, &quot;sortDirection&quot; et &quot;sort&quot;. Les quelques test que j\'ai fait jusqu\'a présent n\'on rien donné. J\'ai un peu de mal à comprendre comment ça marche, surtout &quot;sort&quot;.
</p>
<p>
Si vous aviez quelques piste de recherche, ce serait pas de refus. Merci.
</p>',
    2 => '<p>Bonjour, </p>

<p>Je débute tout juste en XUL et j\'essaye de l\'utiliser pour créer une AppliWeb. Pas de problème pour créer l\'interace. Maintenant, j\'attaque la gestion des comportements... </p>

<p>Mon problème du moment est le suivant : J\'ai créé un TREE contenant 4 colone (TREECOLS). J\'aimerai pouvoir faire en sorte que le contenu de mes colones se trie par ordre alphabétique lorsqu\'on clique sur l\'entete de la colone. Je suppose qu\'il faut utiliser les attributs &quot;sortActive&quot;, &quot;sortDirection&quot; et &quot;sort&quot;. Les quelques test que j\'ai fait jusqu\'a présent n\'on rien donné. J\'ai un peu de mal à comprendre comment ça marche, surtout &quot;sort&quot;.</p>

<p>Si vous aviez quelques piste de recherche, ce serait pas de refus. Merci.</p>',
  ),
  37 => 
  array (
    0 => 'Bon je n\'ai pas eu besoin de ta fonction...

J\'ai cherché aussi de mon côté. Voici la fonction que j\'ai obtenue :

 var xmlrequete;
 try {
	xmlrequete = new XMLHttpRequest();
  } catch (e) {
     alert("Erreur interne, désolé !\\n");
  } 
 
 function test (){
	if (xmlrequete.readyState==4) {
		var liste_notes  = xmlrequete.responseXML.getElementsByTagName ("note");
		var nombre_notes = liste_notes.length;
		alert("Il y a " + nombre_notes + " notes");
		for (var i = 0; i != nombre_notes; i++){
			var note = liste_notes.item(i);
			alert("Titre : " + note.getAttribute("titre"));
			alert("Texte : " + note.textContent);
		}
	}
 } 
 xmlrequete.open("GET", "get_notes.php");
 xmlrequete.onreadystatechange=test;
 xmlrequete.send(null);

Merci beaucoup à vous... et aussi énormément au débuggeur Javascript intégré à mozilla qui est juste... génial !!!',
    1 => '<p>
Bon je n\'ai pas eu besoin de ta fonction...
</p>
<p>
J\'ai cherché aussi de mon côté. Voici la fonction que j\'ai obtenue :
</p>
<pre>
var xmlrequete;
try {
xmlrequete = new XMLHttpRequest();
 } catch (e) {
    alert(&quot;Erreur interne, désolé !\\n&quot;);
 } 

function test (){
if (xmlrequete.readyState==4) {
	var liste_notes  = xmlrequete.responseXML.getElementsByTagName (&quot;note&quot;);
	var nombre_notes = liste_notes.length;
	alert(&quot;Il y a &quot; + nombre_notes + &quot; notes&quot;);
	for (var i = 0; i != nombre_notes; i++){
		var note = liste_notes.item(i);
		alert(&quot;Titre : &quot; + note.getAttribute(&quot;titre&quot;));
		alert(&quot;Texte : &quot; + note.textContent);
	}
}
} 
xmlrequete.open(&quot;GET&quot;, &quot;get_notes.php&quot;);
xmlrequete.onreadystatechange=test;
xmlrequete.send(null);
</pre>
<p>
Merci beaucoup à vous... et aussi énormément au débuggeur Javascript intégré à mozilla qui est juste... génial !!!
</p>',
    2 => '<p>Bon je n\'ai pas eu besoin de ta fonction...</p>

<p>J\'ai cherché aussi de mon côté. Voici la fonction que j\'ai obtenue :</p>

<pre>var xmlrequete;
try {
xmlrequete = new XMLHttpRequest();
 } catch (e) {
    alert(&quot;Erreur interne, désolé !\\n&quot;);
 } 

function test (){
if (xmlrequete.readyState==4) {
	var liste_notes  = xmlrequete.responseXML.getElementsByTagName (&quot;note&quot;);
	var nombre_notes = liste_notes.length;
	alert(&quot;Il y a &quot; + nombre_notes + &quot; notes&quot;);
	for (var i = 0; i != nombre_notes; i++){
		var note = liste_notes.item(i);
		alert(&quot;Titre : &quot; + note.getAttribute(&quot;titre&quot;));
		alert(&quot;Texte : &quot; + note.textContent);
	}
}
} 
xmlrequete.open(&quot;GET&quot;, &quot;get_notes.php&quot;);
xmlrequete.onreadystatechange=test;
xmlrequete.send(null);
</pre>

<p>Merci beaucoup à vous... et aussi énormément au débuggeur Javascript intégré à mozilla qui est juste... génial !!!</p>',
  ),
  38 => 
  array (
    0 => 'Bonjour, j\'aimerais savoit si l\'ont peut utiliser plusieurs fois le même overlay dans une même window. Cela ne marche pas car il ont le même id. Ya t\'il un moyen?
Merci d\'avance',
    1 => '<p>
Bonjour, j\'aimerais savoit si l\'ont peut utiliser plusieurs fois le même overlay dans une même window. Cela ne marche pas car il ont le même id. Ya t\'il un moyen?
Merci d\'avance
</p>',
    2 => '<p>Bonjour, j\'aimerais savoit si l\'ont peut utiliser plusieurs fois le même overlay dans une même window. Cela ne marche pas car il ont le même id. Ya t\'il un moyen?
Merci d\'avance</p>',
  ),
  39 => 
  array (
    0 => 'Bonjour,

J\'essaye de déchiffrer les composants sur Xulplanet mais ils sont juste listés, il n\'y a aucune explication sur leurs fonctionnalités. 

Par exemple là, je suis sur nsIZipReader. Je cherche à comprendre les méthodes et ce que signifie leurs différents arguments. Mais avec ni explications, ni exemples, c\'est chaud. Il n\'y a nulle part une documentation plus détaillée ?',
    1 => '<p>
Bonjour,
</p>
<p>
J\'essaye de déchiffrer les composants sur Xulplanet mais ils sont juste listés, il n\'y a aucune explication sur leurs fonctionnalités. 
</p>
<p>
Par exemple là, je suis sur nsIZipReader. Je cherche à comprendre les méthodes et ce que signifie leurs différents arguments. Mais avec ni explications, ni exemples, c\'est chaud. Il n\'y a nulle part une documentation plus détaillée ?
</p>',
    2 => '<p>Bonjour,</p>

<p>J\'essaye de déchiffrer les composants sur Xulplanet mais ils sont juste listés, il n\'y a aucune explication sur leurs fonctionnalités. </p>

<p>Par exemple là, je suis sur nsIZipReader. Je cherche à comprendre les méthodes et ce que signifie leurs différents arguments. Mais avec ni explications, ni exemples, c\'est chaud. Il n\'y a nulle part une documentation plus détaillée ?</p>',
  ),
  40 => 
  array (
    0 => 'Très bien c\'est note, mais bon j\'ai prefere le mettre dans le forum pour que chaqu\'un puisse le commenter et faire ses remarques. De plus je ne suis pas tres habitué au wiki.

Sinon pour lire le contenu d\'un fichier dans le zip, utilisez la fct \'getInputStream\' qui vous donne un nsIInputStream facile à lire :)',
    1 => '<p>
Très bien c\'est note, mais bon j\'ai prefere le mettre dans le forum pour que chaqu\'un puisse le commenter et faire ses remarques. De plus je ne suis pas tres habitué au wiki.
</p>
<p>
Sinon pour lire le contenu d\'un fichier dans le zip, utilisez la fct \'getInputStream\' qui vous donne un nsIInputStream facile à lire :)
</p>',
    2 => '<p>Très bien c\'est note, mais bon j\'ai prefere le mettre dans le forum pour que chaqu\'un puisse le commenter et faire ses remarques. De plus je ne suis pas tres habitué au wiki.</p>

<p>Sinon pour lire le contenu d\'un fichier dans le zip, utilisez la fct \'getInputStream\' qui vous donne un nsIInputStream facile à lire :)</p>',
  ),
  41 => 
  array (
    0 => 'Bonjour,
Qq sait comment utiliser les XPCom pour télécharger des fichiers en local depuis une @http?',
    1 => '<p>
Bonjour,
Qq sait comment utiliser les XPCom pour télécharger des fichiers en local depuis une @http?
</p>',
    2 => '<p>Bonjour,
Qq sait comment utiliser les XPCom pour télécharger des fichiers en local depuis une @http?</p>',
  ),
  42 => 
  array (
    0 => 'Merci pour ces infos laurentj,

voici ce que j\'ai réussi à obtenir jusqu\'à maintenant :

 var content = "<?xml version=\\"1.0\\"?><racine><noeud><valeur1>A</valeur1><valeur2>valeurpourA</valeur2></noeud><noeud><valeur1>B</valeur1><valeur2>valeurpourB</valeur2></noeud></racine>";
 var parser = new DOMParser();
 var domtree = parser.parseFromString(content, "text/xml");
 var nodes = document.evaluate("/racine/noeud",domtree,null,0,null);
 var nodelist = new Array();
 var fullnode = nodes.iterateNext();
 while (fullnode) {
   nodelist.push(fullnode);
   fullnode = nodes.iterateNext();
 }
 for(var i=0; i < nodelist.length; i++) {
   node=nodelist[i];
   var valeur1 = document.evaluate("valeur1/text()",node,null,0,null);
   if (valeur1 = "B") {
     var valeur2 = document.evaluate("valeur2/text()",node,null,0,null);
 alert("valeur1=" + valeur1.iterateNext().nodeValue + "\\n" + "valeur2=" + valeur2.iterateNext().nodeValue);
          }
 }

Deux choses :
* @@if (valeur1 == "B")@@ ne fonctionne pas, doit y avoir une astuce toute con, mais j\'ai pas trouvé :-(
* ici, je récupère des infos en partant d\'une string, comment obtenir cette string à partir d\'un fichier XML ?

Merci',
    1 => '<p>
Merci pour ces infos laurentj,
</p>
<p>
voici ce que j\'ai réussi à obtenir jusqu\'à maintenant :
</p>
<pre>
var content = &quot;&lt;?xml version=\\&quot;1.0\\&quot;?&gt;&lt;racine&gt;&lt;noeud&gt;&lt;valeur1&gt;A&lt;/valeur1&gt;&lt;valeur2&gt;valeurpourA&lt;/valeur2&gt;&lt;/noeud&gt;&lt;noeud&gt;&lt;valeur1&gt;B&lt;/valeur1&gt;&lt;valeur2&gt;valeurpourB&lt;/valeur2&gt;&lt;/noeud&gt;&lt;/racine&gt;&quot;;
var parser = new DOMParser();
var domtree = parser.parseFromString(content, &quot;text/xml&quot;);
var nodes = document.evaluate(&quot;/racine/noeud&quot;,domtree,null,0,null);
var nodelist = new Array();
var fullnode = nodes.iterateNext();
while (fullnode) {
  nodelist.push(fullnode);
  fullnode = nodes.iterateNext();
}
for(var i=0; i &lt; nodelist.length; i++) {
  node=nodelist[i];
  var valeur1 = document.evaluate(&quot;valeur1/text()&quot;,node,null,0,null);
  if (valeur1 = &quot;B&quot;) {
    var valeur2 = document.evaluate(&quot;valeur2/text()&quot;,node,null,0,null);
alert(&quot;valeur1=&quot; + valeur1.iterateNext().nodeValue + &quot;\\n&quot; + &quot;valeur2=&quot; + valeur2.iterateNext().nodeValue);
         }
}
</pre>
<p>
Deux choses :
</p>
<ul>

<li> <code>if (valeur1 == &quot;B&quot;)</code> ne fonctionne pas, doit y avoir une astuce toute con, mais j\'ai pas trouvé :-(
</li>
<li> ici, je récupère des infos en partant d\'une string, comment obtenir cette string à partir d\'un fichier XML ?
</li>
</ul>

<p>
Merci
</p>',
    2 => '<p>Merci pour ces infos laurentj,</p>

<p>voici ce que j\'ai réussi à obtenir jusqu\'à maintenant :</p>

<pre>var content = &quot;&lt;?xml version=\\&quot;1.0\\&quot;?&gt;&lt;racine&gt;&lt;noeud&gt;&lt;valeur1&gt;A&lt;/valeur1&gt;&lt;valeur2&gt;valeurpourA&lt;/valeur2&gt;&lt;/noeud&gt;&lt;noeud&gt;&lt;valeur1&gt;B&lt;/valeur1&gt;&lt;valeur2&gt;valeurpourB&lt;/valeur2&gt;&lt;/noeud&gt;&lt;/racine&gt;&quot;;
var parser = new DOMParser();
var domtree = parser.parseFromString(content, &quot;text/xml&quot;);
var nodes = document.evaluate(&quot;/racine/noeud&quot;,domtree,null,0,null);
var nodelist = new Array();
var fullnode = nodes.iterateNext();
while (fullnode) {
  nodelist.push(fullnode);
  fullnode = nodes.iterateNext();
}
for(var i=0; i &lt; nodelist.length; i++) {
  node=nodelist[i];
  var valeur1 = document.evaluate(&quot;valeur1/text()&quot;,node,null,0,null);
  if (valeur1 = &quot;B&quot;) {
    var valeur2 = document.evaluate(&quot;valeur2/text()&quot;,node,null,0,null);
alert(&quot;valeur1=&quot; + valeur1.iterateNext().nodeValue + &quot;\\n&quot; + &quot;valeur2=&quot; + valeur2.iterateNext().nodeValue);
         }
}
</pre>

<p>Deux choses :</p>
<ul>
<li><code>if (valeur1 == &quot;B&quot;)</code> ne fonctionne pas, doit y avoir une astuce toute con, mais j\'ai pas trouvé :-(</li>
<li>ici, je récupère des infos en partant d\'une string, comment obtenir cette string à partir d\'un fichier XML ?</li>
</ul>

<p>Merci</p>',
  ),
  43 => 
  array (
    0 => 'La définition veut dire que si tu fais ça :

 <iframe src="toto.xul" id="maframe">
    <bla />
     <rebla />
  </iframe>

Les balise bla et rebla seront ignorées par le navigateur.

Par contre il est tout à fait possible de récuperer les données qu\'il y a dans toto.xul avec le DOM. Ça sera un truc du genre :

  document.getElementById(\'maframe\').document.getElement....


',
    1 => '<p>
La définition veut dire que si tu fais ça :
</p>
<pre>
&lt;iframe src=&quot;toto.xul&quot; id=&quot;maframe&quot;&gt;
   &lt;bla /&gt;
    &lt;rebla /&gt;
 &lt;/iframe&gt;
</pre>
<p>
Les balise bla et rebla seront ignorées par le navigateur.
</p>
<p>
Par contre il est tout à fait possible de récuperer les données qu\'il y a dans toto.xul avec le DOM. Ça sera un truc du genre :
</p>
<pre>
 document.getElementById(\'maframe\').document.getElement....
</pre>',
    2 => '<p>La définition veut dire que si tu fais ça :</p>

<pre>&lt;iframe src=&quot;toto.xul&quot; id=&quot;maframe&quot;&gt;
   &lt;bla /&gt;
    &lt;rebla /&gt;
 &lt;/iframe&gt;
</pre>

<p>Les balise bla et rebla seront ignorées par le navigateur.</p>

<p>Par contre il est tout à fait possible de récuperer les données qu\'il y a dans toto.xul avec le DOM. Ça sera un truc du genre :</p>

<pre> document.getElementById(\'maframe\').document.getElement....
</pre>


',
  ),
  44 => 
  array (
    0 => 'Il n\'y a pas de mal.

Tu met en lumière un problème. Je vais donc le résoudre :-)',
    1 => '<p>
Il n\'y a pas de mal.
</p>
<p>
Tu met en lumière un problème. Je vais donc le résoudre <img src="laugh.png" alt=":-)"/>
</p>',
    2 => '<p>Il n\'y a pas de mal.</p>

<p>Tu met en lumière un problème. Je vais donc le résoudre <img src="laugh.png" alt=":-)"/></p>',
  ),
  45 => 
  array (
    0 => 'J\'ai trouvé cette info :

\'\'In order to configure Mozilla to enable the use of these security privileges, you must set the preference signed.applets.codebase_principal_support to true. You can do this either by using about:config to add the boolean preference, or modifying the user.js preferences file in your Mozilla profile directory to contain the line :\'\'

 user_pref("signed.applets.codebase_principal_support", true);

ref: [http://bclary.com/2004/07/10/spider/content/spider/spider-help.html]

Si tout fonctionne, faudrait mettre ça sur le wiki !?...

Je sais, je fais ma sauce dans mon coin, sur ce post... :S',
    1 => '<p>
J\'ai trouvé cette info :
</p>
<p>
<em>In order to configure Mozilla to enable the use of these security privileges, you must set the preference signed.applets.codebase_principal_support to true. You can do this either by using about:config to add the boolean preference, or modifying the user.js preferences file in your Mozilla profile directory to contain the line :</em>
</p>
<pre>
user_pref(&quot;signed.applets.codebase_principal_support&quot;, true);
</pre>
<p>
ref: <a href="http://bclary.com/2004/07/10/spider/content/spider/spider-help.html">http://bclary.com/2004/07/10/spider/cont(..)</a>
</p>
<p>
Si tout fonctionne, faudrait mettre ça sur le wiki !?...
</p>
<p>
Je sais, je fais ma sauce dans mon coin, sur ce post... :S
</p>',
    2 => '<p>J\'ai trouvé cette info :</p>

<p><em>In order to configure Mozilla to enable the use of these security privileges, you must set the preference signed.applets.codebase_principal_support to true. You can do this either by using about:config to add the boolean preference, or modifying the user.js preferences file in your Mozilla profile directory to contain the line :</em></p>

<pre>user_pref(&quot;signed.applets.codebase_principal_support&quot;, true);
</pre>

<p>ref: <a href="http://bclary.com/2004/07/10/spider/content/spider/spider-help.html">http://bclary.com/2004/07/10/spider/cont(..)</a></p>

<p>Si tout fonctionne, faudrait mettre ça sur le wiki !?...</p>

<p>Je sais, je fais ma sauce dans mon coin, sur ce post... :S</p>',
  ),
  46 => 
  array (
    0 => 'Bonjour,

J\'aimerais savoir s\'il existe une méthode permettant d\'inclure directement un fichier xul sans passer par un overlay.

Par exemple :

<?xul href="menu.xul"?>

Merci',
    1 => '<p>
Bonjour,
</p>
<p>
J\'aimerais savoir s\'il existe une méthode permettant d\'inclure directement un fichier xul sans passer par un overlay.
</p>
<p>
Par exemple :
</p>
<p>
&lt;?xul href=&quot;menu.xul&quot;?&gt;
</p>
<p>
Merci
</p>',
    2 => '<p>Bonjour,</p>

<p>J\'aimerais savoir s\'il existe une méthode permettant d\'inclure directement un fichier xul sans passer par un overlay.</p>

<p>Par exemple :</p>

<p>&lt;?xul href=&quot;menu.xul&quot;?&gt;</p>

<p>Merci</p>',
  ),
  47 => 
  array (
    0 => 'Bonjour,

Je cherche à comprendre la syntaxe utilisée dans le constructeur de la searchbar de firefox (cf search.xml de browser.jar)...

 setTimeout(function(a) { a.initialize(); }, 0, this);

Quelle est l\'utilité du setTimeout : pourquoi n\'appelle-t-on pas la fonction this.initialize() directement dans le constructeur ? quel est l\'intérêt de cette syntaxe ?

Quelqu\'un a une idée ?

Merci d\'avance',
    1 => '<p>
Bonjour,
</p>
<p>
Je cherche à comprendre la syntaxe utilisée dans le constructeur de la searchbar de firefox (cf search.xml de browser.jar)...
</p>
<pre>
setTimeout(function(a) { a.initialize(); }, 0, this);
</pre>
<p>
Quelle est l\'utilité du setTimeout : pourquoi n\'appelle-t-on pas la fonction this.initialize() directement dans le constructeur ? quel est l\'intérêt de cette syntaxe ?
</p>
<p>
Quelqu\'un a une idée ?
</p>
<p>
Merci d\'avance
</p>',
    2 => '<p>Bonjour,</p>

<p>Je cherche à comprendre la syntaxe utilisée dans le constructeur de la searchbar de firefox (cf search.xml de browser.jar)...</p>

<pre>setTimeout(function(a) { a.initialize(); }, 0, this);
</pre>

<p>Quelle est l\'utilité du setTimeout : pourquoi n\'appelle-t-on pas la fonction this.initialize() directement dans le constructeur ? quel est l\'intérêt de cette syntaxe ?</p>

<p>Quelqu\'un a une idée ?</p>

<p>Merci d\'avance</p>',
  ),
  48 => 
  array (
    0 => 'Oui, mais ca vient juste de la modification du code pour le publier. J\'ai voulu le rendre plus simple :p

Mais dans mon code j\'ai pas cette erreur et ca ne fonctionne pas :(',
    1 => '<p>
Oui, mais ca vient juste de la modification du code pour le publier. J\'ai voulu le rendre plus simple :p
</p>
<p>
Mais dans mon code j\'ai pas cette erreur et ca ne fonctionne pas :(
</p>',
    2 => '<p>Oui, mais ca vient juste de la modification du code pour le publier. J\'ai voulu le rendre plus simple :p</p>

<p>Mais dans mon code j\'ai pas cette erreur et ca ne fonctionne pas :(</p>',
  ),
  49 => 
  array (
    0 => 'Bonjour,

j\'ai réalisé une interface en XUL et les informations saisies sont récupérées par une fonction Javascript.

Maintenant ce que j\'aimerai faire, c\'est réutiliser ses informations pour générer un fichier à l\'aide de PHP.

Mais je n\'arrive pas à faire intéragir js et php.
De plus mon script js ne fonctionne plus une fois que mes fichiers sont sur un serveur php ...

Pouvez vous m\'aider ?
',
    1 => '<p>
Bonjour,
</p>
<p>
j\'ai réalisé une interface en XUL et les informations saisies sont récupérées par une fonction Javascript.
</p>
<p>
Maintenant ce que j\'aimerai faire, c\'est réutiliser ses informations pour générer un fichier à l\'aide de PHP.
</p>
<p>
Mais je n\'arrive pas à faire intéragir js et php.
De plus mon script js ne fonctionne plus une fois que mes fichiers sont sur un serveur php ...
</p>
<p>
Pouvez vous m\'aider ?
</p>',
    2 => '<p>Bonjour,</p>

<p>j\'ai réalisé une interface en XUL et les informations saisies sont récupérées par une fonction Javascript.</p>

<p>Maintenant ce que j\'aimerai faire, c\'est réutiliser ses informations pour générer un fichier à l\'aide de PHP.</p>

<p>Mais je n\'arrive pas à faire intéragir js et php.
De plus mon script js ne fonctionne plus une fois que mes fichiers sont sur un serveur php ...</p>

<p>Pouvez vous m\'aider ?</p>
',
  ),
  50 => 
  array (
    0 => 'Hello,

ton code est OK et fonctionne à merveille! Comme quoi le DOM fait pas mal de travail...

Bon ,à priori, cela ne marche que sur des arbres "de base" non genérés par un template RDF.

De plus, je viens de me rendre compte qu\'il faut bien gérer l\'évènement, sinon, le temps de click suffit à faire croire qu\'on clique plusieurs fois d\'affilé.

En gros, si je mets des alert dans la fonction, tout marche correctement. Dès qu\'il n\'y a plus d\'alert, un click sur l\'image (ou sur la zone de la largeur de la colonne) ne déclenche plus de changement d\'image.

Voici le code:

 function onVisibleClick(event)
 {
    
    // On ne prend en compte que les clicks droits !
    //if (event.button != 0)
    //  return;
 
 // start
   var row = {}, colID = {}, childElt = {};
 
   var tree = window.document.getElementById(\'visible_layer_tree\');
   tree.treeBoxObject.getCellAt(event.clientX, event.clientY, row, colID, childElt);
      
   if (row.value == -1 || row.value > tree.view.rowCount-1 || event.originalTarget.localName != "treechildren") {
     if (event.originalTarget.localName == "treecol") { 
       event.preventBubble();
     }
     return;
   }
   
   // si on est sur la bonne colonne:
   if (colID.value == "visible") {
     
     // on récupère l\'objet row avec la bonne valeur
     var row = tree.getElementsByTagName("treerow").item(row.value);
     
     // ensuite, il faut récupérer la bonne cellule de la ligne:
     var col6Cell = row.getElementsByTagName("treecell").item(1);
     
     alert ("Valeur de la cellule");
 
     if(col6Cell.getAttribute("src")=="chrome://global/skin/checkbox/cbox.gif")
         // checked
         col6Cell.setAttribute("src", "chrome://global/skin/checkbox/cbox-check.gif");
       else
         // unchecked
         col6Cell.setAttribute("src", "chrome://global/skin/checkbox/cbox.gif");
   }
 }


Je ne vois pas ce qui cloche ! Si je mets la ligne @@alert("Valeur de la cellule")@@ en commentaire, ça ne marche plus. D\'où mon idée d\'un problème de timing ou de rafraichissement...

Qu\'en pensez-vous ?',
    1 => '<p>
Hello,
</p>
<p>
ton code est OK et fonctionne à merveille! Comme quoi le DOM fait pas mal de travail...
</p>
<p>
Bon ,à priori, cela ne marche que sur des arbres &quot;de base&quot; non genérés par un template RDF.
</p>
<p>
De plus, je viens de me rendre compte qu\'il faut bien gérer l\'évènement, sinon, le temps de click suffit à faire croire qu\'on clique plusieurs fois d\'affilé.
</p>
<p>
En gros, si je mets des alert dans la fonction, tout marche correctement. Dès qu\'il n\'y a plus d\'alert, un click sur l\'image (ou sur la zone de la largeur de la colonne) ne déclenche plus de changement d\'image.
</p>
<p>
Voici le code:
</p>
<pre>
function onVisibleClick(event)
{
   
   // On ne prend en compte que les clicks droits !
   //if (event.button != 0)
   //  return;

// start
  var row = {}, colID = {}, childElt = {};

  var tree = window.document.getElementById(\'visible_layer_tree\');
  tree.treeBoxObject.getCellAt(event.clientX, event.clientY, row, colID, childElt);
     
  if (row.value == -1 || row.value &gt; tree.view.rowCount-1 || event.originalTarget.localName != &quot;treechildren&quot;) {
    if (event.originalTarget.localName == &quot;treecol&quot;) { 
      event.preventBubble();
    }
    return;
  }
  
  // si on est sur la bonne colonne:
  if (colID.value == &quot;visible&quot;) {
    
    // on récupère l\'objet row avec la bonne valeur
    var row = tree.getElementsByTagName(&quot;treerow&quot;).item(row.value);
    
    // ensuite, il faut récupérer la bonne cellule de la ligne:
    var col6Cell = row.getElementsByTagName(&quot;treecell&quot;).item(1);
    
    alert (&quot;Valeur de la cellule&quot;);

    if(col6Cell.getAttribute(&quot;src&quot;)==&quot;chrome://global/skin/checkbox/cbox.gif&quot;)
        // checked
        col6Cell.setAttribute(&quot;src&quot;, &quot;chrome://global/skin/checkbox/cbox-check.gif&quot;);
      else
        // unchecked
        col6Cell.setAttribute(&quot;src&quot;, &quot;chrome://global/skin/checkbox/cbox.gif&quot;);
  }
}
</pre>
<p>
Je ne vois pas ce qui cloche ! Si je mets la ligne <code>alert(&quot;Valeur de la cellule&quot;)</code> en commentaire, ça ne marche plus. D\'où mon idée d\'un problème de timing ou de rafraichissement...
</p>
<p>
Qu\'en pensez-vous ?
</p>',
    2 => '<p>Hello,</p>

<p>ton code est OK et fonctionne à merveille! Comme quoi le DOM fait pas mal de travail...</p>

<p>Bon ,à priori, cela ne marche que sur des arbres &quot;de base&quot; non genérés par un template RDF.</p>

<p>De plus, je viens de me rendre compte qu\'il faut bien gérer l\'évènement, sinon, le temps de click suffit à faire croire qu\'on clique plusieurs fois d\'affilé.</p>

<p>En gros, si je mets des alert dans la fonction, tout marche correctement. Dès qu\'il n\'y a plus d\'alert, un click sur l\'image (ou sur la zone de la largeur de la colonne) ne déclenche plus de changement d\'image.</p>

<p>Voici le code:</p>

<pre>function onVisibleClick(event)
{
   
   // On ne prend en compte que les clicks droits !
   //if (event.button != 0)
   //  return;

// start
  var row = {}, colID = {}, childElt = {};

  var tree = window.document.getElementById(\'visible_layer_tree\');
  tree.treeBoxObject.getCellAt(event.clientX, event.clientY, row, colID, childElt);
     
  if (row.value == -1 || row.value &gt; tree.view.rowCount-1 || event.originalTarget.localName != &quot;treechildren&quot;) {
    if (event.originalTarget.localName == &quot;treecol&quot;) { 
      event.preventBubble();
    }
    return;
  }
  
  // si on est sur la bonne colonne:
  if (colID.value == &quot;visible&quot;) {
    
    // on récupère l\'objet row avec la bonne valeur
    var row = tree.getElementsByTagName(&quot;treerow&quot;).item(row.value);
    
    // ensuite, il faut récupérer la bonne cellule de la ligne:
    var col6Cell = row.getElementsByTagName(&quot;treecell&quot;).item(1);
    
    alert (&quot;Valeur de la cellule&quot;);

    if(col6Cell.getAttribute(&quot;src&quot;)==&quot;chrome://global/skin/checkbox/cbox.gif&quot;)
        // checked
        col6Cell.setAttribute(&quot;src&quot;, &quot;chrome://global/skin/checkbox/cbox-check.gif&quot;);
      else
        // unchecked
        col6Cell.setAttribute(&quot;src&quot;, &quot;chrome://global/skin/checkbox/cbox.gif&quot;);
  }
}
</pre>


<p>Je ne vois pas ce qui cloche ! Si je mets la ligne <code>alert(&quot;Valeur de la cellule&quot;)</code> en commentaire, ça ne marche plus. D\'où mon idée d\'un problème de timing ou de rafraichissement...</p>

<p>Qu\'en pensez-vous ?</p>',
  ),
  51 => 
  array (
    0 => 'Pourquoi python ou php ? pourquoi pas javascript ou C++ ?

Tout est en local ou est ce une appli web ?',
    1 => '<p>
Pourquoi python ou php ? pourquoi pas javascript ou C++ ?
</p>
<p>
Tout est en local ou est ce une appli web ?
</p>',
    2 => '<p>Pourquoi python ou php ? pourquoi pas javascript ou C++ ?</p>

<p>Tout est en local ou est ce une appli web ?</p>',
  ),
  52 => 
  array (
    0 => 'humm...j\'avoue que j\'arrive pas a voir comment faire..puisque dans mon overlay je vois pas comment dire "onselectedtext" (enfin quelque chose comme ca). La seule solution alors, est de faire un timer...mais il n\'y a pas une autre methode? en utilisant par exemple un composant XPCOM?',
    1 => '<p>
humm...j\'avoue que j\'arrive pas a voir comment faire..puisque dans mon overlay je vois pas comment dire &quot;onselectedtext&quot; (enfin quelque chose comme ca). La seule solution alors, est de faire un timer...mais il n\'y a pas une autre methode? en utilisant par exemple un composant XPCOM?
</p>',
    2 => '<p>humm...j\'avoue que j\'arrive pas a voir comment faire..puisque dans mon overlay je vois pas comment dire &quot;onselectedtext&quot; (enfin quelque chose comme ca). La seule solution alors, est de faire un timer...mais il n\'y a pas une autre methode? en utilisant par exemple un composant XPCOM?</p>',
  ),
  53 => 
  array (
    0 => 'Bonjour,

j\'ai un problème avec l\'élément stack (je précise pour ceux qui ne le connaissent pas qu\'il permet la superposition de ses éléments fils). Son comportement m\'est indispensable, mais il semblerait que tous les événements sur ses éléments fils soient desactivés (aucune action sur les boutons, pas de modification du style du curseur...)

Si quelqu\'un a une idée me permettant de palier à ce problème, ma reconnaissance lui serait éternelle...

En cadeau, un petit bout de mon code :

 <stack align="top" >
 	<html:div><image src="../images/carte44bis.png" style="width:800px" /></html:div>
 	<html:div><button label="coucou" oncommand="alert(\'coucou\');" style="width:100px"/></html:div>
 	<svg:svg>
 		<svg:line x1="15" y1="15" x2="80" y2="80" stroke="blue" stroke-width="1"/>
 		<svg:line x1="100" y1="15" x2="40" y2="35" stroke="red" stroke-width="1"/>
 	</svg:svg>
 </stack>

(le html:div, seul moyen trouvé pour empêcher l\'étirement des éléments)',
    1 => '<p>
Bonjour,
</p>
<p>
j\'ai un problème avec l\'élément stack (je précise pour ceux qui ne le connaissent pas qu\'il permet la superposition de ses éléments fils). Son comportement m\'est indispensable, mais il semblerait que tous les événements sur ses éléments fils soient desactivés (aucune action sur les boutons, pas de modification du style du curseur...)
</p>
<p>
Si quelqu\'un a une idée me permettant de palier à ce problème, ma reconnaissance lui serait éternelle...
</p>
<p>
En cadeau, un petit bout de mon code :
</p>
<pre>
&lt;stack align=&quot;top&quot; &gt;
	&lt;html:div&gt;&lt;image src=&quot;../images/carte44bis.png&quot; style=&quot;width:800px&quot; /&gt;&lt;/html:div&gt;
	&lt;html:div&gt;&lt;button label=&quot;coucou&quot; oncommand=&quot;alert(\'coucou\');&quot; style=&quot;width:100px&quot;/&gt;&lt;/html:div&gt;
	&lt;svg:svg&gt;
		&lt;svg:line x1=&quot;15&quot; y1=&quot;15&quot; x2=&quot;80&quot; y2=&quot;80&quot; stroke=&quot;blue&quot; stroke-width=&quot;1&quot;/&gt;
		&lt;svg:line x1=&quot;100&quot; y1=&quot;15&quot; x2=&quot;40&quot; y2=&quot;35&quot; stroke=&quot;red&quot; stroke-width=&quot;1&quot;/&gt;
	&lt;/svg:svg&gt;
&lt;/stack&gt;
</pre>
<p>
(le html:div, seul moyen trouvé pour empêcher l\'étirement des éléments)
</p>',
    2 => '<p>Bonjour,</p>

<p>j\'ai un problème avec l\'élément stack (je précise pour ceux qui ne le connaissent pas qu\'il permet la superposition de ses éléments fils). Son comportement m\'est indispensable, mais il semblerait que tous les événements sur ses éléments fils soient desactivés (aucune action sur les boutons, pas de modification du style du curseur...)</p>

<p>Si quelqu\'un a une idée me permettant de palier à ce problème, ma reconnaissance lui serait éternelle...</p>

<p>En cadeau, un petit bout de mon code :</p>

<pre>&lt;stack align=&quot;top&quot; &gt;
	&lt;html:div&gt;&lt;image src=&quot;../images/carte44bis.png&quot; style=&quot;width:800px&quot; /&gt;&lt;/html:div&gt;
	&lt;html:div&gt;&lt;button label=&quot;coucou&quot; oncommand=&quot;alert(\'coucou\');&quot; style=&quot;width:100px&quot;/&gt;&lt;/html:div&gt;
	&lt;svg:svg&gt;
		&lt;svg:line x1=&quot;15&quot; y1=&quot;15&quot; x2=&quot;80&quot; y2=&quot;80&quot; stroke=&quot;blue&quot; stroke-width=&quot;1&quot;/&gt;
		&lt;svg:line x1=&quot;100&quot; y1=&quot;15&quot; x2=&quot;40&quot; y2=&quot;35&quot; stroke=&quot;red&quot; stroke-width=&quot;1&quot;/&gt;
	&lt;/svg:svg&gt;
&lt;/stack&gt;
</pre>

<p>(le html:div, seul moyen trouvé pour empêcher l\'étirement des éléments)</p>',
  ),
  54 => 
  array (
    0 => 'Lorsque j\'effectue une requete HTML, je recois la part HTML de la page.

je voulais savoir si il y a une copie locale de cette page...
car je pense qu\'il y en a une.

Ce que je veux c\'est acceder au fichier equivalent au CTRL+U avec un programme C++



Sinon quand je parlais de "la page" je parle de ce que je vois (donc queqleuchose qui n\'existe pas qui n\'est que le resultat d\'une interprétation par le navigateur) et par source je voulais dire le fichier vu par CTRL+U dans firefox. La vrai source du fichier(avec du PHP) je ne puex evidemment pas y accéder et ne veux pas y acceder non plus. J\'essaierai de parler plus clairement la prochaine fois. désolé de mettre mal exprimé
',
    1 => '<p>
Lorsque j\'effectue une requete HTML, je recois la part HTML de la page.
</p>
<p>
je voulais savoir si il y a une copie locale de cette page...
car je pense qu\'il y en a une.
</p>
<p>
Ce que je veux c\'est acceder au fichier equivalent au CTRL+U avec un programme C++
</p>
<p>
Sinon quand je parlais de &quot;la page&quot; je parle de ce que je vois (donc queqleuchose qui n\'existe pas qui n\'est que le resultat d\'une interprétation par le navigateur) et par source je voulais dire le fichier vu par CTRL+U dans firefox. La vrai source du fichier(avec du PHP) je ne puex evidemment pas y accéder et ne veux pas y acceder non plus. J\'essaierai de parler plus clairement la prochaine fois. désolé de mettre mal exprimé
</p>',
    2 => '<p>Lorsque j\'effectue une requete HTML, je recois la part HTML de la page.</p>

<p>je voulais savoir si il y a une copie locale de cette page...
car je pense qu\'il y en a une.</p>

<p>Ce que je veux c\'est acceder au fichier equivalent au CTRL+U avec un programme C++</p>



<p>Sinon quand je parlais de &quot;la page&quot; je parle de ce que je vois (donc queqleuchose qui n\'existe pas qui n\'est que le resultat d\'une interprétation par le navigateur) et par source je voulais dire le fichier vu par CTRL+U dans firefox. La vrai source du fichier(avec du PHP) je ne puex evidemment pas y accéder et ne veux pas y acceder non plus. J\'essaierai de parler plus clairement la prochaine fois. désolé de mettre mal exprimé</p>
',
  ),
  55 => 
  array (
    0 => 'je voulais savoir où était expliqué la méthode qui permet dans un objet xpcom de retourné des tableaux et autre variables.
Mais apres avoir fouillié dans les méhandres des sources ... j\'y suis arrivé. ( c\'est pas simple de trouver ce qu\'on veut ... pfuuu )

Alors il faut savoir que quand on fait un objet xpcom en C++, il faut passer les retours de fonctions en paramètre en ajoutant une indirection de pointeur ...

voila ...
mais bon .. c quand même pas simple
',
    1 => '<p>
je voulais savoir où était expliqué la méthode qui permet dans un objet xpcom de retourné des tableaux et autre variables.
Mais apres avoir fouillié dans les méhandres des sources ... j\'y suis arrivé. ( c\'est pas simple de trouver ce qu\'on veut ... pfuuu )
</p>
<p>
Alors il faut savoir que quand on fait un objet xpcom en C++, il faut passer les retours de fonctions en paramètre en ajoutant une indirection de pointeur ...
</p>
<p>
voila ...
mais bon .. c quand même pas simple
</p>',
    2 => '<p>je voulais savoir où était expliqué la méthode qui permet dans un objet xpcom de retourné des tableaux et autre variables.
Mais apres avoir fouillié dans les méhandres des sources ... j\'y suis arrivé. ( c\'est pas simple de trouver ce qu\'on veut ... pfuuu )</p>

<p>Alors il faut savoir que quand on fait un objet xpcom en C++, il faut passer les retours de fonctions en paramètre en ajoutant une indirection de pointeur ...</p>

<p>voila ...
mais bon .. c quand même pas simple</p>
',
  ),
  56 => 
  array (
    0 => 'On peut utiliser cette page si tu veux : [http://xulfr.org/wiki/FaqDev]. Elle est faite pour. Faut juste des volontaires pour la remplir :-)

',
    1 => '<p>
On peut utiliser cette page si tu veux : <a href="http://xulfr.org/wiki/FaqDev">http://xulfr.org/wiki/FaqDev</a>. Elle est faite pour. Faut juste des volontaires pour la remplir <img src="laugh.png" alt=":-)"/>
</p>',
    2 => '<p>On peut utiliser cette page si tu veux : <a href="http://xulfr.org/wiki/FaqDev">http://xulfr.org/wiki/FaqDev</a>. Elle est faite pour. Faut juste des volontaires pour la remplir <img src="laugh.png" alt=":-)"/></p>

',
  ),
  57 => 
  array (
    0 => 'Bonjour,

Voici un petit code pour \'\'uploader\'\' via FTP.%%%
Attention, il faut que ce soit sous une app chrome (ou un plugin).

__uploadFTP.xul:__

 <?xml-stylesheet href="chrome://global/skin" type="text/css"?>
 <window xmlns="http://www.mozilla.org/keymaster/gatekeeper/there.is.only.xul"
  width="200" height="200"
  style="background-color:rgb(109,134,221);">
  <script>
  function onUpload(){
    var eStatus = document.getElementById("status");
    try{
      eStatus.value="Starting ...";
      upload();
      eStatus.value="Done.";
    }catch(ex){
      eStatus.value="ERROR: "+ex;
      alert(ex);
    }
      
  }
  function upload(){
     
    var targetURI="ftp://user:password@ftpperso.site.net/test.txt";
    
    var IO_SERVICE  = Components.classes["@mozilla.org/network/io-service;1"]
                  .getService(Components.interfaces.nsIIOService);
 
    var ASCII_FILE_STRINGS = "A Z E R T Y "+ (new Date).toString();
 
    var LocalFile = new  Components.Constructor("@mozilla.org/file/local;1", "nsILocalFile");
    var BINARY_FILE_OBJECT = new LocalFile();
    BINARY_FILE_OBJECT.initWithPath( "c:\\autoexec.bat" ); // hei! windows ...
    
    // create stream listener
    var StreamListener = {
       onStartRequest  : function(request, context) {},
       onStopRequest   : function(request, context, statusCode) { alert(\'End: \'+statusCode); },
       onDataAvailable : function(request, context, inputStream, offset, count) {
       }
    };
    
    // create upload channel
    var UploadURI     = IO_SERVICE.newURI(targetURI, null, null);
    var UploadChannel = IO_SERVICE.newChannelFromURI(UploadURI).QueryInterface(Components.interfaces.nsIUploadChannel);
    
    // upload ascii file
    var aStream = Components.classes[\'@mozilla.org/io/string-input-stream;1\'].createInstance(Components.interfaces.nsIStringInputStream);
    aStream.setData(ASCII_FILE_STRINGS, -1);
    UploadChannel.setUploadStream(aStream, "text/plain", -1);
    UploadChannel.asyncOpen(StreamListener, null);
    
    // upload binary file
    //var bStream = Components.classes[\'@mozilla.org/network/file-input-stream;1\'].createInstance(Components.interfaces.nsIFileInputStream);
    //bStream.init(BINARY_FILE_OBJECT, 0x04 | 0x08, 420, false); // 1, 0
    //UploadChannel.setUploadStream(bStream, null, -1);
    //UploadChannel.asyncOpen(StreamListener, null); 
  }
  </script>
 
  <textbox id="status" width="400" readonly="true" />
	<hbox>
		<spacer flex="1"/>
		<button label="Upload" oncommand="onUpload();"/>
	</hbox>
 
 </window>

Cet exemple a été testé sou Firefox 1.0 .
',
    1 => '<p>
Bonjour,
</p>
<p>
Voici un petit code pour <em>uploader</em> via FTP.<br />
Attention, il faut que ce soit sous une app chrome (ou un plugin).
</p>
<p>
<strong>uploadFTP.xul:</strong>
</p>
<pre>
&lt;?xml-stylesheet href=&quot;chrome://global/skin&quot; type=&quot;text/css&quot;?&gt;
&lt;window xmlns=&quot;http://www.mozilla.org/keymaster/gatekeeper/there.is.only.xul&quot;
 width=&quot;200&quot; height=&quot;200&quot;
 style=&quot;background-color:rgb(109,134,221);&quot;&gt;
 &lt;script&gt;
 function onUpload(){
   var eStatus = document.getElementById(&quot;status&quot;);
   try{
     eStatus.value=&quot;Starting ...&quot;;
     upload();
     eStatus.value=&quot;Done.&quot;;
   }catch(ex){
     eStatus.value=&quot;ERROR: &quot;+ex;
     alert(ex);
   }
     
 }
 function upload(){
    
   var targetURI=&quot;ftp://user:password@ftpperso.site.net/test.txt&quot;;
   
   var IO_SERVICE  = Components.classes[&quot;@mozilla.org/network/io-service;1&quot;]
                 .getService(Components.interfaces.nsIIOService);

   var ASCII_FILE_STRINGS = &quot;A Z E R T Y &quot;+ (new Date).toString();

   var LocalFile = new  Components.Constructor(&quot;@mozilla.org/file/local;1&quot;, &quot;nsILocalFile&quot;);
   var BINARY_FILE_OBJECT = new LocalFile();
   BINARY_FILE_OBJECT.initWithPath( &quot;c:\\autoexec.bat&quot; ); // hei! windows ...
   
   // create stream listener
   var StreamListener = {
      onStartRequest  : function(request, context) {},
      onStopRequest   : function(request, context, statusCode) { alert(\'End: \'+statusCode); },
      onDataAvailable : function(request, context, inputStream, offset, count) {
      }
   };
   
   // create upload channel
   var UploadURI     = IO_SERVICE.newURI(targetURI, null, null);
   var UploadChannel = IO_SERVICE.newChannelFromURI(UploadURI).QueryInterface(Components.interfaces.nsIUploadChannel);
   
   // upload ascii file
   var aStream = Components.classes[\'@mozilla.org/io/string-input-stream;1\'].createInstance(Components.interfaces.nsIStringInputStream);
   aStream.setData(ASCII_FILE_STRINGS, -1);
   UploadChannel.setUploadStream(aStream, &quot;text/plain&quot;, -1);
   UploadChannel.asyncOpen(StreamListener, null);
   
   // upload binary file
   //var bStream = Components.classes[\'@mozilla.org/network/file-input-stream;1\'].createInstance(Components.interfaces.nsIFileInputStream);
   //bStream.init(BINARY_FILE_OBJECT, 0x04 | 0x08, 420, false); // 1, 0
   //UploadChannel.setUploadStream(bStream, null, -1);
   //UploadChannel.asyncOpen(StreamListener, null); 
 }
 &lt;/script&gt;

 &lt;textbox id=&quot;status&quot; width=&quot;400&quot; readonly=&quot;true&quot; /&gt;
&lt;hbox&gt;
	&lt;spacer flex=&quot;1&quot;/&gt;
	&lt;button label=&quot;Upload&quot; oncommand=&quot;onUpload();&quot;/&gt;
&lt;/hbox&gt;

&lt;/window&gt;
</pre>
<p>
Cet exemple a été testé sou Firefox 1.0 .
</p>',
    2 => '<p>Bonjour,</p>

<p>Voici un petit code pour <em>uploader</em> via FTP.<br />
Attention, il faut que ce soit sous une app chrome (ou un plugin).</p>

<p><strong>uploadFTP.xul:</strong></p>

<pre>&lt;?xml-stylesheet href=&quot;chrome://global/skin&quot; type=&quot;text/css&quot;?&gt;
&lt;window xmlns=&quot;http://www.mozilla.org/keymaster/gatekeeper/there.is.only.xul&quot;
 width=&quot;200&quot; height=&quot;200&quot;
 style=&quot;background-color:rgb(109,134,221);&quot;&gt;
 &lt;script&gt;
 function onUpload(){
   var eStatus = document.getElementById(&quot;status&quot;);
   try{
     eStatus.value=&quot;Starting ...&quot;;
     upload();
     eStatus.value=&quot;Done.&quot;;
   }catch(ex){
     eStatus.value=&quot;ERROR: &quot;+ex;
     alert(ex);
   }
     
 }
 function upload(){
    
   var targetURI=&quot;ftp://user:password@ftpperso.site.net/test.txt&quot;;
   
   var IO_SERVICE  = Components.classes[&quot;@mozilla.org/network/io-service;1&quot;]
                 .getService(Components.interfaces.nsIIOService);

   var ASCII_FILE_STRINGS = &quot;A Z E R T Y &quot;+ (new Date).toString();

   var LocalFile = new  Components.Constructor(&quot;@mozilla.org/file/local;1&quot;, &quot;nsILocalFile&quot;);
   var BINARY_FILE_OBJECT = new LocalFile();
   BINARY_FILE_OBJECT.initWithPath( &quot;c:\\autoexec.bat&quot; ); // hei! windows ...
   
   // create stream listener
   var StreamListener = {
      onStartRequest  : function(request, context) {},
      onStopRequest   : function(request, context, statusCode) { alert(\'End: \'+statusCode); },
      onDataAvailable : function(request, context, inputStream, offset, count) {
      }
   };
   
   // create upload channel
   var UploadURI     = IO_SERVICE.newURI(targetURI, null, null);
   var UploadChannel = IO_SERVICE.newChannelFromURI(UploadURI).QueryInterface(Components.interfaces.nsIUploadChannel);
   
   // upload ascii file
   var aStream = Components.classes[\'@mozilla.org/io/string-input-stream;1\'].createInstance(Components.interfaces.nsIStringInputStream);
   aStream.setData(ASCII_FILE_STRINGS, -1);
   UploadChannel.setUploadStream(aStream, &quot;text/plain&quot;, -1);
   UploadChannel.asyncOpen(StreamListener, null);
   
   // upload binary file
   //var bStream = Components.classes[\'@mozilla.org/network/file-input-stream;1\'].createInstance(Components.interfaces.nsIFileInputStream);
   //bStream.init(BINARY_FILE_OBJECT, 0x04 | 0x08, 420, false); // 1, 0
   //UploadChannel.setUploadStream(bStream, null, -1);
   //UploadChannel.asyncOpen(StreamListener, null); 
 }
 &lt;/script&gt;

 &lt;textbox id=&quot;status&quot; width=&quot;400&quot; readonly=&quot;true&quot; /&gt;
&lt;hbox&gt;
	&lt;spacer flex=&quot;1&quot;/&gt;
	&lt;button label=&quot;Upload&quot; oncommand=&quot;onUpload();&quot;/&gt;
&lt;/hbox&gt;

&lt;/window&gt;
</pre>

<p>Cet exemple a été testé sou Firefox 1.0 .</p>
',
  ),
  58 => 
  array (
    0 => 'salut,
je suis tjr dans mon extension firefox avec mon interface faite en xul dont un bouton fait appel à une fonction javascript qui normalement devrait changer la couleur du fond de la page.

   function TER_fonNoir()
  {
	document.bgColor = "#000000";
  }
 
c\'est tout bête, mais ca marche pas, sachant que lorsque je clique sur le bouton la méthode est bien appelée je l\'ai testé avec un alert.
merci encore.',
    1 => '<p>
salut,
je suis tjr dans mon extension firefox avec mon interface faite en xul dont un bouton fait appel à une fonction javascript qui normalement devrait changer la couleur du fond de la page.
</p>
<pre>
  function TER_fonNoir()
 {
document.bgColor = &quot;#000000&quot;;
 }

</pre>
<p>
c\'est tout bête, mais ca marche pas, sachant que lorsque je clique sur le bouton la méthode est bien appelée je l\'ai testé avec un alert.
merci encore.
</p>',
    2 => '<p>salut,
je suis tjr dans mon extension firefox avec mon interface faite en xul dont un bouton fait appel à une fonction javascript qui normalement devrait changer la couleur du fond de la page.</p>

<pre>  function TER_fonNoir()
 {
document.bgColor = &quot;#000000&quot;;
 }

</pre>
<p>c\'est tout bête, mais ca marche pas, sachant que lorsque je clique sur le bouton la méthode est bien appelée je l\'ai testé avec un alert.
merci encore.</p>',
  ),
  59 => 
  array (
    0 => 'Ok,

Mais alors pour le développement, comment on fait (moi par exemple je ne développe pas directement dans le chrome) ?

Il faut mettre les définitions dans les fichiers xul pendant le développement puis les mettre dans les dtd juste avant de faire le package xpi ?',
    1 => '<p>
Ok,
</p>
<p>
Mais alors pour le développement, comment on fait (moi par exemple je ne développe pas directement dans le chrome) ?
</p>
<p>
Il faut mettre les définitions dans les fichiers xul pendant le développement puis les mettre dans les dtd juste avant de faire le package xpi ?
</p>',
    2 => '<p>Ok,</p>

<p>Mais alors pour le développement, comment on fait (moi par exemple je ne développe pas directement dans le chrome) ?</p>

<p>Il faut mettre les définitions dans les fichiers xul pendant le développement puis les mettre dans les dtd juste avant de faire le package xpi ?</p>',
  ),
  60 => 
  array (
    0 => '> mais je ne comprend pas comment (le truc avec le view) fonctionne


he bien il faut définir un objet avec un certain nombre de méthode qui sont appellées à différents moments de l\'affichage par le tree.

En particulier la méthode getCellText. En fait, le tree va déterminer quelles sont les cellules actuellement affichées (il ne se préoccupe pas  de celles qui ne sont pas visible). Il va donc parcourir une à une chaque cellule, et appeler à chaque fois la méthode getCellText en lui donnant les coordonnées de ta cellule, pour récuperer le contenu à afficher dans la cellule.

Donc toi, dans getCellText, il faut que tu programmes la récupération du contenu de la cellule dont les coordonnées te sont données en paramètre.

L\'avantage de passer par le view, est que tes données peuvent être stockées ailleurs que dans un RDF. Elles peuvent être stockée dans un tableau javascript, ou un fichier xml quelconque, une base de donnée etc... donc à toi de lire la source de donnée adéquate pour récuperer le contenu indiqué. ex : en admettant que toutes les données du tree soient dans un tableau javascript @@datas@@

 var treeView = {
   getCellText : function(row,column){
     return datas[row][column];
  },

Toi tu as besoin d\'un arbre hierarchique.
En fait lors de l\'affichage du ligne par ligne, le tree va aussi appeler la méthode iscontainer(row) de ton objet, pour déterminer si la ligne courante est un conteneur, donc si elle contient des fils: à toi donc de renvoyer true ou false en fonction de ça. Dans le même genre, tu as getLevel(row).

voir ici [http://www.xulplanet.com/references/xpcomref/ifaces/nsITreeView.html] pour connaître toutes les fonctions que tu peux développer pour indiquer à ton arbre comment réagire lors de l\'affichage.

Pour ton histoire de lenteur, je ne sais pas si c\'est du à mozilla ou ton code.',
    1 => '<blockquote>
<p>
 mais je ne comprend pas comment (le truc avec le view) fonctionne
</p></blockquote>
<p>
he bien il faut définir un objet avec un certain nombre de méthode qui sont appellées à différents moments de l\'affichage par le tree.
</p>
<p>
En particulier la méthode getCellText. En fait, le tree va déterminer quelles sont les cellules actuellement affichées (il ne se préoccupe pas  de celles qui ne sont pas visible). Il va donc parcourir une à une chaque cellule, et appeler à chaque fois la méthode getCellText en lui donnant les coordonnées de ta cellule, pour récuperer le contenu à afficher dans la cellule.
</p>
<p>
Donc toi, dans getCellText, il faut que tu programmes la récupération du contenu de la cellule dont les coordonnées te sont données en paramètre.
</p>
<p>
L\'avantage de passer par le view, est que tes données peuvent être stockées ailleurs que dans un RDF. Elles peuvent être stockée dans un tableau javascript, ou un fichier xml quelconque, une base de donnée etc... donc à toi de lire la source de donnée adéquate pour récuperer le contenu indiqué. ex : en admettant que toutes les données du tree soient dans un tableau javascript <code>datas</code>
</p>
<pre>
var treeView = {
  getCellText : function(row,column){
    return datas[row][column];
 },
</pre>
<p>
Toi tu as besoin d\'un arbre hierarchique.
En fait lors de l\'affichage du ligne par ligne, le tree va aussi appeler la méthode iscontainer(row) de ton objet, pour déterminer si la ligne courante est un conteneur, donc si elle contient des fils: à toi donc de renvoyer true ou false en fonction de ça. Dans le même genre, tu as getLevel(row).
</p>
<p>
voir ici <a href="http://www.xulplanet.com/references/xpcomref/ifaces/nsITreeView.html">http://www.xulplanet.com/references/xpco(..)</a> pour connaître toutes les fonctions que tu peux développer pour indiquer à ton arbre comment réagire lors de l\'affichage.
</p>
<p>
Pour ton histoire de lenteur, je ne sais pas si c\'est du à mozilla ou ton code.
</p>',
    2 => '<blockquote>
<p> mais je ne comprend pas comment (le truc avec le view) fonctionne</p></blockquote>


<p>he bien il faut définir un objet avec un certain nombre de méthode qui sont appellées à différents moments de l\'affichage par le tree.</p>

<p>En particulier la méthode getCellText. En fait, le tree va déterminer quelles sont les cellules actuellement affichées (il ne se préoccupe pas  de celles qui ne sont pas visible). Il va donc parcourir une à une chaque cellule, et appeler à chaque fois la méthode getCellText en lui donnant les coordonnées de ta cellule, pour récuperer le contenu à afficher dans la cellule.</p>

<p>Donc toi, dans getCellText, il faut que tu programmes la récupération du contenu de la cellule dont les coordonnées te sont données en paramètre.</p>

<p>L\'avantage de passer par le view, est que tes données peuvent être stockées ailleurs que dans un RDF. Elles peuvent être stockée dans un tableau javascript, ou un fichier xml quelconque, une base de donnée etc... donc à toi de lire la source de donnée adéquate pour récuperer le contenu indiqué. ex : en admettant que toutes les données du tree soient dans un tableau javascript <code>datas</code></p>

<pre>var treeView = {
  getCellText : function(row,column){
    return datas[row][column];
 },
</pre>

<p>Toi tu as besoin d\'un arbre hierarchique.
En fait lors de l\'affichage du ligne par ligne, le tree va aussi appeler la méthode iscontainer(row) de ton objet, pour déterminer si la ligne courante est un conteneur, donc si elle contient des fils: à toi donc de renvoyer true ou false en fonction de ça. Dans le même genre, tu as getLevel(row).</p>

<p>voir ici <a href="http://www.xulplanet.com/references/xpcomref/ifaces/nsITreeView.html">http://www.xulplanet.com/references/xpco(..)</a> pour connaître toutes les fonctions que tu peux développer pour indiquer à ton arbre comment réagire lors de l\'affichage.</p>

<p>Pour ton histoire de lenteur, je ne sais pas si c\'est du à mozilla ou ton code.</p>',
  ),
  61 => 
  array (
    0 => 'je dois donc avoir un serveur web en local et utiliser un brower pour interpreter le code ?

et est t\'il possible que e créer ma propre interface et a l\'interieur utilisé mon php (et ne plus utilisé de browser).',
    1 => '<p>
je dois donc avoir un serveur web en local et utiliser un brower pour interpreter le code ?
</p>
<p>
et est t\'il possible que e créer ma propre interface et a l\'interieur utilisé mon php (et ne plus utilisé de browser).
</p>',
    2 => '<p>je dois donc avoir un serveur web en local et utiliser un brower pour interpreter le code ?</p>

<p>et est t\'il possible que e créer ma propre interface et a l\'interieur utilisé mon php (et ne plus utilisé de browser).</p>',
  ),
  62 => 
  array (
    0 => 'Installe firefox, la jslib et ton appli sur ton cd, en veillant bien que la jslib et ton appli soient bien déclarées au niveau de mozilla. 

Le principal problème à resoudre est le chargement du profil. Il y a une astuce pour configurer firefox de manière a ce que, quand il est lancé, il n\'aille pas chercher le profil dans le repertoire de l\'utilisateur, mais ailleurs (je ne sais plus comment), donc par exemple dans un repertoire précis du cdrom.

Ensuite, pour lancer directement l\'appli :

 firefox -chrome chrome://ton_appli/content/


',
    1 => '<p>
Installe firefox, la jslib et ton appli sur ton cd, en veillant bien que la jslib et ton appli soient bien déclarées au niveau de mozilla. 
</p>
<p>
Le principal problème à resoudre est le chargement du profil. Il y a une astuce pour configurer firefox de manière a ce que, quand il est lancé, il n\'aille pas chercher le profil dans le repertoire de l\'utilisateur, mais ailleurs (je ne sais plus comment), donc par exemple dans un repertoire précis du cdrom.
</p>
<p>
Ensuite, pour lancer directement l\'appli :
</p>
<pre>
firefox -chrome chrome://ton_appli/content/
</pre>',
    2 => '<p>Installe firefox, la jslib et ton appli sur ton cd, en veillant bien que la jslib et ton appli soient bien déclarées au niveau de mozilla. </p>

<p>Le principal problème à resoudre est le chargement du profil. Il y a une astuce pour configurer firefox de manière a ce que, quand il est lancé, il n\'aille pas chercher le profil dans le repertoire de l\'utilisateur, mais ailleurs (je ne sais plus comment), donc par exemple dans un repertoire précis du cdrom.</p>

<p>Ensuite, pour lancer directement l\'appli :</p>

<pre>firefox -chrome chrome://ton_appli/content/
</pre>


',
  ),
  63 => 
  array (
    0 => 'ok
merci beaucoup. 
Je pense utiliser des tableaux html pour arriver a ce type de resultat.

bye',
    1 => '<p>
ok
merci beaucoup. 
Je pense utiliser des tableaux html pour arriver a ce type de resultat.
</p>
<p>
bye
</p>',
    2 => '<p>ok
merci beaucoup. 
Je pense utiliser des tableaux html pour arriver a ce type de resultat.</p>

<p>bye</p>',
  ),
  64 => 
  array (
    0 => 'Bonjour,

J\'avais eu le meme pb, je débute en XUL. En fouillant sur le Web,
j\'ai trouvé cela :
netscape.security.PrivilegeManager.enablePrivilege(\'UniversalBrowserRead\');

ça marche, mais si d\'autres pouvaient apporter plus de précisions.

Essayes cela devrait fonctionner.

Cordialement

Foxy
',
    1 => '<p>
Bonjour,
</p>
<p>
J\'avais eu le meme pb, je débute en XUL. En fouillant sur le Web,
j\'ai trouvé cela :
netscape.security.PrivilegeManager.enablePrivilege(\'UniversalBrowserRead\');
</p>
<p>
ça marche, mais si d\'autres pouvaient apporter plus de précisions.
</p>
<p>
Essayes cela devrait fonctionner.
</p>
<p>
Cordialement
</p>
<p>
Foxy
</p>',
    2 => '<p>Bonjour,</p>

<p>J\'avais eu le meme pb, je débute en XUL. En fouillant sur le Web,
j\'ai trouvé cela :
netscape.security.PrivilegeManager.enablePrivilege(\'UniversalBrowserRead\');</p>

<p>ça marche, mais si d\'autres pouvaient apporter plus de précisions.</p>

<p>Essayes cela devrait fonctionner.</p>

<p>Cordialement</p>

<p>Foxy</p>
',
  ),
  65 => 
  array (
    0 => 'Bonjour,

Dans une application en cours de création, je fais suivre un label d\'un menulist. Quand je visionne le tout avec Mozilla, tout va très bien. Mais avec Firefox, le label n\'est pas aligné verticalement : il se colle en haut de la ligne. Quelqu\'un connait un moyen de le forcer à revenir au milieu ?

Merci d\'avance.',
    1 => '<p>
Bonjour,
</p>
<p>
Dans une application en cours de création, je fais suivre un label d\'un menulist. Quand je visionne le tout avec Mozilla, tout va très bien. Mais avec Firefox, le label n\'est pas aligné verticalement : il se colle en haut de la ligne. Quelqu\'un connait un moyen de le forcer à revenir au milieu ?
</p>
<p>
Merci d\'avance.
</p>',
    2 => '<p>Bonjour,</p>

<p>Dans une application en cours de création, je fais suivre un label d\'un menulist. Quand je visionne le tout avec Mozilla, tout va très bien. Mais avec Firefox, le label n\'est pas aligné verticalement : il se colle en haut de la ligne. Quelqu\'un connait un moyen de le forcer à revenir au milieu ?</p>

<p>Merci d\'avance.</p>',
  ),
  66 => 
  array (
    0 => 'qq1, je serait curieux de savoir comment tu a fait pour détecté le changement de page :)',
    1 => '<p>
qq1, je serait curieux de savoir comment tu a fait pour détecté le changement de page :)
</p>',
    2 => '<p>qq1, je serait curieux de savoir comment tu a fait pour détecté le changement de page :)</p>',
  ),
  67 => 
  array (
    0 => 'Tu as dorénavant la doc complète sur tous les objets xpcom et javascript sur [http://www.xulplanet.com]. C\'est en anglais c\'est vrai mais il n\'y a pas plus détaillé et à jour..

On cherche des bonnes âmes pour enrichir le wiki de xulfr avec de la doc en français.',
    1 => '<p>
Tu as dorénavant la doc complète sur tous les objets xpcom et javascript sur <a href="http://www.xulplanet.com">http://www.xulplanet.com</a>. C\'est en anglais c\'est vrai mais il n\'y a pas plus détaillé et à jour..
</p>
<p>
On cherche des bonnes âmes pour enrichir le wiki de xulfr avec de la doc en français.
</p>',
    2 => '<p>Tu as dorénavant la doc complète sur tous les objets xpcom et javascript sur <a href="http://www.xulplanet.com">http://www.xulplanet.com</a>. C\'est en anglais c\'est vrai mais il n\'y a pas plus détaillé et à jour..</p>

<p>On cherche des bonnes âmes pour enrichir le wiki de xulfr avec de la doc en français.</p>',
  ),
  68 => 
  array (
    0 => 'Okay, bonne continuation :)',
    1 => '<p>
Okay, bonne continuation :)
</p>',
    2 => '<p>Okay, bonne continuation :)</p>',
  ),
  69 => 
  array (
    0 => 'Salut!
Bon, je ne promet rien du tout, mais pour ta fonction transformToFragment, pour le "noeud" que tu dois passer tu pourrais faire:

var xmlDoc = document.implementation.createDocument("", "test", null);
xmlDoc.load("nomduxml.xml");
transformToFragment(xmlDoc.documentElement, LeDomDocument);

xmlDoc.documentElement, c\'est la racine de ton fichier xml...

Pour le probleme de création du fichier, je ne peux pas t\'aider, je bute sur ca aussi ces temps ci...

Tiens moi au courant si tu arrives a faire fonctionner ca.

A+
Stoune',
    1 => '<p>
Salut!
Bon, je ne promet rien du tout, mais pour ta fonction transformToFragment, pour le &quot;noeud&quot; que tu dois passer tu pourrais faire:
</p>
<p>
var xmlDoc = document.implementation.createDocument(&quot;&quot;, &quot;test&quot;, null);
xmlDoc.load(&quot;nomduxml.xml&quot;);
transformToFragment(xmlDoc.documentElement, LeDomDocument);
</p>
<p>
xmlDoc.documentElement, c\'est la racine de ton fichier xml...
</p>
<p>
Pour le probleme de création du fichier, je ne peux pas t\'aider, je bute sur ca aussi ces temps ci...
</p>
<p>
Tiens moi au courant si tu arrives a faire fonctionner ca.
</p>
<p>
A+
Stoune
</p>',
    2 => '<p>Salut!
Bon, je ne promet rien du tout, mais pour ta fonction transformToFragment, pour le &quot;noeud&quot; que tu dois passer tu pourrais faire:</p>

<p>var xmlDoc = document.implementation.createDocument(&quot;&quot;, &quot;test&quot;, null);
xmlDoc.load(&quot;nomduxml.xml&quot;);
transformToFragment(xmlDoc.documentElement, LeDomDocument);</p>

<p>xmlDoc.documentElement, c\'est la racine de ton fichier xml...</p>

<p>Pour le probleme de création du fichier, je ne peux pas t\'aider, je bute sur ca aussi ces temps ci...</p>

<p>Tiens moi au courant si tu arrives a faire fonctionner ca.</p>

<p>A+
Stoune</p>',
  ),
  70 => 
  array (
    0 => 'Et avec Content-type: application/vnd.mozilla.xul+xml !?

Alban',
    1 => '<p>
Et avec Content-type: application/vnd.mozilla.xul+xml !?
</p>
<p>
Alban
</p>',
    2 => '<p>Et avec Content-type: application/vnd.mozilla.xul+xml !?</p>

<p>Alban</p>',
  ),
  71 => 
  array (
    0 => 'non excuse moi il y a beaucoup plus simple, je reviens avec un exemple.

EDIT : non je crois que je me suis emporté. Cela dit je vais essayer de creuser les interfaces ci-dessus, le sujet m\'intéresse.',
    1 => '<p>
non excuse moi il y a beaucoup plus simple, je reviens avec un exemple.
</p>
<p>
EDIT : non je crois que je me suis emporté. Cela dit je vais essayer de creuser les interfaces ci-dessus, le sujet m\'intéresse.
</p>',
    2 => '<p>non excuse moi il y a beaucoup plus simple, je reviens avec un exemple.</p>

<p>EDIT : non je crois que je me suis emporté. Cela dit je vais essayer de creuser les interfaces ci-dessus, le sujet m\'intéresse.</p>',
  ),
  72 => 
  array (
    0 => 'Merci pour ta réponse. Le problème c\'est que je constate que Firefox aussi n\'a pas le support du SVG .. vraiment dommage. J\'espère que cela sera intégré bientôt ....

Sinon si on pouvait avoir ce canvas en extension xpi pour firefox cela serait idéal (ou le svg).',
    1 => '<p>
Merci pour ta réponse. Le problème c\'est que je constate que Firefox aussi n\'a pas le support du SVG .. vraiment dommage. J\'espère que cela sera intégré bientôt ....
</p>
<p>
Sinon si on pouvait avoir ce canvas en extension xpi pour firefox cela serait idéal (ou le svg).
</p>',
    2 => '<p>Merci pour ta réponse. Le problème c\'est que je constate que Firefox aussi n\'a pas le support du SVG .. vraiment dommage. J\'espère que cela sera intégré bientôt ....</p>

<p>Sinon si on pouvait avoir ce canvas en extension xpi pour firefox cela serait idéal (ou le svg).</p>',
  ),
  73 => 
  array (
    0 => 'Cyrare a écrit:

>J\'ai donc bien mis les types mime oui, (vu que le fichier se lance) et j\'ai mis un chmod à 777 sur le répertoire et ses fichiers pour pas être embêté par ça.

tu es bien sur de ton type-mime? Le meilleure moyen c\'est dans Mozilla: Affichage->Informations sur la page->Onglet Général->type: là tu dois avoir application/vnd.mozilla.xul+xml
Parce que si tu as text/xml ou text/html ca ne vas pas deranger Mozilla te t\'afficher la page (il l\'interpretera comme du XML, car ton fichier .xul doit commencer par <?xml version="1.0" encoding="UTF-8"?>). C\'est pas parce que ca a l\'air de bien s\'afficher que Mozilla prend ca pour du XUL.

>Je suis content parce que tu raisonnes comme moi, ça prouve que je suis pas un abruti avec un réponse évidente que je ne vois pas. ;)

Ou alors on est deux abrutis? ;-)

>Ce que je me demande, vu que XUL lance bien le fichier (sans le charger) et vu que .status lance une exception, si c\'est pas mon apache qui doit lancer par exemple une information au navigateur (par exemple le status) et qu\'il l\'ommet, ou le fait mal, d\'où l\'erreur.

Pour le lancement d\'une requete http il n\'y a jamais de problemes (hormis les privileges), si elle tombe dans le vide ou echoue c\'est a la lecture de le reponse (status ou responseText par exemple) que ca va poser probleme. Et Apache ne peut pas se planter au niveau des codes d\'etat HTTP (200 ou autre), en tous cas c\'est pas de ton ressort ce n\'est pas accessible par httpd.conf. La seul chose dans notre cas ou il peut merdouiller c\'est les type-mimes, mais toi tu attend un responseText , ca devrait marcher a tous les coup ca!!!

Personnelement les seul fois ou j\'ai vu des exceptions se lancer avec XMLHttpRequest() c\'etait dans les cas suivant:

_j\'avais deja une autre instance de lancer.

_Deux instances essayait de se lancer en meme temps.

_j\'etais en mode synchrone et j\'essayais de lire la reponse avant qu\'elle ne soit arrivée (d\'ou ma solution numero 2, voir mon premier post plus haut, qui t\'evite ce genre d\'ennui).

_Le site auquel je fais une requete ne repond pas. (serveur down donc il ne me renvoie meme pas un code d\'etat)

>
>Mais dans ce cas, il faudrait que j\'ai accès à ce qui déclanche l\'exception 0x80040111 pour pouvoir changer ça... Et c\'est là où j\'en suis, parce qu\'il n\'y a aucune information de ce type sur le net... :( (Ou alors j\'ai pas trouvé)
>

Ben là il n\'y a que la console javascript de mozilla qui va nous aider... quoique Regarde tes logs d\'apache (error et access) ils disent quoi quand tu essai de charger test.text?


',
    1 => '<p>
Cyrare a écrit:
</p>
<blockquote>
<p>
J\'ai donc bien mis les types mime oui, (vu que le fichier se lance) et j\'ai mis un chmod à 777 sur le répertoire et ses fichiers pour pas être embêté par ça.
</p></blockquote>
<p>
tu es bien sur de ton type-mime? Le meilleure moyen c\'est dans Mozilla: Affichage-&gt;Informations sur la page-&gt;Onglet Général-&gt;type: là tu dois avoir application/vnd.mozilla.xul+xml
Parce que si tu as text/xml ou text/html ca ne vas pas deranger Mozilla te t\'afficher la page (il l\'interpretera comme du XML, car ton fichier .xul doit commencer par &lt;?xml version=&quot;1.0&quot; encoding=&quot;UTF-8&quot;?&gt;). C\'est pas parce que ca a l\'air de bien s\'afficher que Mozilla prend ca pour du XUL.
</p>
<blockquote>
<p>
Je suis content parce que tu raisonnes comme moi, ça prouve que je suis pas un abruti avec un réponse évidente que je ne vois pas. ;)
</p></blockquote>
<p>
Ou alors on est deux abrutis? ;-)
</p>
<blockquote>
<p>
Ce que je me demande, vu que XUL lance bien le fichier (sans le charger) et vu que .status lance une exception, si c\'est pas mon apache qui doit lancer par exemple une information au navigateur (par exemple le status) et qu\'il l\'ommet, ou le fait mal, d\'où l\'erreur.
</p></blockquote>
<p>
Pour le lancement d\'une requete http il n\'y a jamais de problemes (hormis les privileges), si elle tombe dans le vide ou echoue c\'est a la lecture de le reponse (status ou responseText par exemple) que ca va poser probleme. Et Apache ne peut pas se planter au niveau des codes d\'etat HTTP (200 ou autre), en tous cas c\'est pas de ton ressort ce n\'est pas accessible par httpd.conf. La seul chose dans notre cas ou il peut merdouiller c\'est les type-mimes, mais toi tu attend un responseText , ca devrait marcher a tous les coup ca!!!
</p>
<p>
Personnelement les seul fois ou j\'ai vu des exceptions se lancer avec XMLHttpRequest() c\'etait dans les cas suivant:
</p>
<p>
_j\'avais deja une autre instance de lancer.
</p>
<p>
_Deux instances essayait de se lancer en meme temps.
</p>
<p>
_j\'etais en mode synchrone et j\'essayais de lire la reponse avant qu\'elle ne soit arrivée (d\'ou ma solution numero 2, voir mon premier post plus haut, qui t\'evite ce genre d\'ennui).
</p>
<p>
_Le site auquel je fais une requete ne repond pas. (serveur down donc il ne me renvoie meme pas un code d\'etat)
</p>
<blockquote>
<p>

Mais dans ce cas, il faudrait que j\'ai accès à ce qui déclanche l\'exception 0x80040111 pour pouvoir changer ça... Et c\'est là où j\'en suis, parce qu\'il n\'y a aucune information de ce type sur le net... :( (Ou alors j\'ai pas trouvé)

</p></blockquote>
<p>
Ben là il n\'y a que la console javascript de mozilla qui va nous aider... quoique Regarde tes logs d\'apache (error et access) ils disent quoi quand tu essai de charger test.text?
</p>',
    2 => '<p>Cyrare a écrit:</p>

<blockquote>
<p>J\'ai donc bien mis les types mime oui, (vu que le fichier se lance) et j\'ai mis un chmod à 777 sur le répertoire et ses fichiers pour pas être embêté par ça.</p></blockquote>

<p>tu es bien sur de ton type-mime? Le meilleure moyen c\'est dans Mozilla: Affichage-&gt;Informations sur la page-&gt;Onglet Général-&gt;type: là tu dois avoir application/vnd.mozilla.xul+xml
Parce que si tu as text/xml ou text/html ca ne vas pas deranger Mozilla te t\'afficher la page (il l\'interpretera comme du XML, car ton fichier .xul doit commencer par &lt;?xml version=&quot;1.0&quot; encoding=&quot;UTF-8&quot;?&gt;). C\'est pas parce que ca a l\'air de bien s\'afficher que Mozilla prend ca pour du XUL.</p>

<blockquote>
<p>Je suis content parce que tu raisonnes comme moi, ça prouve que je suis pas un abruti avec un réponse évidente que je ne vois pas. ;)</p></blockquote>

<p>Ou alors on est deux abrutis? ;-)</p>

<blockquote>
<p>Ce que je me demande, vu que XUL lance bien le fichier (sans le charger) et vu que .status lance une exception, si c\'est pas mon apache qui doit lancer par exemple une information au navigateur (par exemple le status) et qu\'il l\'ommet, ou le fait mal, d\'où l\'erreur.</p></blockquote>

<p>Pour le lancement d\'une requete http il n\'y a jamais de problemes (hormis les privileges), si elle tombe dans le vide ou echoue c\'est a la lecture de le reponse (status ou responseText par exemple) que ca va poser probleme. Et Apache ne peut pas se planter au niveau des codes d\'etat HTTP (200 ou autre), en tous cas c\'est pas de ton ressort ce n\'est pas accessible par httpd.conf. La seul chose dans notre cas ou il peut merdouiller c\'est les type-mimes, mais toi tu attend un responseText , ca devrait marcher a tous les coup ca!!!</p>

<p>Personnelement les seul fois ou j\'ai vu des exceptions se lancer avec XMLHttpRequest() c\'etait dans les cas suivant:</p>

<p>_j\'avais deja une autre instance de lancer.</p>

<p>_Deux instances essayait de se lancer en meme temps.</p>

<p>_j\'etais en mode synchrone et j\'essayais de lire la reponse avant qu\'elle ne soit arrivée (d\'ou ma solution numero 2, voir mon premier post plus haut, qui t\'evite ce genre d\'ennui).</p>

<p>_Le site auquel je fais une requete ne repond pas. (serveur down donc il ne me renvoie meme pas un code d\'etat)</p>

<blockquote>
<p>
Mais dans ce cas, il faudrait que j\'ai accès à ce qui déclanche l\'exception 0x80040111 pour pouvoir changer ça... Et c\'est là où j\'en suis, parce qu\'il n\'y a aucune information de ce type sur le net... :( (Ou alors j\'ai pas trouvé)
</p></blockquote>

<p>Ben là il n\'y a que la console javascript de mozilla qui va nous aider... quoique Regarde tes logs d\'apache (error et access) ils disent quoi quand tu essai de charger test.text?</p>


',
  ),
  74 => 
  array (
    0 => 'hummmm, faudrais rajouter dynamiquement dans ta phrase des balises pour entourer ton (ou tes) mot(s).

Personnelement, j\'ai jamais fait. D\'un autre coté il existe peut etre une methode que je ne connait pas encore',
    1 => '<p>
hummmm, faudrais rajouter dynamiquement dans ta phrase des balises pour entourer ton (ou tes) mot(s).
</p>
<p>
Personnelement, j\'ai jamais fait. D\'un autre coté il existe peut etre une methode que je ne connait pas encore
</p>',
    2 => '<p>hummmm, faudrais rajouter dynamiquement dans ta phrase des balises pour entourer ton (ou tes) mot(s).</p>

<p>Personnelement, j\'ai jamais fait. D\'un autre coté il existe peut etre une methode que je ne connait pas encore</p>',
  ),
  75 => 
  array (
    0 => '> Ce que j\'aimerais réaliser, c\'est intégrer cette application à Firefox sous forme d\'une barre d\'outils

Le plus simple, c\'est que tu ne fasses pas ton appli en java, mais en javascript ou c++ (XPCOM) et XUL. Parce que appeler du Java à partir de tes fichiers javascript, ça va pas être possible je pense.

Et pour l\'integrer, il faut en faire une extension (voir [/wiki/ExtensionsFirefox] ) qui contient [des overlays|http://xulfr.org/xulplanet/xultu/overlay.html] dont le rôle est de modifier l\'interface de Firefox (en ajoutant des boutons où tu veux, des items de menu sur le clic droit etc..)
',
    1 => '<blockquote>
<p>
 Ce que j\'aimerais réaliser, c\'est intégrer cette application à Firefox sous forme d\'une barre d\'outils
</p></blockquote>
<p>
Le plus simple, c\'est que tu ne fasses pas ton appli en java, mais en javascript ou c++ (XPCOM) et XUL. Parce que appeler du Java à partir de tes fichiers javascript, ça va pas être possible je pense.
</p>
<p>
Et pour l\'integrer, il faut en faire une extension (voir <a href="/wiki/ExtensionsFirefox">/wiki/ExtensionsFirefox</a> ) qui contient <a href="http://xulfr.org/xulplanet/xultu/overlay.html">des overlays</a> dont le rôle est de modifier l\'interface de Firefox (en ajoutant des boutons où tu veux, des items de menu sur le clic droit etc..)
</p>',
    2 => '<blockquote>
<p> Ce que j\'aimerais réaliser, c\'est intégrer cette application à Firefox sous forme d\'une barre d\'outils</p></blockquote>

<p>Le plus simple, c\'est que tu ne fasses pas ton appli en java, mais en javascript ou c++ (XPCOM) et XUL. Parce que appeler du Java à partir de tes fichiers javascript, ça va pas être possible je pense.</p>

<p>Et pour l\'integrer, il faut en faire une extension (voir <a href="/wiki/ExtensionsFirefox">/wiki/ExtensionsFirefox</a> ) qui contient <a href="http://xulfr.org/xulplanet/xultu/overlay.html">des overlays</a> dont le rôle est de modifier l\'interface de Firefox (en ajoutant des boutons où tu veux, des items de menu sur le clic droit etc..)</p>
',
  ),
  76 => 
  array (
    0 => 'bonjour,
DSL, j\'ai deja poster un message de ce genre mais j\'ajoute ici quelques infos supplementaires
suite à la réalisation d\'une appli xul, j\'aimerai la distribuer. Pour cela je dois enregistrer un objet XPCOM propre à l\'application.
L\'enregistrement de cette objet ce fait tres bien avec mes differentes version de mozilla compilés par mes soins. Par contre quand j\'utilise une version "classique" installer avec un exe (et l\'application est sous windows dsl :-( ) de mozilla, impossible d\'enregistrer l\'objet.... :-(

Apres avoir parcourus le toile dans tout les sens, j\'ai testé plusieurs solutions : 
* ajout du fichier .autoreg 
* placer la dll et le xpt dans le repertoire components avec relancement demozilla
* enregistrement avec regxpcom.exe 

et la je bloque.
donc si quelqu\'un à une idée ... je suis preneur  ;-)
merci 

',
    1 => '<p>
bonjour,
DSL, j\'ai deja poster un message de ce genre mais j\'ajoute ici quelques infos supplementaires
suite à la réalisation d\'une appli xul, j\'aimerai la distribuer. Pour cela je dois enregistrer un objet XPCOM propre à l\'application.
L\'enregistrement de cette objet ce fait tres bien avec mes differentes version de mozilla compilés par mes soins. Par contre quand j\'utilise une version &quot;classique&quot; installer avec un exe (et l\'application est sous windows dsl :-( ) de mozilla, impossible d\'enregistrer l\'objet.... :-(
</p>
<p>
Apres avoir parcourus le toile dans tout les sens, j\'ai testé plusieurs solutions : 
</p>
<ul>

<li> ajout du fichier .autoreg 
</li>
<li> placer la dll et le xpt dans le repertoire components avec relancement demozilla
</li>
<li> enregistrement avec regxpcom.exe 
</li>
</ul>

<p>
et la je bloque.
donc si quelqu\'un à une idée ... je suis preneur  ;-)
merci 
</p>',
    2 => '<p>bonjour,
DSL, j\'ai deja poster un message de ce genre mais j\'ajoute ici quelques infos supplementaires
suite à la réalisation d\'une appli xul, j\'aimerai la distribuer. Pour cela je dois enregistrer un objet XPCOM propre à l\'application.
L\'enregistrement de cette objet ce fait tres bien avec mes differentes version de mozilla compilés par mes soins. Par contre quand j\'utilise une version &quot;classique&quot; installer avec un exe (et l\'application est sous windows dsl :-( ) de mozilla, impossible d\'enregistrer l\'objet.... :-(</p>

<p>Apres avoir parcourus le toile dans tout les sens, j\'ai testé plusieurs solutions : </p>
<ul>
<li>ajout du fichier .autoreg </li>
<li>placer la dll et le xpt dans le repertoire components avec relancement demozilla</li>
<li>enregistrement avec regxpcom.exe </li>
</ul>

<p>et la je bloque.
donc si quelqu\'un à une idée ... je suis preneur  ;-)
merci </p>

',
  ),
  77 => 
  array (
    0 => 'Merci, ça marche impec et c\'est simple.

Mais bon, j\'ai l\'impression que les packages mozilla c\'est un peu la fête au village :( 

(les nigthly build supportent pas le svg et j\'ai des pb de chargement de javascript (même avec les fichiers de test inclu dans la distrib))

Je vais attendre un peu avant de continuer.

Merci et a+',
    1 => '<p>
Merci, ça marche impec et c\'est simple.
</p>
<p>
Mais bon, j\'ai l\'impression que les packages mozilla c\'est un peu la fête au village :( 
</p>
<p>
(les nigthly build supportent pas le svg et j\'ai des pb de chargement de javascript (même avec les fichiers de test inclu dans la distrib))
</p>
<p>
Je vais attendre un peu avant de continuer.
</p>
<p>
Merci et a+
</p>',
    2 => '<p>Merci, ça marche impec et c\'est simple.</p>

<p>Mais bon, j\'ai l\'impression que les packages mozilla c\'est un peu la fête au village :( </p>

<p>(les nigthly build supportent pas le svg et j\'ai des pb de chargement de javascript (même avec les fichiers de test inclu dans la distrib))</p>

<p>Je vais attendre un peu avant de continuer.</p>

<p>Merci et a+</p>',
  ),
  78 => 
  array (
    0 => 's/serait-il/__saurait-il__/

la feuille de style du thème n\'est peut etre pas tout à fait la même. Pour la toolbar, cela doit certainement indiquer d\'utiliser le widget toolbar de GTK pour le rendu. Et peut être que ce widget n\'autorise pas ce changement de couleur. Il faut donc le désactiver.
Et lire le tutoriel à ce propos également ;-) Voir la note du traducteur sur [la page de création d\'un theme|http://xulfr.org/xulplanet/xultu/cskin.html]


Faut donc que tu inspectes la feuille de style du theme classic afin d\'annuler dans ta feuille à toi les styles qui te génent.

À part ça, les styles inlines, c\'est pas top, c\'est mieux de proposer une feuille de style supplémentaire pour le theme classique dans ton extension (chrome://tonextension/skin/tafeuille.css etc..).

',
    1 => '<p>
s/serait-il/<strong>saurait-il</strong>/
</p>
<p>
la feuille de style du thème n\'est peut etre pas tout à fait la même. Pour la toolbar, cela doit certainement indiquer d\'utiliser le widget toolbar de GTK pour le rendu. Et peut être que ce widget n\'autorise pas ce changement de couleur. Il faut donc le désactiver.
Et lire le tutoriel à ce propos également ;-) Voir la note du traducteur sur <a href="http://xulfr.org/xulplanet/xultu/cskin.html">la page de création d\'un theme</a>
</p>
<p>
Faut donc que tu inspectes la feuille de style du theme classic afin d\'annuler dans ta feuille à toi les styles qui te génent.
</p>
<p>
À part ça, les styles inlines, c\'est pas top, c\'est mieux de proposer une feuille de style supplémentaire pour le theme classique dans ton extension (chrome://tonextension/skin/tafeuille.css etc..).
</p>',
    2 => '<p>s/serait-il/<strong>saurait-il</strong>/</p>

<p>la feuille de style du thème n\'est peut etre pas tout à fait la même. Pour la toolbar, cela doit certainement indiquer d\'utiliser le widget toolbar de GTK pour le rendu. Et peut être que ce widget n\'autorise pas ce changement de couleur. Il faut donc le désactiver.
Et lire le tutoriel à ce propos également ;-) Voir la note du traducteur sur <a href="http://xulfr.org/xulplanet/xultu/cskin.html">la page de création d\'un theme</a></p>


<p>Faut donc que tu inspectes la feuille de style du theme classic afin d\'annuler dans ta feuille à toi les styles qui te génent.</p>

<p>À part ça, les styles inlines, c\'est pas top, c\'est mieux de proposer une feuille de style supplémentaire pour le theme classique dans ton extension (chrome://tonextension/skin/tafeuille.css etc..).</p>

',
  ),
  79 => 
  array (
    0 => 'Il y a du mieux, j\'accès à la page avec mozilla. Par contre elle fait boguer firefox, mais d\'une manière différente. Maintenant quand je clique sur le lien pour lire la discussion, ça plante : il ne se passe plus rien...',
    1 => '<p>
Il y a du mieux, j\'accès à la page avec mozilla. Par contre elle fait boguer firefox, mais d\'une manière différente. Maintenant quand je clique sur le lien pour lire la discussion, ça plante : il ne se passe plus rien...
</p>',
    2 => '<p>Il y a du mieux, j\'accès à la page avec mozilla. Par contre elle fait boguer firefox, mais d\'une manière différente. Maintenant quand je clique sur le lien pour lire la discussion, ça plante : il ne se passe plus rien...</p>',
  ),
  80 => 
  array (
    0 => 'Voir ce sujet ci sur le forum :

[Installer Xulmaker sur un mozilla récent|http://xulfr.org/forums/read.php?2,12]',
    1 => '<p>
Voir ce sujet ci sur le forum :
</p>
<p>
<a href="http://xulfr.org/forums/read.php?2,12">Installer Xulmaker sur un mozilla récent</a>
</p>',
    2 => '<p>Voir ce sujet ci sur le forum :</p>

<p><a href="http://xulfr.org/forums/read.php?2,12">Installer Xulmaker sur un mozilla récent</a></p>',
  ),
  81 => 
  array (
    0 => 'désolé, je ne connais pas cette partie de  moz...',
    1 => '<p>
désolé, je ne connais pas cette partie de  moz...
</p>',
    2 => '<p>désolé, je ne connais pas cette partie de  moz...</p>',
  ),
  82 => 
  array (
    0 => 'salut,
je fais un extension firefox avec du xul, et je voudrai mettre la toolbar en couleur.
pour cela j\'utilise style="background-color:#FF8000", ce qui marche sur firefox lorsque je suis sous windows, mais pas lorsque je suis sous linux.

   <toolbar id="bar"
	accesskey="H"
	class="chromeclass-toolbar"
	context="toolbar-context-menu"
	toolbarname="Nhan-Toolbar"
	hidden="false"
	persist="hidden"
	style="background-color:#FF8000">
     ...
   </toolbar>

quelqu\'un serait-il pourquoi?
et il y a t-il une solution?
merci',
    1 => '<p>
salut,
je fais un extension firefox avec du xul, et je voudrai mettre la toolbar en couleur.
pour cela j\'utilise style=&quot;background-color:#FF8000&quot;, ce qui marche sur firefox lorsque je suis sous windows, mais pas lorsque je suis sous linux.
</p>
<pre>
  &lt;toolbar id=&quot;bar&quot;
accesskey=&quot;H&quot;
class=&quot;chromeclass-toolbar&quot;
context=&quot;toolbar-context-menu&quot;
toolbarname=&quot;Nhan-Toolbar&quot;
hidden=&quot;false&quot;
persist=&quot;hidden&quot;
style=&quot;background-color:#FF8000&quot;&gt;
    ...
  &lt;/toolbar&gt;
</pre>
<p>
quelqu\'un serait-il pourquoi?
et il y a t-il une solution?
merci
</p>',
    2 => '<p>salut,
je fais un extension firefox avec du xul, et je voudrai mettre la toolbar en couleur.
pour cela j\'utilise style=&quot;background-color:#FF8000&quot;, ce qui marche sur firefox lorsque je suis sous windows, mais pas lorsque je suis sous linux.</p>

<pre>  &lt;toolbar id=&quot;bar&quot;
accesskey=&quot;H&quot;
class=&quot;chromeclass-toolbar&quot;
context=&quot;toolbar-context-menu&quot;
toolbarname=&quot;Nhan-Toolbar&quot;
hidden=&quot;false&quot;
persist=&quot;hidden&quot;
style=&quot;background-color:#FF8000&quot;&gt;
    ...
  &lt;/toolbar&gt;
</pre>

<p>quelqu\'un serait-il pourquoi?
et il y a t-il une solution?
merci</p>',
  ),
  83 => 
  array (
    0 => 'Je voudrais trouver un moyen d\'effectuer une proposer à l\'utilisateur de mon appli XUL un outil de recherche textuelle dans une liste multicolonnes...

Quelqu\'un connait-il un exemple d\'utilisation de l\'interface nsIFind ? 

Y a t-il une solution plus simple ?

Merci',
    1 => '<p>
Je voudrais trouver un moyen d\'effectuer une proposer à l\'utilisateur de mon appli XUL un outil de recherche textuelle dans une liste multicolonnes...
</p>
<p>
Quelqu\'un connait-il un exemple d\'utilisation de l\'interface nsIFind ? 
</p>
<p>
Y a t-il une solution plus simple ?
</p>
<p>
Merci
</p>',
    2 => '<p>Je voudrais trouver un moyen d\'effectuer une proposer à l\'utilisateur de mon appli XUL un outil de recherche textuelle dans une liste multicolonnes...</p>

<p>Quelqu\'un connait-il un exemple d\'utilisation de l\'interface nsIFind ? </p>

<p>Y a t-il une solution plus simple ?</p>

<p>Merci</p>',
  ),
  84 => 
  array (
    0 => 'Bon j\'arrive sans mal à avoir la balise parent du text mais toujours pas la balise text. Le probleme sur une page HTML :
<HTML><P></P><P>SOLARIS<B>c\'est</B>bien</P></HTML>
sous l\'arbre DOM ca donne:
  |
 HTML--+---P
       |
       +---P---+----text (SOLARIS)
               |
               +----B    (c\'est)
               |
               +----text  (bien)

Impossible de distinger le text \'SOLARIS\' du text \'bien\' (qui n\'ont pas le meme numero de fils sur l\'objet P) meme en mettant un addevent sur l\'objet text. 
La je tombe en ruine et commmence a mépuisé sur le idee =o(',
    1 => '<p>
Bon j\'arrive sans mal à avoir la balise parent du text mais toujours pas la balise text. Le probleme sur une page HTML :
&lt;HTML&gt;&lt;P&gt;&lt;/P&gt;&lt;P&gt;SOLARIS&lt;B&gt;c\'est&lt;/B&gt;bien&lt;/P&gt;&lt;/HTML&gt;
sous l\'arbre DOM ca donne:
</p>
<pre>
 |
HTML--+---P
      |
      +---P---+----text (SOLARIS)
              |
              +----B    (c\'est)
              |
              +----text  (bien)
</pre>
<p>
Impossible de distinger le text \'SOLARIS\' du text \'bien\' (qui n\'ont pas le meme numero de fils sur l\'objet P) meme en mettant un addevent sur l\'objet text. 
La je tombe en ruine et commmence a mépuisé sur le idee =o(
</p>',
    2 => '<p>Bon j\'arrive sans mal à avoir la balise parent du text mais toujours pas la balise text. Le probleme sur une page HTML :
&lt;HTML&gt;&lt;P&gt;&lt;/P&gt;&lt;P&gt;SOLARIS&lt;B&gt;c\'est&lt;/B&gt;bien&lt;/P&gt;&lt;/HTML&gt;
sous l\'arbre DOM ca donne:</p>
<pre> |
HTML--+---P
      |
      +---P---+----text (SOLARIS)
              |
              +----B    (c\'est)
              |
              +----text  (bien)
</pre>

<p>Impossible de distinger le text \'SOLARIS\' du text \'bien\' (qui n\'ont pas le meme numero de fils sur l\'objet P) meme en mettant un addevent sur l\'objet text. 
La je tombe en ruine et commmence a mépuisé sur le idee =o(</p>',
  ),
  85 => 
  array (
    0 => 'Salut,

il marche tres bien le windows.close(); sous FireFox (sous la suite Mozilla aussi d\'ailleurs). Par contre toi, tu ne lances pas ton application comme une application chrome, tu devrais la lancer comme ceçi:
 /ton_chemin/firefox.exe -chrome "chrome://findfile/content/findfile.xul"

avec çà tu as vraiment lancer le "protocole" chrome. Bien sûr, tu devra avoir installer ton appli XUL comme préciser ici: [http://xulfr.org/wiki/ConfigurerMozillaPourDevelopper] Lis surtout le chap 3

@+
David',
    1 => '<p>
Salut,
</p>
<p>
il marche tres bien le windows.close(); sous FireFox (sous la suite Mozilla aussi d\'ailleurs). Par contre toi, tu ne lances pas ton application comme une application chrome, tu devrais la lancer comme ceçi:
</p>
<pre>
/ton_chemin/firefox.exe -chrome &quot;chrome://findfile/content/findfile.xul&quot;
</pre>
<p>
avec çà tu as vraiment lancer le &quot;protocole&quot; chrome. Bien sûr, tu devra avoir installer ton appli XUL comme préciser ici: <a href="http://xulfr.org/wiki/ConfigurerMozillaPourDevelopper">http://xulfr.org/wiki/ConfigurerMozillaP(..)</a> Lis surtout le chap 3
</p>
<p>
@+
David
</p>',
    2 => '<p>Salut,</p>

<p>il marche tres bien le windows.close(); sous FireFox (sous la suite Mozilla aussi d\'ailleurs). Par contre toi, tu ne lances pas ton application comme une application chrome, tu devrais la lancer comme ceçi:</p>
<pre>/ton_chemin/firefox.exe -chrome &quot;chrome://findfile/content/findfile.xul&quot;
</pre>

<p>avec çà tu as vraiment lancer le &quot;protocole&quot; chrome. Bien sûr, tu devra avoir installer ton appli XUL comme préciser ici: <a href="http://xulfr.org/wiki/ConfigurerMozillaPourDevelopper">http://xulfr.org/wiki/ConfigurerMozillaP(..)</a> Lis surtout le chap 3</p>

<p>@+
David</p>',
  ),
  86 => 
  array (
    0 => 'Pour avoir toutes la listes des styles et pseudo classes CSS de mozilla, rien ne vaut le code source :-)

Allez voir la liste des liens en bas de [http://xulfr.org/wiki/RessourcesWeb]',
    1 => '<p>
Pour avoir toutes la listes des styles et pseudo classes CSS de mozilla, rien ne vaut le code source <img src="laugh.png" alt=":-)"/>
</p>
<p>
Allez voir la liste des liens en bas de <a href="http://xulfr.org/wiki/RessourcesWeb">http://xulfr.org/wiki/RessourcesWeb</a>
</p>',
    2 => '<p>Pour avoir toutes la listes des styles et pseudo classes CSS de mozilla, rien ne vaut le code source <img src="laugh.png" alt=":-)"/></p>

<p>Allez voir la liste des liens en bas de <a href="http://xulfr.org/wiki/RessourcesWeb">http://xulfr.org/wiki/RessourcesWeb</a></p>',
  ),
  87 => 
  array (
    0 => 'Bonjour,
je découvre le xul et je le trouve assez performant et prometteur.
Or, j\'ai un projet à réaliser dans lequel je dois utiliser le presse papier de Mozilla.
J\'ai lu le tutoriel (trés bien fais), je m\'en suis inspiré pour essayer de réaliser mon projet et je bloque sur le code du presse papier :

__Code pour copier__
 var copytext=texte;
 
 var str =  Components.classes["@mozilla.org/supports-string;1"]
 .createInstance(Components.interfaces.nsISupportsString);
 if (!str) return false;
 
 str.data=copytext;
 var trans =  Components.classes["@mozilla.org/widget/transferable;1"]
 .createInstance(Components.interfaces.nsITransferable);
 if (!trans) return false;
 
 trans.addDataFlavor("text/unicode");
 trans.setTransferData("text/unicode",str,copytext.length*2);
 
 var clipid=Components.interfaces.nsIClipboard;
 var clip = Components.classes["@mozilla.org/widget/clipboard;1"]
 .getService(clipid);
 if (!clip) return false;
 
 clip.setData(trans,null,clipid.kGlobalClipboard);

Le problème, c\'est que la console javascript de Mozilla me retourne l\'erreur : \'\'Erreur : uncaught exception: Permission refusée d\'obtenir la propriété UnnamedClass.classes\'\'

Si quelqu\'un pouvais me filer un coup de mains, je lui en serais trés reconnaissant parceque là je galère.
Merci bcp ',
    1 => '<p>
Bonjour,
je découvre le xul et je le trouve assez performant et prometteur.
Or, j\'ai un projet à réaliser dans lequel je dois utiliser le presse papier de Mozilla.
J\'ai lu le tutoriel (trés bien fais), je m\'en suis inspiré pour essayer de réaliser mon projet et je bloque sur le code du presse papier :
</p>
<p>
<strong>Code pour copier</strong>
</p>
<pre>
var copytext=texte;

var str =  Components.classes[&quot;@mozilla.org/supports-string;1&quot;]
.createInstance(Components.interfaces.nsISupportsString);
if (!str) return false;

str.data=copytext;
var trans =  Components.classes[&quot;@mozilla.org/widget/transferable;1&quot;]
.createInstance(Components.interfaces.nsITransferable);
if (!trans) return false;

trans.addDataFlavor(&quot;text/unicode&quot;);
trans.setTransferData(&quot;text/unicode&quot;,str,copytext.length*2);

var clipid=Components.interfaces.nsIClipboard;
var clip = Components.classes[&quot;@mozilla.org/widget/clipboard;1&quot;]
.getService(clipid);
if (!clip) return false;

clip.setData(trans,null,clipid.kGlobalClipboard);
</pre>
<p>
Le problème, c\'est que la console javascript de Mozilla me retourne l\'erreur : <em>Erreur : uncaught exception: Permission refusée d\'obtenir la propriété UnnamedClass.classes</em>
</p>
<p>
Si quelqu\'un pouvais me filer un coup de mains, je lui en serais trés reconnaissant parceque là je galère.
Merci bcp 
</p>',
    2 => '<p>Bonjour,
je découvre le xul et je le trouve assez performant et prometteur.
Or, j\'ai un projet à réaliser dans lequel je dois utiliser le presse papier de Mozilla.
J\'ai lu le tutoriel (trés bien fais), je m\'en suis inspiré pour essayer de réaliser mon projet et je bloque sur le code du presse papier :</p>

<p><strong>Code pour copier</strong></p>
<pre>var copytext=texte;

var str =  Components.classes[&quot;@mozilla.org/supports-string;1&quot;]
.createInstance(Components.interfaces.nsISupportsString);
if (!str) return false;

str.data=copytext;
var trans =  Components.classes[&quot;@mozilla.org/widget/transferable;1&quot;]
.createInstance(Components.interfaces.nsITransferable);
if (!trans) return false;

trans.addDataFlavor(&quot;text/unicode&quot;);
trans.setTransferData(&quot;text/unicode&quot;,str,copytext.length*2);

var clipid=Components.interfaces.nsIClipboard;
var clip = Components.classes[&quot;@mozilla.org/widget/clipboard;1&quot;]
.getService(clipid);
if (!clip) return false;

clip.setData(trans,null,clipid.kGlobalClipboard);
</pre>

<p>Le problème, c\'est que la console javascript de Mozilla me retourne l\'erreur : <em>Erreur : uncaught exception: Permission refusée d\'obtenir la propriété UnnamedClass.classes</em></p>

<p>Si quelqu\'un pouvais me filer un coup de mains, je lui en serais trés reconnaissant parceque là je galère.
Merci bcp </p>',
  ),
  88 => 
  array (
    0 => 'LupusMic : à l\'heure où je tape ces lignes, la calculatrice ne fonctionne pas (erreur php) et l\'archive bz est corrompue :-(',
    1 => '<p>
LupusMic : à l\'heure où je tape ces lignes, la calculatrice ne fonctionne pas (erreur php) et l\'archive bz est corrompue :-(
</p>',
    2 => '<p>LupusMic : à l\'heure où je tape ces lignes, la calculatrice ne fonctionne pas (erreur php) et l\'archive bz est corrompue :-(</p>',
  ),
  89 => 
  array (
    0 => 'Bonjour,

Je débute en XUL.
Comment préciser une listbox avec du multiselect ?

la définition est :

<listbox id="liste1" rows="10" >


<listitem label="Item 1" value="I1"/>


<listitem label="Item 2" value="I2"/>

</listbox>

Merci pour vos réponses.
',
    1 => '<p>
Bonjour,
</p>
<p>
Je débute en XUL.
Comment préciser une listbox avec du multiselect ?
</p>
<p>
la définition est :
</p>
<p>
&lt;listbox id=&quot;liste1&quot; rows=&quot;10&quot; &gt;
</p>
<p>
&lt;listitem label=&quot;Item 1&quot; value=&quot;I1&quot;/&gt;
</p>
<p>
&lt;listitem label=&quot;Item 2&quot; value=&quot;I2&quot;/&gt;
</p>
<p>
&lt;/listbox&gt;
</p>
<p>
Merci pour vos réponses.
</p>',
    2 => '<p>Bonjour,</p>

<p>Je débute en XUL.
Comment préciser une listbox avec du multiselect ?</p>

<p>la définition est :</p>

<p>&lt;listbox id=&quot;liste1&quot; rows=&quot;10&quot; &gt;</p>


<p>&lt;listitem label=&quot;Item 1&quot; value=&quot;I1&quot;/&gt;</p>


<p>&lt;listitem label=&quot;Item 2&quot; value=&quot;I2&quot;/&gt;</p>

<p>&lt;/listbox&gt;</p>

<p>Merci pour vos réponses.</p>
',
  ),
  90 => 
  array (
    0 => 'Salut,


Je pense que Xul est le genre d\'interface qu\'il te faut pour ce genre de projet. Tout ce que j\'ai lu semble faisable avec Xul.

Toutefois il y a deux bemols qui doivent retenir ton attention:
* Premierement Xul ne FONCTIONNE que sous Mozilla, et non sous IE.
* Deuxiement, a l\'heure actuel il n\'existe pas enormement de documentation (riche comme pourrait etre Java) sur les composants de Gecko. Donc arme toi de patience si tu veux faire des choses en dehors des chantiers battus. 
A part ca, Xul c\'est vraiment de la balle qui tue :)
Salutation,
Theo',
    1 => '<p>
Salut,
</p>
<p>
Je pense que Xul est le genre d\'interface qu\'il te faut pour ce genre de projet. Tout ce que j\'ai lu semble faisable avec Xul.
</p>
<p>
Toutefois il y a deux bemols qui doivent retenir ton attention:
</p>
<ul>

<li>Premierement Xul ne FONCTIONNE que sous Mozilla, et non sous IE.
</li>
<li> Deuxiement, a l\'heure actuel il n\'existe pas enormement de documentation (riche comme pourrait etre Java) sur les composants de Gecko. Donc arme toi de patience si tu veux faire des choses en dehors des chantiers battus. 
</li>
</ul>

<p>
A part ca, Xul c\'est vraiment de la balle qui tue :)
Salutation,
Theo
</p>',
    2 => '<p>Salut,</p>


<p>Je pense que Xul est le genre d\'interface qu\'il te faut pour ce genre de projet. Tout ce que j\'ai lu semble faisable avec Xul.</p>

<p>Toutefois il y a deux bemols qui doivent retenir ton attention:</p>
<ul>
<li>Premierement Xul ne FONCTIONNE que sous Mozilla, et non sous IE.</li>
<li>Deuxiement, a l\'heure actuel il n\'existe pas enormement de documentation (riche comme pourrait etre Java) sur les composants de Gecko. Donc arme toi de patience si tu veux faire des choses en dehors des chantiers battus. </li>
</ul>
<p>A part ca, Xul c\'est vraiment de la balle qui tue :)
Salutation,
Theo</p>',
  ),
  91 => 
  array (
    0 => '> Pouvez vous m\'indiquer ou chercher ?

Posez votre annonce ici et éventuellement aussi dans la mailing-list.

Il n\'y a pas à ma connaissance d\'autres endroits plus "ciblés".

Pour viser plus large, vous avez [http://fr.lolix.org/] par exemple.

',
    1 => '<blockquote>
<p>
 Pouvez vous m\'indiquer ou chercher ?
</p></blockquote>
<p>
Posez votre annonce ici et éventuellement aussi dans la mailing-list.
</p>
<p>
Il n\'y a pas à ma connaissance d\'autres endroits plus &quot;ciblés&quot;.
</p>
<p>
Pour viser plus large, vous avez <a href="http://fr.lolix.org/">http://fr.lolix.org/</a> par exemple.
</p>',
    2 => '<blockquote>
<p> Pouvez vous m\'indiquer ou chercher ?</p></blockquote>

<p>Posez votre annonce ici et éventuellement aussi dans la mailing-list.</p>

<p>Il n\'y a pas à ma connaissance d\'autres endroits plus &quot;ciblés&quot;.</p>

<p>Pour viser plus large, vous avez <a href="http://fr.lolix.org/">http://fr.lolix.org/</a> par exemple.</p>

',
  ),
  92 => 
  array (
    0 => 'Bonjour,

J\'essaye d\'insérer des balises html dans les choix d\'une liste déroulantes, par exemple <sub> <sup> ou même éventuellement des balises mathml. En fait, mon but est de créer une liste déroulante laissant à l\'utilisateur le choix entre différentes unités, comme m² ou mètres cubes ...

J\'ai tout d\'abord essayé de le faire en html, voici la source:
 <form action="post">
  <p>
   <select>
    <option>m<sup>2</sup></option>
    <option>m<sup>3</sup></option>
   </select>
  </p>
 </form>

malheureusement, cela n\'a pas fonctionné : cela n\'affiche à l\'écran que les noeuds textes qui descendent du noeud <option>, et ce aussi bien dans la case de choix que dans le menu déroulant (m2 au lieu de m² pour m<sup>2</sup>).

J\'ai donc essayé en xhtml avec le même code. Cela n\'a pas fonctionné non plus, cependant dans le menu déroulant, je pouvais voir m². Dans la case du choix, par contre, s\'affichait seulement les noeuds textes fils de <option> : je voyais seulement m à la place de m².

J\'ai alors décidé d\'utiliser xul, voici le code que j\'ai utilisé:
 <box>
  <menulist>
   <menupopup>
    <menuitem label="m"/>
    <menuitem label="m"/>
   </menupopup>
  </menulist>
 </box>

Le problème en xul est que label est un attribut de menuitem (alors que option était un élément en html et xhtml). Il semble donc impossible d\'utiliser <sub>, <sup> ou autres balises mathml à l\'interieur.

Est-ce que quelqu\'un connaitrai une solution qui permettrait l\'insertion d\'exposants dans des menu déroulants, et ce sans avoir à créer une nouvelle structure grace a html/css/javascript ou xul/xbl/css comme j\'envisage actuellement de le faire?

Merci d\'avance',
    1 => '<p>
Bonjour,
</p>
<p>
J\'essaye d\'insérer des balises html dans les choix d\'une liste déroulantes, par exemple &lt;sub&gt; &lt;sup&gt; ou même éventuellement des balises mathml. En fait, mon but est de créer une liste déroulante laissant à l\'utilisateur le choix entre différentes unités, comme m² ou mètres cubes ...
</p>
<p>
J\'ai tout d\'abord essayé de le faire en html, voici la source:
</p>
<pre>
&lt;form action=&quot;post&quot;&gt;
 &lt;p&gt;
  &lt;select&gt;
   &lt;option&gt;m&lt;sup&gt;2&lt;/sup&gt;&lt;/option&gt;
   &lt;option&gt;m&lt;sup&gt;3&lt;/sup&gt;&lt;/option&gt;
  &lt;/select&gt;
 &lt;/p&gt;
&lt;/form&gt;
</pre>
<p>
malheureusement, cela n\'a pas fonctionné : cela n\'affiche à l\'écran que les noeuds textes qui descendent du noeud &lt;option&gt;, et ce aussi bien dans la case de choix que dans le menu déroulant (m2 au lieu de m² pour m&lt;sup&gt;2&lt;/sup&gt;).
</p>
<p>
J\'ai donc essayé en xhtml avec le même code. Cela n\'a pas fonctionné non plus, cependant dans le menu déroulant, je pouvais voir m². Dans la case du choix, par contre, s\'affichait seulement les noeuds textes fils de &lt;option&gt; : je voyais seulement m à la place de m².
</p>
<p>
J\'ai alors décidé d\'utiliser xul, voici le code que j\'ai utilisé:
</p>
<pre>
&lt;box&gt;
 &lt;menulist&gt;
  &lt;menupopup&gt;
   &lt;menuitem label=&quot;m&quot;/&gt;
   &lt;menuitem label=&quot;m&quot;/&gt;
  &lt;/menupopup&gt;
 &lt;/menulist&gt;
&lt;/box&gt;
</pre>
<p>
Le problème en xul est que label est un attribut de menuitem (alors que option était un élément en html et xhtml). Il semble donc impossible d\'utiliser &lt;sub&gt;, &lt;sup&gt; ou autres balises mathml à l\'interieur.
</p>
<p>
Est-ce que quelqu\'un connaitrai une solution qui permettrait l\'insertion d\'exposants dans des menu déroulants, et ce sans avoir à créer une nouvelle structure grace a html/css/javascript ou xul/xbl/css comme j\'envisage actuellement de le faire?
</p>
<p>
Merci d\'avance
</p>',
    2 => '<p>Bonjour,</p>

<p>J\'essaye d\'insérer des balises html dans les choix d\'une liste déroulantes, par exemple &lt;sub&gt; &lt;sup&gt; ou même éventuellement des balises mathml. En fait, mon but est de créer une liste déroulante laissant à l\'utilisateur le choix entre différentes unités, comme m² ou mètres cubes ...</p>

<p>J\'ai tout d\'abord essayé de le faire en html, voici la source:</p>
<pre>&lt;form action=&quot;post&quot;&gt;
 &lt;p&gt;
  &lt;select&gt;
   &lt;option&gt;m&lt;sup&gt;2&lt;/sup&gt;&lt;/option&gt;
   &lt;option&gt;m&lt;sup&gt;3&lt;/sup&gt;&lt;/option&gt;
  &lt;/select&gt;
 &lt;/p&gt;
&lt;/form&gt;
</pre>

<p>malheureusement, cela n\'a pas fonctionné : cela n\'affiche à l\'écran que les noeuds textes qui descendent du noeud &lt;option&gt;, et ce aussi bien dans la case de choix que dans le menu déroulant (m2 au lieu de m² pour m&lt;sup&gt;2&lt;/sup&gt;).</p>

<p>J\'ai donc essayé en xhtml avec le même code. Cela n\'a pas fonctionné non plus, cependant dans le menu déroulant, je pouvais voir m². Dans la case du choix, par contre, s\'affichait seulement les noeuds textes fils de &lt;option&gt; : je voyais seulement m à la place de m².</p>

<p>J\'ai alors décidé d\'utiliser xul, voici le code que j\'ai utilisé:</p>
<pre>&lt;box&gt;
 &lt;menulist&gt;
  &lt;menupopup&gt;
   &lt;menuitem label=&quot;m&quot;/&gt;
   &lt;menuitem label=&quot;m&quot;/&gt;
  &lt;/menupopup&gt;
 &lt;/menulist&gt;
&lt;/box&gt;
</pre>

<p>Le problème en xul est que label est un attribut de menuitem (alors que option était un élément en html et xhtml). Il semble donc impossible d\'utiliser &lt;sub&gt;, &lt;sup&gt; ou autres balises mathml à l\'interieur.</p>

<p>Est-ce que quelqu\'un connaitrai une solution qui permettrait l\'insertion d\'exposants dans des menu déroulants, et ce sans avoir à créer une nouvelle structure grace a html/css/javascript ou xul/xbl/css comme j\'envisage actuellement de le faire?</p>

<p>Merci d\'avance</p>',
  ),
  93 => 
  array (
    0 => 'met un style @@overflow:auto;@@ sur la box contenant ton svg',
    1 => '<p>
met un style <code>overflow:auto;</code> sur la box contenant ton svg
</p>',
    2 => '<p>met un style <code>overflow:auto;</code> sur la box contenant ton svg</p>',
  ),
  94 => 
  array (
    0 => 'En effet, j\'avais pas vu au depart que mon logiciel de compression me créer un repertoire supplémentaire dans le .jar. 
Mais ce n\'est pas ici que la saga s\'arrete! Maintenant il compile correctement mais quand je réouvre mozilla il m\'affiche:
 Cet element sera desinstallé lors du prochain démarage de Firefox

Alors que je veux l\'installer "moa"  :(
',
    1 => '<p>
En effet, j\'avais pas vu au depart que mon logiciel de compression me créer un repertoire supplémentaire dans le .jar. 
Mais ce n\'est pas ici que la saga s\'arrete! Maintenant il compile correctement mais quand je réouvre mozilla il m\'affiche:
</p>
<pre>
Cet element sera desinstallé lors du prochain démarage de Firefox
</pre>
<p>
Alors que je veux l\'installer &quot;moa&quot;  :(
</p>',
    2 => '<p>En effet, j\'avais pas vu au depart que mon logiciel de compression me créer un repertoire supplémentaire dans le .jar. 
Mais ce n\'est pas ici que la saga s\'arrete! Maintenant il compile correctement mais quand je réouvre mozilla il m\'affiche:</p>
<pre>Cet element sera desinstallé lors du prochain démarage de Firefox
</pre>

<p>Alors que je veux l\'installer &quot;moa&quot;  :(</p>
',
  ),
  95 => 
  array (
    0 => 'Salut,

Je voudrais signer une de mes applis XUL pour voir, et au moment de lancer cerutil.exe, il me demande libplc4.dll...

Je n\'arrive pas à trouver cette dll sur le net... Quelqu\'un pourrait me l\'envoyer ?

Merci à tous ! ^____^

EDIT : Il faut récuperer les dll dans un autre zip que Netscape fourni. Suivre les indications dans le readme...',
    1 => '<p>
Salut,
</p>
<p>
Je voudrais signer une de mes applis XUL pour voir, et au moment de lancer cerutil.exe, il me demande libplc4.dll...
</p>
<p>
Je n\'arrive pas à trouver cette dll sur le net... Quelqu\'un pourrait me l\'envoyer ?
</p>
<p>
Merci à tous ! ^<strong></strong>^
</p>
<p>
EDIT : Il faut récuperer les dll dans un autre zip que Netscape fourni. Suivre les indications dans le readme...
</p>',
    2 => '<p>Salut,</p>

<p>Je voudrais signer une de mes applis XUL pour voir, et au moment de lancer cerutil.exe, il me demande libplc4.dll...</p>

<p>Je n\'arrive pas à trouver cette dll sur le net... Quelqu\'un pourrait me l\'envoyer ?</p>

<p>Merci à tous ! ^<strong></strong>^</p>

<p>EDIT : Il faut récuperer les dll dans un autre zip que Netscape fourni. Suivre les indications dans le readme...</p>',
  ),
  96 => 
  array (
    0 => 'Bonjour à tous.

Je n\'ai pas trouver grand chose à ce sujet sur le net.

Je voudrais faire un formulaire de login basique (login/pass) pour que l\'utilisateur s\'identifie avant d\'utiliser l\'IU. L\'identification se fera au niveau d\'un serveur PHP qui gèrera ensuite une session.

Si ce [ tutorial | http://www.phppatterns.com/index.php/article/articleview/82/1/2/ ] explique un peu comment faire il ne dit pas comment gérer l\'identification au niveau du XUL.

Je m\'explique:

On ouvre l\'application.
On n\'est pas encore identifier donc on à accès _seulement_ au formulaire de login, toute autre tentative doit nous ramener à ce formulaire.
On s\'identifie correctement.
On à accès à l\'application et on à plus accès au formulaire de login.

C\'est une logique que je ne sais pas mettre en place au niveau XUL, je vois seulement comment faire ca en HTML/PHP.

Je précise que l\'IU XUL est complètement indépendante du PHP (le PHP ne génère pas les écrans XUL).

Si qunlqun à une expérience de ce coté et peu m\'en faire part ca serait bien sympatique, je patoge un peu là...',
    1 => '<p>
Bonjour à tous.
</p>
<p>
Je n\'ai pas trouver grand chose à ce sujet sur le net.
</p>
<p>
Je voudrais faire un formulaire de login basique (login/pass) pour que l\'utilisateur s\'identifie avant d\'utiliser l\'IU. L\'identification se fera au niveau d\'un serveur PHP qui gèrera ensuite une session.
</p>
<p>
Si ce <a href=" http://www.phppatterns.com/index.php/article/articleview/82/1/2/ "> tutorial </a> explique un peu comment faire il ne dit pas comment gérer l\'identification au niveau du XUL.
</p>
<p>
Je m\'explique:
</p>
<p>
On ouvre l\'application.
On n\'est pas encore identifier donc on à accès _seulement_ au formulaire de login, toute autre tentative doit nous ramener à ce formulaire.
On s\'identifie correctement.
On à accès à l\'application et on à plus accès au formulaire de login.
</p>
<p>
C\'est une logique que je ne sais pas mettre en place au niveau XUL, je vois seulement comment faire ca en HTML/PHP.
</p>
<p>
Je précise que l\'IU XUL est complètement indépendante du PHP (le PHP ne génère pas les écrans XUL).
</p>
<p>
Si qunlqun à une expérience de ce coté et peu m\'en faire part ca serait bien sympatique, je patoge un peu là...
</p>',
    2 => '<p>Bonjour à tous.</p>

<p>Je n\'ai pas trouver grand chose à ce sujet sur le net.</p>

<p>Je voudrais faire un formulaire de login basique (login/pass) pour que l\'utilisateur s\'identifie avant d\'utiliser l\'IU. L\'identification se fera au niveau d\'un serveur PHP qui gèrera ensuite une session.</p>

<p>Si ce <a href=" http://www.phppatterns.com/index.php/article/articleview/82/1/2/ "> tutorial </a> explique un peu comment faire il ne dit pas comment gérer l\'identification au niveau du XUL.</p>

<p>Je m\'explique:</p>

<p>On ouvre l\'application.
On n\'est pas encore identifier donc on à accès _seulement_ au formulaire de login, toute autre tentative doit nous ramener à ce formulaire.
On s\'identifie correctement.
On à accès à l\'application et on à plus accès au formulaire de login.</p>

<p>C\'est une logique que je ne sais pas mettre en place au niveau XUL, je vois seulement comment faire ca en HTML/PHP.</p>

<p>Je précise que l\'IU XUL est complètement indépendante du PHP (le PHP ne génère pas les écrans XUL).</p>

<p>Si qunlqun à une expérience de ce coté et peu m\'en faire part ca serait bien sympatique, je patoge un peu là...</p>',
  ),
  97 => 
  array (
    0 => 'Hello,

Il est possible d\'afficher des checkbox dans un tree mais, par une méthode un peu fake: l\'astuce consiste à utiliser les images de checkbox et à les placer dans les cellules. C\'est comme ça que la plupart des applis Mozilla fonctionnent (voir messenger.jar et calendar.jar pour les exemples).
Néanmoins, l\'inconvénient de cette méthode est qu\'il faut tout gérer soit même: le clic sur la checkbox, la mise à jour de l\'image, l\'assignation de la valeur, etc...

Pour plus d\'info, voir le thread sur ce forum:
[http://xulfr.org/forums/read.php?1,343]',
    1 => '<p>
Hello,
</p>
<p>
Il est possible d\'afficher des checkbox dans un tree mais, par une méthode un peu fake: l\'astuce consiste à utiliser les images de checkbox et à les placer dans les cellules. C\'est comme ça que la plupart des applis Mozilla fonctionnent (voir messenger.jar et calendar.jar pour les exemples).
Néanmoins, l\'inconvénient de cette méthode est qu\'il faut tout gérer soit même: le clic sur la checkbox, la mise à jour de l\'image, l\'assignation de la valeur, etc...
</p>
<p>
Pour plus d\'info, voir le thread sur ce forum:
<a href="http://xulfr.org/forums/read.php?1,343">http://xulfr.org/forums/read.php?1,343</a>
</p>',
    2 => '<p>Hello,</p>

<p>Il est possible d\'afficher des checkbox dans un tree mais, par une méthode un peu fake: l\'astuce consiste à utiliser les images de checkbox et à les placer dans les cellules. C\'est comme ça que la plupart des applis Mozilla fonctionnent (voir messenger.jar et calendar.jar pour les exemples).
Néanmoins, l\'inconvénient de cette méthode est qu\'il faut tout gérer soit même: le clic sur la checkbox, la mise à jour de l\'image, l\'assignation de la valeur, etc...</p>

<p>Pour plus d\'info, voir le thread sur ce forum:
<a href="http://xulfr.org/forums/read.php?1,343">http://xulfr.org/forums/read.php?1,343</a></p>',
  ),
  98 => 
  array (
    0 => 'Bonjour,

j\'ai appris après moultes tentatives qu\'on ne pouvait pas créer de cookie s avec Xul. Que ne fut pas ma surprise, que dis je mon étonnement.

En fait je désire enregistrer une variable en local sur le dur de l\'ordinateur pour garder en mémoire sa valeur de session en session et pourquoi pas changer cette valeur.

Savez vous comment je pourrais faire avec le moins de manip possibles ?

merci d\'avance. ',
    1 => '<p>
Bonjour,
</p>
<p>
j\'ai appris après moultes tentatives qu\'on ne pouvait pas créer de cookie s avec Xul. Que ne fut pas ma surprise, que dis je mon étonnement.
</p>
<p>
En fait je désire enregistrer une variable en local sur le dur de l\'ordinateur pour garder en mémoire sa valeur de session en session et pourquoi pas changer cette valeur.
</p>
<p>
Savez vous comment je pourrais faire avec le moins de manip possibles ?
</p>
<p>
merci d\'avance. 
</p>',
    2 => '<p>Bonjour,</p>

<p>j\'ai appris après moultes tentatives qu\'on ne pouvait pas créer de cookie s avec Xul. Que ne fut pas ma surprise, que dis je mon étonnement.</p>

<p>En fait je désire enregistrer une variable en local sur le dur de l\'ordinateur pour garder en mémoire sa valeur de session en session et pourquoi pas changer cette valeur.</p>

<p>Savez vous comment je pourrais faire avec le moins de manip possibles ?</p>

<p>merci d\'avance. </p>',
  ),
  99 => 
  array (
    0 => 'bonjour,
J\'essaie d\'afficher un tree dont les ressources sont de type RDF mais cela prend trop de temps à charger (à cause des miliers de lignes à afficher en + il y a des treechildren :( )

J\'ai essayé d\'ajouter:
flags="dont-build-content"
à mon tree mais cela n\'a pas changé grand chose

je pense que la solution se trouverait comme dans:
http://www.xulplanet.com/tutorials/xultu/treeview.html

mais je ne comprend pas comment :
 <script>
 var treeView = {
    rowCount : 10000,
    getCellText : function(row,column){
      if (column=="namecol") return "Row "+row;
      else return "February 18";
    },
    setTree: function(treebox){ this.treebox=treebox; },
    isContainer: function(row){ return false; },
    isSeparator: function(row){ return false; },
    isSorted: function(row){ return false; },
    getLevel: function(row){ return 0; },
    getImageSrc: function(row,col){ return null; },
    getRowProperties: function(row,props){},
    getCellProperties: function(row,col,props){},
    getColumnProperties: function(colid,col,props){}
 };

 function setView()
 {
    document.getElementById(\'my-tree\').view=treeView;
 }
 </script>

 <tree id="my-tree" flex="1">
  <treecols>
    <treecol id="namecol" label="Name" flex="1"/>
    <treecol id="datecol" label="Date" flex="1"/>
  </treecols>
  <treechildren/>
 </tree>

marche!
et j\'ai besoin de treechildren!!!

Autre chose: est-ce que: "conditions,triple predicate" offre des avantages pour un affichage rapide???



voici donc (la partie de) mon code:
 <groupbox orient="horizontal" style="width: 90em; height: 300px;">
      <caption label="WBS Union - Interco"/>

	<tree id="IntercoTree" flags="dont-build-content" style="width: 59em; height: 200px;" multiple="true" onclick="showIntercoDetailValues2(this);"
      datasources="WBS.rdf" ref="http://127.0.0.1:8080/reporting/WBSSS" enableColumnDrag="true">
     <treecols>
       <treecol id="cpltNameI" primary="true" label="COMPLETE NAME" sort="rdf:http://127.0.0.1:8080/reporting/rdf#CPLTNAME" flex="2"/>
       <splitter class="tree-splitter"/>
       <treecol id="typeWBSI" hidden="true" label="RANK" sort="rdf:http://127.0.0.1:8080/reporting/rdf#TYPE" flex="1"/>
       <splitter class="tree-splitter"/>
       <treecol id="DATOI" hidden="true" label="START DATE" sort="rdf:http://127.0.0.1:8080/reporting/rdf#DATO" flex="1"/>
       <splitter class="tree-splitter"/>
       <treecol id="DATCI" hidden="true" label="COMPLETION DATE" sort="rdf:http://127.0.0.1:8080/reporting/rdf#DATC" flex="1"/>
       <splitter class="tree-splitter"/>
       <treecol id="NBOFCHILDRENI" hidden="true" label="NB OF CHILDREN" sort="rdf:http://127.0.0.1:8080/reporting/rdf#NBOFCHILDREN" flex="1"/>
       <splitter class="tree-splitter"/>
       <treecol id="CODEI" hidden="true" label="CODE" sort="rdf:http://127.0.0.1:8080/reporting/rdf#CODE" flex="1"/>
       <splitter class="tree-splitter"/>
       <treecol id="LIBELI" hidden="false" label="LIBEL" sortActive="true" sort="rdf:http://127.0.0.1:8080/reporting/rdf#NAME" flex="1"/>
       <splitter class="tree-splitter"/>
       <treecol id="WBSIntercoKindI" hidden="true" label="KIND" sort="rdf:http://127.0.0.1:8080/reporting/rdf#KIND" flex="1"/>
       <splitter class="tree-splitter"/>
 
     </treecols>
 
     <template>
       <treechildren>
         <treeitem uri="rdf:*" open = "false">
           <treerow>
             <treecell label="rdf:http://127.0.0.1:8080/reporting/rdf#CPLTNAME"/>
             <treecell label="rdf:http://127.0.0.1:8080/reporting/rdf#TYPE"/>
             <treecell label="rdf:http://127.0.0.1:8080/reporting/rdf#DATO"/>
             <treecell label="rdf:http://127.0.0.1:8080/reporting/rdf#DATC"/>
             <treecell label="rdf:http://127.0.0.1:8080/reporting/rdf#NBOFCHILDREN"/>
             <treecell label="rdf:http://127.0.0.1:8080/reporting/rdf#CODE"/>
             <treecell label="rdf:http://127.0.0.1:8080/reporting/rdf#NAME"/>
             <treecell label="rdf:http://127.0.0.1:8080/reporting/rdf#KIND"/>
           </treerow>
	     </treeitem>
	   </treechildren>
     </template>
    </tree>

Ca serait cool si quelqun pouvait m\'aider
Merci!!!
Cyril
',
    1 => '<p>
bonjour,
J\'essaie d\'afficher un tree dont les ressources sont de type RDF mais cela prend trop de temps à charger (à cause des miliers de lignes à afficher en + il y a des treechildren :( )
</p>
<p>
J\'ai essayé d\'ajouter:
flags=&quot;dont-build-content&quot;
à mon tree mais cela n\'a pas changé grand chose
</p>
<p>
je pense que la solution se trouverait comme dans:
http://www.xulplanet.com/tutorials/xultu/treeview.html
</p>
<p>
mais je ne comprend pas comment :
</p>
<pre>
&lt;script&gt;
var treeView = {
   rowCount : 10000,
   getCellText : function(row,column){
     if (column==&quot;namecol&quot;) return &quot;Row &quot;+row;
     else return &quot;February 18&quot;;
   },
   setTree: function(treebox){ this.treebox=treebox; },
   isContainer: function(row){ return false; },
   isSeparator: function(row){ return false; },
   isSorted: function(row){ return false; },
   getLevel: function(row){ return 0; },
   getImageSrc: function(row,col){ return null; },
   getRowProperties: function(row,props){},
   getCellProperties: function(row,col,props){},
   getColumnProperties: function(colid,col,props){}
};
</pre>
<pre>
function setView()
{
   document.getElementById(\'my-tree\').view=treeView;
}
&lt;/script&gt;
</pre>
<pre>
&lt;tree id=&quot;my-tree&quot; flex=&quot;1&quot;&gt;
 &lt;treecols&gt;
   &lt;treecol id=&quot;namecol&quot; label=&quot;Name&quot; flex=&quot;1&quot;/&gt;
   &lt;treecol id=&quot;datecol&quot; label=&quot;Date&quot; flex=&quot;1&quot;/&gt;
 &lt;/treecols&gt;
 &lt;treechildren/&gt;
&lt;/tree&gt;
</pre>
<p>
marche!
et j\'ai besoin de treechildren!!!
</p>
<p>
Autre chose: est-ce que: &quot;conditions,triple predicate&quot; offre des avantages pour un affichage rapide???
</p>
<p>
voici donc (la partie de) mon code:
</p>
<pre>
&lt;groupbox orient=&quot;horizontal&quot; style=&quot;width: 90em; height: 300px;&quot;&gt;
     &lt;caption label=&quot;WBS Union - Interco&quot;/&gt;
</pre>
<pre>
&lt;tree id=&quot;IntercoTree&quot; flags=&quot;dont-build-content&quot; style=&quot;width: 59em; height: 200px;&quot; multiple=&quot;true&quot; onclick=&quot;showIntercoDetailValues2(this);&quot;
     datasources=&quot;WBS.rdf&quot; ref=&quot;http://127.0.0.1:8080/reporting/WBSSS&quot; enableColumnDrag=&quot;true&quot;&gt;
    &lt;treecols&gt;
      &lt;treecol id=&quot;cpltNameI&quot; primary=&quot;true&quot; label=&quot;COMPLETE NAME&quot; sort=&quot;rdf:http://127.0.0.1:8080/reporting/rdf#CPLTNAME&quot; flex=&quot;2&quot;/&gt;
      &lt;splitter class=&quot;tree-splitter&quot;/&gt;
      &lt;treecol id=&quot;typeWBSI&quot; hidden=&quot;true&quot; label=&quot;RANK&quot; sort=&quot;rdf:http://127.0.0.1:8080/reporting/rdf#TYPE&quot; flex=&quot;1&quot;/&gt;
      &lt;splitter class=&quot;tree-splitter&quot;/&gt;
      &lt;treecol id=&quot;DATOI&quot; hidden=&quot;true&quot; label=&quot;START DATE&quot; sort=&quot;rdf:http://127.0.0.1:8080/reporting/rdf#DATO&quot; flex=&quot;1&quot;/&gt;
      &lt;splitter class=&quot;tree-splitter&quot;/&gt;
      &lt;treecol id=&quot;DATCI&quot; hidden=&quot;true&quot; label=&quot;COMPLETION DATE&quot; sort=&quot;rdf:http://127.0.0.1:8080/reporting/rdf#DATC&quot; flex=&quot;1&quot;/&gt;
      &lt;splitter class=&quot;tree-splitter&quot;/&gt;
      &lt;treecol id=&quot;NBOFCHILDRENI&quot; hidden=&quot;true&quot; label=&quot;NB OF CHILDREN&quot; sort=&quot;rdf:http://127.0.0.1:8080/reporting/rdf#NBOFCHILDREN&quot; flex=&quot;1&quot;/&gt;
      &lt;splitter class=&quot;tree-splitter&quot;/&gt;
      &lt;treecol id=&quot;CODEI&quot; hidden=&quot;true&quot; label=&quot;CODE&quot; sort=&quot;rdf:http://127.0.0.1:8080/reporting/rdf#CODE&quot; flex=&quot;1&quot;/&gt;
      &lt;splitter class=&quot;tree-splitter&quot;/&gt;
      &lt;treecol id=&quot;LIBELI&quot; hidden=&quot;false&quot; label=&quot;LIBEL&quot; sortActive=&quot;true&quot; sort=&quot;rdf:http://127.0.0.1:8080/reporting/rdf#NAME&quot; flex=&quot;1&quot;/&gt;
      &lt;splitter class=&quot;tree-splitter&quot;/&gt;
      &lt;treecol id=&quot;WBSIntercoKindI&quot; hidden=&quot;true&quot; label=&quot;KIND&quot; sort=&quot;rdf:http://127.0.0.1:8080/reporting/rdf#KIND&quot; flex=&quot;1&quot;/&gt;
      &lt;splitter class=&quot;tree-splitter&quot;/&gt;

    &lt;/treecols&gt;

    &lt;template&gt;
      &lt;treechildren&gt;
        &lt;treeitem uri=&quot;rdf:*&quot; open = &quot;false&quot;&gt;
          &lt;treerow&gt;
            &lt;treecell label=&quot;rdf:http://127.0.0.1:8080/reporting/rdf#CPLTNAME&quot;/&gt;
            &lt;treecell label=&quot;rdf:http://127.0.0.1:8080/reporting/rdf#TYPE&quot;/&gt;
            &lt;treecell label=&quot;rdf:http://127.0.0.1:8080/reporting/rdf#DATO&quot;/&gt;
            &lt;treecell label=&quot;rdf:http://127.0.0.1:8080/reporting/rdf#DATC&quot;/&gt;
            &lt;treecell label=&quot;rdf:http://127.0.0.1:8080/reporting/rdf#NBOFCHILDREN&quot;/&gt;
            &lt;treecell label=&quot;rdf:http://127.0.0.1:8080/reporting/rdf#CODE&quot;/&gt;
            &lt;treecell label=&quot;rdf:http://127.0.0.1:8080/reporting/rdf#NAME&quot;/&gt;
            &lt;treecell label=&quot;rdf:http://127.0.0.1:8080/reporting/rdf#KIND&quot;/&gt;
          &lt;/treerow&gt;
     &lt;/treeitem&gt;
   &lt;/treechildren&gt;
    &lt;/template&gt;
   &lt;/tree&gt;
</pre>
<p>
Ca serait cool si quelqun pouvait m\'aider
Merci!!!
Cyril
</p>',
    2 => '<p>bonjour,
J\'essaie d\'afficher un tree dont les ressources sont de type RDF mais cela prend trop de temps à charger (à cause des miliers de lignes à afficher en + il y a des treechildren :( )</p>

<p>J\'ai essayé d\'ajouter:
flags=&quot;dont-build-content&quot;
à mon tree mais cela n\'a pas changé grand chose</p>

<p>je pense que la solution se trouverait comme dans:
http://www.xulplanet.com/tutorials/xultu/treeview.html</p>

<p>mais je ne comprend pas comment :</p>
<pre>&lt;script&gt;
var treeView = {
   rowCount : 10000,
   getCellText : function(row,column){
     if (column==&quot;namecol&quot;) return &quot;Row &quot;+row;
     else return &quot;February 18&quot;;
   },
   setTree: function(treebox){ this.treebox=treebox; },
   isContainer: function(row){ return false; },
   isSeparator: function(row){ return false; },
   isSorted: function(row){ return false; },
   getLevel: function(row){ return 0; },
   getImageSrc: function(row,col){ return null; },
   getRowProperties: function(row,props){},
   getCellProperties: function(row,col,props){},
   getColumnProperties: function(colid,col,props){}
};
</pre>

<pre>function setView()
{
   document.getElementById(\'my-tree\').view=treeView;
}
&lt;/script&gt;
</pre>

<pre>&lt;tree id=&quot;my-tree&quot; flex=&quot;1&quot;&gt;
 &lt;treecols&gt;
   &lt;treecol id=&quot;namecol&quot; label=&quot;Name&quot; flex=&quot;1&quot;/&gt;
   &lt;treecol id=&quot;datecol&quot; label=&quot;Date&quot; flex=&quot;1&quot;/&gt;
 &lt;/treecols&gt;
 &lt;treechildren/&gt;
&lt;/tree&gt;
</pre>

<p>marche!
et j\'ai besoin de treechildren!!!</p>

<p>Autre chose: est-ce que: &quot;conditions,triple predicate&quot; offre des avantages pour un affichage rapide???</p>



<p>voici donc (la partie de) mon code:</p>
<pre>&lt;groupbox orient=&quot;horizontal&quot; style=&quot;width: 90em; height: 300px;&quot;&gt;
     &lt;caption label=&quot;WBS Union - Interco&quot;/&gt;
</pre>

<pre>&lt;tree id=&quot;IntercoTree&quot; flags=&quot;dont-build-content&quot; style=&quot;width: 59em; height: 200px;&quot; multiple=&quot;true&quot; onclick=&quot;showIntercoDetailValues2(this);&quot;
     datasources=&quot;WBS.rdf&quot; ref=&quot;http://127.0.0.1:8080/reporting/WBSSS&quot; enableColumnDrag=&quot;true&quot;&gt;
    &lt;treecols&gt;
      &lt;treecol id=&quot;cpltNameI&quot; primary=&quot;true&quot; label=&quot;COMPLETE NAME&quot; sort=&quot;rdf:http://127.0.0.1:8080/reporting/rdf#CPLTNAME&quot; flex=&quot;2&quot;/&gt;
      &lt;splitter class=&quot;tree-splitter&quot;/&gt;
      &lt;treecol id=&quot;typeWBSI&quot; hidden=&quot;true&quot; label=&quot;RANK&quot; sort=&quot;rdf:http://127.0.0.1:8080/reporting/rdf#TYPE&quot; flex=&quot;1&quot;/&gt;
      &lt;splitter class=&quot;tree-splitter&quot;/&gt;
      &lt;treecol id=&quot;DATOI&quot; hidden=&quot;true&quot; label=&quot;START DATE&quot; sort=&quot;rdf:http://127.0.0.1:8080/reporting/rdf#DATO&quot; flex=&quot;1&quot;/&gt;
      &lt;splitter class=&quot;tree-splitter&quot;/&gt;
      &lt;treecol id=&quot;DATCI&quot; hidden=&quot;true&quot; label=&quot;COMPLETION DATE&quot; sort=&quot;rdf:http://127.0.0.1:8080/reporting/rdf#DATC&quot; flex=&quot;1&quot;/&gt;
      &lt;splitter class=&quot;tree-splitter&quot;/&gt;
      &lt;treecol id=&quot;NBOFCHILDRENI&quot; hidden=&quot;true&quot; label=&quot;NB OF CHILDREN&quot; sort=&quot;rdf:http://127.0.0.1:8080/reporting/rdf#NBOFCHILDREN&quot; flex=&quot;1&quot;/&gt;
      &lt;splitter class=&quot;tree-splitter&quot;/&gt;
      &lt;treecol id=&quot;CODEI&quot; hidden=&quot;true&quot; label=&quot;CODE&quot; sort=&quot;rdf:http://127.0.0.1:8080/reporting/rdf#CODE&quot; flex=&quot;1&quot;/&gt;
      &lt;splitter class=&quot;tree-splitter&quot;/&gt;
      &lt;treecol id=&quot;LIBELI&quot; hidden=&quot;false&quot; label=&quot;LIBEL&quot; sortActive=&quot;true&quot; sort=&quot;rdf:http://127.0.0.1:8080/reporting/rdf#NAME&quot; flex=&quot;1&quot;/&gt;
      &lt;splitter class=&quot;tree-splitter&quot;/&gt;
      &lt;treecol id=&quot;WBSIntercoKindI&quot; hidden=&quot;true&quot; label=&quot;KIND&quot; sort=&quot;rdf:http://127.0.0.1:8080/reporting/rdf#KIND&quot; flex=&quot;1&quot;/&gt;
      &lt;splitter class=&quot;tree-splitter&quot;/&gt;

    &lt;/treecols&gt;

    &lt;template&gt;
      &lt;treechildren&gt;
        &lt;treeitem uri=&quot;rdf:*&quot; open = &quot;false&quot;&gt;
          &lt;treerow&gt;
            &lt;treecell label=&quot;rdf:http://127.0.0.1:8080/reporting/rdf#CPLTNAME&quot;/&gt;
            &lt;treecell label=&quot;rdf:http://127.0.0.1:8080/reporting/rdf#TYPE&quot;/&gt;
            &lt;treecell label=&quot;rdf:http://127.0.0.1:8080/reporting/rdf#DATO&quot;/&gt;
            &lt;treecell label=&quot;rdf:http://127.0.0.1:8080/reporting/rdf#DATC&quot;/&gt;
            &lt;treecell label=&quot;rdf:http://127.0.0.1:8080/reporting/rdf#NBOFCHILDREN&quot;/&gt;
            &lt;treecell label=&quot;rdf:http://127.0.0.1:8080/reporting/rdf#CODE&quot;/&gt;
            &lt;treecell label=&quot;rdf:http://127.0.0.1:8080/reporting/rdf#NAME&quot;/&gt;
            &lt;treecell label=&quot;rdf:http://127.0.0.1:8080/reporting/rdf#KIND&quot;/&gt;
          &lt;/treerow&gt;
     &lt;/treeitem&gt;
   &lt;/treechildren&gt;
    &lt;/template&gt;
   &lt;/tree&gt;
</pre>

<p>Ca serait cool si quelqun pouvait m\'aider
Merci!!!
Cyril</p>
',
  ),
);
