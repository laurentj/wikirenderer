<?php
$path_link=array('History'=>'history.php');
require('header.inc.php');
?>

<h2>History of Wikirenderer.</h2>
<p>WikiRenderer is released under the 
<a href="http://www.gnu.org/licenses/licenses.html#LGPL">LGPL licence</a>.</p>

<dl>
    <dt id="v3.1.6">Version 3.1.6, 02/02/2015</dt>
    <dd>
        <ul>
            <li>Compatibility with PHP 5.4+: added a "charset" parameter in the configuration object, to be used with htmlspecialchars.</li>
        </ul>
    </dd>
    <dt>New hosting 12/28/2012</dt>
   <dd>
    The project is hosted on https://github.com/laurentj/wikirenderer
   </dd>

    <dt id="v3.1.5">Version 3.1.5, 07/14/2012</dt>
    <dd>
        <ul>
            <li>improvements into the dokuwiki_to_docbook rules</li>
        </ul>
    </dd>

    <dt id="v3.1.4">Version 3.1.4, 04/20/2012</dt>
    <dd>
        <ul>
            <li>Improved WikiRendererConfig::processLink. It returns now the url and the label</li>
        </ul>
    </dd>
   
    <dt id="v3.1.3">Version 3.1.3, 04/09/2012</dt>
    <dd>
        <ul>
            <li>WikiRendererConfig contains now a processLink method so it is easier to reuse an existing rules with a different link process without redefining classes</li>
            <li>fixed wr to wr3 convertion</li>
            <li>wr3 rules: tags should be ignored inside the code tag, so we don't have to escape every reserved characters</li>
        </ul>
    </dd>

    <dt>New hosting, 10/30/2011</dt>
   <dd>
        <ul>
            <li>The web site has been moved to http://wikirenderer.jelix.org</li>
            <li>The project is hosted on https://bitbucket.org/laurentj/wikirenderer</li>
        </ul>
   </dd>

    <dt id="v3.1.2">Version 3.1.2, 12/27/2009</dt>
    <dd>
        <ul>
            <li>fixed bugs in the dokuwiki_to_xhtml rule</li>
        </ul>
    </dd>
    <dt id="v3.1.1">Version 3.1.1, 09/08/2009</dt>
    <dd>
        <ul>
            <li>better compatibility with PHP 5.3</li>
            <li>fixed a notice on an undefined variable</li>
            <li>fixed a bug: WR3 rule didn't generate good markup when
            <code>&lt;/code&gt;</code> was on the same line of <code>&lt;code&gt;</code></li>
        </ul>
    </dd>
</dl>

<p>For the following versions, no changelog since it was only used by some
frenchies, so it is useless for the futur users of the world :-) (I didn't publish the web site
in english until the 3.1 version). However, you can see old history
by retrieving the changelog from the subversion repository of WikiRenderer.</p>
<dl>
   <dt>Version 3.1, 06/19/2009</dt>
   <dt>Version 3.0, 02/03/2007</dt>
   <dt>Version 3.0 RC1, 10/10/2006</dt>
   <dt>Version 3.0 beta, 09/28/2006</dt>
   <dt>Version 2.0.6, 09/26/2004.</dt>
   <dt>Version 2.0.5, 05/16/2004.</dt>
   <dt>Version 2.0.4, 01/28/2004</dt>
   <dt>Version 2.0.3, 01/22/2004.</dt>
   <dt>Version 2.0.2, 01/21/2004.</dt>
   <dt>Version 2.0.1, 01/19/2004.</dt>
   <dt>Version 2.0.0,  01/18/2004.</dt>
   <dt>Version 2.0RC2, 01/07/2004.</dt>
   <dt>Version 2.0RC1,   12/23/2003.</dt>
   <dt>Version 1.0 , 04/15/2003.</dt>
</dl>

<?php

require('footer.inc.php');
?>








