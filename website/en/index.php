<?php
require(dirname(__FILE__).'/header.inc.php');

?>

<h2>What is WikiRenderer?</h2>

<p>WikiRenderer is a php component which can parse a wiki content, and transform
it to XHTML content, to any other markup language, or to an other wiki content
with a different syntax. So this is useful to transform and display
wiki content into your CMS, your wiki, your forum, or for example
to migrate wiki contents from an old wiki CMS to a new one.</p>

<p>See <a href="/en/demo.php">the demonstration</a>.</p>
<p>WikiRenderer is released under <a href="http://www.gnu.org/licenses/licenses.html#LGPL">the LGPL licence</a>.</p>

<h2>Latest version</h2>
<dl>
<dt>Stable</dt>
<dd><strong>3.1.5</strong>, only for php5 (07/14/2012)</dd>
</dl>
<p>See the <a href="http://download.jelix.org/wikirenderer/">download page</a>,
and <a href="/en/history.php#v3.1.5">the changes</a>.</p>

<h2 id="caracteristiques">Features</h2>

<p>Contrary to some other wiki generators, WikiRenderer produces always valid content, even if
there are some invalid wiki syntaxes in the source content.</p>

<p>Wikirenderer is highly configurable, although you would need to develop some php
classes for unsupported wiki syntax. To do transformation, WikiRenderer call a
set of classes which implement the content generation from a specific wiki "tag".
A set of classes is called a "rule".
</p>

<ul>
    <li>Wikirenderer provides this rules:
      <ul>
       <li>wr3 syntax to XHTML (wr3 is a syntax specific to wikirenderer)</li>
       <li>wr3 syntax to text </li>
       <li>wr3 syntax to Docbook</li>
       <li>dokuwiki syntax to XHTML</li>
       <li>dokuwiki syntax to Docbook</li>
       <li>jwiki syntax to XHTML</li>
       <li>phpwiki syntax to dokuwiki syntax</li>
       <li>trac syntax to XHTML</li>
       <li>and others...</li>
      </ul>
    </li>
    <li>You can develop your own rules, by creating them from scratch or by extending existing rules.</li>
    <li>Rules can be configured through a config class. You can specify for example callbacks
      functions to support additionnal processing on the content, before or after the transformation
    </li>
    <li>The engine of WikiRenderer supports complex syntaxes like:
      <ul>
       <li>Foot notes</li>
       <li>CamelCase links</li>
       <li>Escaped wiki "tag" to ignore them</li>
       <li>tables, definitions etc.</li>
      </ul>
    </li>
    <li>WikiRenderer can report syntaxes error in the source content</li>
</ul>

<h2 id="references">Users of WikiRenderer</h2>
<p>If you use WikiRenderer in your project or in your CMS, tell me and I will add your website
on this page. If you developed rules and you want to include it in the official package of WikiRenderer,
send me files of your rule.</p>

<p>WikiRenderer is used by&nbsp;:</p>
<ul>
   <li><a href="http://jelix.org" title="framework php5">jelix.org</a> and
   <a href="http://xulfr.org" title="portail français sur les technologies mozilla et XUL">xulfr.org</a>
    use the <a href="http://www.phorum.org">phorum</a> mod for wikirenderer in their forums.
   </li>
   <li>Provided in <strong><a href="http://www.jelix.org">Jelix</a></strong>, a php5 framework</li>

   <li>Used in <strong><a href="http://pxsystem.sourceforge.net/">Plume CMS</a></strong></li>
   <li>Used in <strong><a href="http://chuwiki.berlios.de/">chuWiki</a></strong></li>

   <li>Used on <a href="http://www.nosica.net/">www.nosica.net</a></li>
   <li>Used on some CMS of french governemental websites
   <a href="http://premar-atlantique.gouv.fr/mentionslegales/">premar-atlantique.gouv.fr</a>
   and <a href="http://premar-mediterranee.gouv.fr/mentionslegales/">premar-mediterranee.gouv.fr</a>.</li>

   <li>Used on <a href="http://web.utk.edu/~ihouse/">Campus de l'université du Tenessis</a></li>
   <li>Used on <a href="http://www.piregwan.com">www.piregwan.com</a></li>
   <li>Used in the Beryo CMS (used on <a href="http://www.xrousse.org/">www.xrousse.org</a>)</li>
   <li>Used on <a href="http://www.rocknrollswing.com">www.rocknrollswing.com</a></li>
   <li>Used in a little CMS which is used on 
   <a href="http://www.recyclagesolidaire.org">www.recyclagesolidaire.org</a>,
   <a href="http://www.salonhumanitaire.org"> www.salonhumanitaire.org</a>,
   <a href="http://www.createliers.com">www.createliers.com</a>,
   <a href="http://www.collectif-asah.org">www.collectif-asah.org</a>.</li>
   <li>Used on <a href="http://www.unesco.org/culture/ich/">www.unesco.org/culture/ich/</a></li>
</ul>

<h2 id="contact">Contact</h2>
<p>WikiRenderer is developed by Laurent Jouanneau : ljouanneau at gmail dot com.
(site : <a href="http://ljouanneau.com">ljouanneau.com</a>).</p>

<?php
require(dirname(__FILE__).'/footer.inc.php');
?>