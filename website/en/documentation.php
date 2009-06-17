<?php
$path_link=array('documentation'=>'documentation.php');
require('header.inc.php');
?>

<h2>Using Wikirenderer 3.1</h2>
<p style="font-style:italic">last update: 06/20/2009</p>

<h3>Simple use</h3>

<pre><code> include('WikiRenderer.lib.php');
 $wkr = new WikiRenderer();
 $myXHTMLText = $wkr->render($myWikiText);
</code></pre>

<p>By default, it uses the rule "wr3_to_xhtml". This is why the output is in XHTML.
If you want to use an other rule, for example "dokuwiki_to_xhtml":</p>

<pre><code> include('WikiRenderer.lib.php');
  include('rules/dokuwiki_to_xhtml.php');

  $wkr = new WikiRenderer('dokuwiki_to_xhtml');
  $myXHTMLText = $wkr->render($myWikiText);
</code></pre>

<p>If you want to change the configuration of the rule, you have to change some
properties on its configuration class. Example:</p>

<pre><code> include('WikiRenderer.lib.php');
  include('rules/classicwr_to_xhtml.php');
  $config = new classicwr_to_xhtml();

  $config->simpletags = array('%%%'=>'<br />',
        ':-)'=>'&lt;img src="laugh.png" alt=":-)" /&gt;',
        ':-('=>'&lt;img src="sad.png" alt=":-(" /&gt;'
        );

  $wkr = new WikiRenderer($config);
  $myXHTMLText = $wkr->render($myWikiText);
</code></pre>


<h3>To know wiki errors</h3>
<p>It is possible to know if there are some syntax errors in the given wiki content.
After the transformation, just check the <code>errors</code> property of
WikiRenderer, as shown on this example: </p>

<pre><code>include('WikiRenderer.lib.php');
$wkr = new WikiRenderer();
$myXHTMLText = $wkr->render($myWikiText);

if($wkr->errors){
   echo '&lt;p style="color:red;">There are some syntax errors at lines: ';
   echo implode(',',array_keys($wkr->errors)),'&lt;/p>' ;
}
</code></pre>

<p>The property <code>errors</code> is an array in which keys are line numbers
where an error has been found, and values are the lines themselves.</p>
<p>WikiRenderer don't stop on errors. Bad wiki tags are ignored and appeared
in the resulting content.</p>

<h3>Configuration</h3>
<p>Each rule have its own configuration object which inherits from
 the class <code>WikiRendererConfig</code>. It have at least this properties:</p>

<dl>

<dt><code>inlinetags</code></dt>
<dd>list of class names of the rule which support "inline" tags (tags used in sentence,
a paragraph etc). See
<a href="documentation_dev.php">development of rules</a>. You can modify this list
if you don't support some wiki tag.
</dd>

<dt><code>bloctags</code></dt>
<dd>list of class names of the rule which support "block" tags (tags
which introduce a specific block of content, like a list, a table etc..)
See <a href="documentation_dev.php">development of rules</a>. You can modify this list
if you don't support some wiki tag.</dd>

<dt><code>simpletags</code></dt>
<dd>simple tags which should be replace by a specific string. This is
a php array of  <code>'string to replace'=>'new string'</code>.</dd>
<dt><code>checkWikiWordFunction</code></dt>
<dd>Should be the name of the function called when WikiRenderer find some
"CamelCase" words. This function receive an array of CamelCase work, and
should return corresponding strings which will replace the CamelCase words.
There is no default function for this, since this is specific to your
website. Keep it to <code>null</code> if you don't want to support
CamelCase detection.</dd>
</dl>

<h2>Other documentations</h2>

<ul>
    <li><a href="documentation_rules.php">Syntax of some rules</a> provided by WikiRenderer.</li>
    <li><a href="documentation_dev.php">Developing rules</a>.</li>
</ul>


<?php

require('footer.inc.php');
?>








