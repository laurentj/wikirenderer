WikiRenderer 4 is a library to convert wiki content to an other format like
HTML, Docbook, or other wiki syntax.

Warning: the master branch is currently unstable since we rework many things.
Go to the 3.x branch to have a stable release. Documentation and the website
are not updated yet for WikiRenderer 4.

WikiRenderer 4.0-pre supports these following markups:

- Dokuwiki syntax
- Trac syntax
- WR3 (a markup specific to WikiRenderer 3.0)
- ClassicWR (a markup specific to WikiRenderer 1.0)

And it can generates HTML.

In the final release, support of Markdown markup, Docbook generator, Markdown generator
and text generator are planed.

Install
-------

You can install it from Composer. See [the page on Packagist.org](https://packagist.org/packages/jelix/wikirenderer)


Quick example
-------------

```php
// first choose a Markup, by instancying its configuration object
// here we want to parse DokuWiki syntax
$markupConfig = new \WikiRenderer\Markup\DokuWiki\Config();

// then choose a generator, e.g., the object which generates
// the result text in the expected format. Here, HTML...
$genConfig = new \WikiRenderer\Generator\Html\Config();
$generator = new \WikiRenderer\Generator\Html\Document($genConfig);

// now instancy the WikiRenderer engine
$wr = new \WikiRenderer\RendererNG($generator, $markupConfig);

// call render() method: it will parse DokuWiki syntax, and will
// generate HTML content
$html = $wr->render($awikitext);
```

Note: this is a new API and it may change until the release of 4.0.

Documentation and website
-------------------------

English and french documentation is on http://wikirenderer.jelix.org.

The documentation is not up-to-date and talk about WikiRenderer 3 which is
not compatible with WikiRenderer 4.
Help is welcome to update documentation and the website ;-)

