WikiRenderer is a library to generate HTML (or anything else) from wiki content.

Warning: the master branch is currently unstable since we rework many things.
Got to the 3.x branch to have a stable release. Documentation is not updated yet also.


WikiRenderer 4.0-beta supports these following markup:

- Dokuwiki to HTML
- Dokuwiki to Docbook
- WR3 (a markup specific to WikiRenderer 3.0) to HTML
- WR3 to Text
- WR3 to Docbook

In the stable release (3.x branch), it also supports:

- Phpwiki to HTML
- Trac to HTML

Migration of these markup to Wr 4.0 is planned of course


Install
-------

You can install it from Composer. See [the page on Packagist.org](https://packagist.org/packages/jelix/wikirenderer)


Quick example
-------------

```php

// take a markup support, here the Dokuwiki markup for HTML
$conf = new \WikiRenderer\Markup\DokuHtml\Config();

// Instance of WikiRenderer
$wr = new \WikiRenderer\Renderer($conf);

// parse and generate the HTML
$html = $wr->render($awikitext);
```


Documentation and website
-------------------------

English and french documentation is on http://wikirenderer.jelix.org

The documentation is not up-to-date and talk about an old version of WikiRenderer.
Help is welcome to update documentation and the website ;-)

