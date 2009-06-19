<?php
$path_link=array('documentation'=>'documentation.php', 'development of rules'=>'documentation_dev.php');
require('header.inc.php');
?>

<h2>Creating rules</h2>

<h3>Principles</h3>

<p>You want to create a new rule, to convert from a specific wiki syntax
to another syntax markup. In summary, here what you should do:</p>

<ol>
    <li>Create a file, with a new configuration object, inheriting from
    <code>WikiRendererConfig</code> (or from one of an existing rule).</li>
    <li>Create some new object which will convert a wiki tag to
    the corresponding target markup. This objects can inherit
    from those of an existing rule.</li>
    <li>Register this objects into the configuration object</li>
    <li>Then you can use WikiRenderer with your new rule.</li>
</ol>

<p>Don't hesitate to open a rule file, to see how it is organized.</p>

<h3>Different type of tags</h3>

<p>In a wiki syntax, or in other markup language such HTML, we have two
type of tag:</p>
<ol>
    <li>Those to identify a type of block of content. Types of block of content can be
    a list, a table, a paragraph, a title. We can say that it corresponds to
    HTML elements which have a style like <code>display:block;</code>. We will
    call them, "block tags".</li>
    
    <li>Those to format  words or to insert specific behaviors inside sentences.
    This is for example to specify emphasis, links, code, etc. We will call it
    "inline tags".</li>
</ol>

<p>To summary, inline tags are used inside sentences, and block tags are use outside
sentence, to specify the type of the content.</p>

<p>To implement a converter, we will inherit from a different class, depending
of the type of tag: <code>WikiTag</code> for inline tags, and <code>WikiRendererBloc</code>
for block tags.</p>

<p>There are also objects call "line handlers". This objects are responsible
to process text content which are outside inline tags in a line of text.</p>


<h3>Creating inline tags</h3>

<p>A <code>WikiTag</code> object represents a specific wiki tag. An inline tag
has a markup to indicate the begin of the tag, an other markup for the end of the tag.
Some of wiki tag contain often different parts, separated by a specific character.
For example, for a link, the writer can indicate an URL and a title:</p>

<pre>[[http://foo.bar|my link]]</pre>

<p>We have here the delimiters of the tag : <code>[[</code> and <code>]]</code>.
And we have a separator, <code>|</code>. So we have two parts, we call them "attributes".
The first attribute is the URL, the second is the title of the link.</p>

<h4>A class for an inline tag</h4>

<p>To create a handler for your wiki tag, you should create a class which inherits
from <code>WikiTag</code>, and set some properties with the delimiters of your
tag, attributes list, and the separator. For our link tag:</p>

<pre><code>
class my_link extends WikiTag {

    // the left delimiter of our tag
    public $beginTag='[[';

    // the right delimiter of our tag
    public $endTag=']]';

    // the name of attributes
    protected $attribute=array('href', '$$');

    // the separator
    public $separators=array('|');

}
</code></pre>

<h4>Attributes and separators</h4>

<p>In the <code>$attribute</code> property, you have to indicate the name you give
for each attribute allowed in your wiki tag. You can give any name. However, there is
one name which have a special meaning: <code>"$$"</code>. This name
indicates to the parser that the content of the attribute can contain other wiki
tags.</p>

<p>In the <code>$separators</code> property, you give the list of separators. In
most of time, you use only one type of separator to separate attributes. But some time
it is not the case, so you will indicate all different separators, in the same
order of attributes. For example, you have 4 attributes on your wiki tag, and the
separator between the third and the fourth is different (<code>%</code> for
example) than the others (<code>|</code> for example), you will indicate:</p>

<pre><code>
    public $separators=array('|','|','%');
</code></pre>

<p>If this is the first which is different, you don't have to list all
the next separators:</p>

<pre><code>
    public $separators=array('%','|');
    // is equivalent to 
    public $separators=array('%','|', '|');
</code></pre>

<h4>Generating the content</h4>

<p>Our previous class is not finished. We still have to indicate
how the corresponding content for the target markup should be generated.
For that, we have to redefine the <code>getContent()</code> method. We
assume that we want to generate XHTML:</p>

<pre><code>
    public function getContent(){

        if($this->separatorCount == 0){
            // only the URL is given
            $href = $this->wikiContentArr[0];
            $title = htmlspecialchars($href);
        }else{
            $href = $this->wikiContentArr[0];
            $title = $this->contents[1];
        }
        
        return '&lt;a href="'.htmlspecialchars($href).'">'.$title.'&lt;/a>';
    }
</code></pre>

<ul>
    <li><code>$separatorCount</code> contains the number of separators
    that the parser has found. So if it is equals to 0, there is only
    one attribute given in the text, if it is equal to 1, there are two
    attributes etc.</li>
    <li><code>$wikiContentArr</code> : contains the value of each
    attributes, as it is wrote in the text.</li>
    <li><code>$contents</code> : contains the value of each
    attributes, <strong>after</strong> the original values have been
    converted to the target markup. In fact, values of <code>$wikiContentArr</code>
    and of <code>$contents</code> are differents, only for attributes named '$$'.
    </li>
</ul>

<p>For example, if in our wiki syntax, <code>**bla**</code> means an emphasis,
and we write <code>[[http://foo.bar|my **super** link]]</code>,
the value of <code>$this->wikiContentArr[1]</code> will be
<code>my **super** link</code>, and the value of  <code>$this->contents[1]</code>
will be <code>my &lt;strong&gt;super&lt;/strong&gt; link</code>.</p>
    
<p>Note that in the case of a link for example, you will have to check
the URL, to avoid javascript code for example, or you may have to generate a different
URL if the syntax of the URL has a special meaning. This is often the
case in a wiki CMS. For example in Dokuwiki, we can indicate "URL" like "foo:bar",
and then the URL in the generated content should be
"http://mysite.local/wiki/index.php?page=foo/bar"
or something like that.</p>

<h4>Generating XHTML and XML content</h4>

<p>To generate XHTML markup or any other XML markup, there is
a child class of <code>WikiTag</code>, named <code>WikiTagXhtml</code>,
which have a generic <code>getContent()</code> method to generate XML markup.</p>

<p>So in most of case, you don't have to create a <code>getContent()</code>.
Just inherits from <code>WikiTagXhtml</code>, indicate the name of the
X(HT)ML element in the <code>$name</code> property. And in the <code>$attribute</code>
property, indicate names which will be names of the X(HT)ML attributes on the
element ('$$' indicate that the wiki attribute will be the content of the element).</p>

<p>For example, to implement a generator for the <code>&lt;strong&gt;</code>
markup, this class is enough:</p>
<pre><code>

class wr3xhtml_strong extends WikiTagXhtml {
    protected $name='strong';
    public $beginTag='**';
    public $endTag='**';
}
</code></pre>

<p>For a wiki tag with attributes, here an example to generate the
<code>&lt;acronym&gt;</code> XHTML element:</p>

<pre><code>

class wr3xhtml_acronym extends WikiTagXhtml {
    protected $name='acronym';
    public $beginTag='??';
    public $endTag='??';
    protected $attribute=array('$$','title');
    public $separators=array('|');
}
</code></pre>

<p>With this handler, we can write in the wiki content
<code>a standard: ??CSS|Cascading Style Sheets??</code>, and this will be converted
to <code>a standard: &lt;acronym title="Cascading Style Sheets"&gt;CSS&lt;/acronym&gt;</code>.</p>

<h4>Generating complex content</h4>

<p>There are other possibilities on <code>WikiTag</code>, and other methods
you can redefine. It is too long to explain all of them. If features explained
above are not enough to implement your wiki tag, see the implementation
of wiki tags in the existing rules. You will discover that almost everything is possible :-)</p>

<h4>Declaring the inline tag handler</h4>

<p>Once you create the class, you have to declare it in the configuration. Just add its name
into the inline tags list of one ore more line handler. See below.</p>


<h3>Creating a line handler</h3>

<p>A line handler is a class which handle the text on a line, which is outside wiki inline tags.
There is a default line handler (which does nothing), <code>WikiTextLine</code>. There is an other,
<code>WikiHtmlTextLine</code>, which escapes the content with <code>htmlspecialhars</code>.
And in some rules, you have some specific line handlers to parse complex line of text,
like a wiki line which defines a table row, because on such lines, all contents are separated
by a specific caracters, to define values in each columns.
</p>

<p>A line handler is in fact a class which inherits from <code>WikiTag</code>,
with the property <code>public $isTextLineTag=true;</code>.</p>

<p>See examples in some rules, for table row.</p>


<p>To declare a line handler, you have two properties on the configuration class:</p>

<dl>
    <dt><code>$defaultTextLineContainer</code></dt>
    <dd>contain the class name of the default line handler, or more precisely, the
    current line handler used during the parsing.</dd>
    <dt><code>$textLineContainers</code></dt>
    <dd>is an array which declare all possible line handlers for the wiki syntax.
    It also defines, for each of them, the allowed inline tags inside lines. This
    definition is an array of class name of inline tags.</dd>
</dl>

<p>Note that you must declare at least one line handler in the configuration. Example</p>

<pre><code>
    public $defaultTextLineContainer = 'WikiHtmlTextLine';

    public $textLineContainers = array(
            'WikiHtmlTextLine'=>array( 'dkxhtml_strong','dkxhtml_emphasis','dkxhtml_underlined','dkxhtml_monospaced',
        'dkxhtml_subscript', 'dkxhtml_superscript', 'dkxhtml_del', 'dkxhtml_link', 'dkxhtml_footnote', 'dkxhtml_image',
        'dkxhtml_nowiki_inline',),
        
            'dkxhtml_table_row'=>array( 'dkxhtml_strong','dkxhtml_emphasis','dkxhtml_underlined','dkxhtml_monospaced',
        'dkxhtml_subscript', 'dkxhtml_superscript', 'dkxhtml_del', 'dkxhtml_link', 'dkxhtml_footnote', 'dkxhtml_image',
        'dkxhtml_nowiki_inline',)
    );
</code></pre>



<h3>Creating block tags</h3>

<p>Tag for blocks in a wiki syntax is a tag which starts at the begining of the line,
and which defines the type of the block of text. For some tags, you should repeat it
at the begining of each lines of the block, and sometimes, you have only to write a
delimiter at the start and at the end of the block of lines.</p>

<p>To create a block tag handler, create a class which inherits from
<code>WikiRendererBloc</code>. It should have a property, <code>$type</code>
which contains a type identifer. Each blocks should have a unique name.</p>

<p>Then you have to specify how the parser will detect the begin
    and the end of the block.</p>


<h4>Recognizing the block</h4>

<p>You have two ways.
<ul>
    <li>If the syntax of the block is to write specific characters
    at the begining of each lines of the block, then you just have to
    set the <code>$regexp</code> property with a regular expression
    which will be applied on each lines given by the parser.
    Note that if the regular expression captures some part
    of the string, this parts are stored in the <code>$_detectMatch</code>
    properties. So you can use it in some redefined methods,
    in particularly <code>getRenderedLine()</code>.</li>
    
    <li>If the syntax is more complex, for example a delimiter
    at the begining and the end of the block, or else, you have
    to redefine the <code>detect($line)</code> method. It should
    return true if the line belongs to the block.</li>
</ul>

<p>If the block is always only on one line, set the <code>$_closeNow</code>
property to <code>true</code>.</p>

<h4>Generating content</h4>

<p>During the parsing, some methods on your class are called:</p>

<dl>
    <dt><code>open()</code></dt>
    <dd>When the parser detect (with the help of the <code>detect()</code>
    method) that the block starts, this method is called. You can
    redefine it to do some additionnal process. It can return a string
    which will be added to the generated content. By default, it returns
    the value of the property <code>$_openTag</code> (you can set it
    if you don't want to redefine the method).</dd>

    <dt><code>close()</code></dt>
    <dd>When the parser detect (with the help of the <code>detect()</code>
    method) that the block ends, this method is called. You can
    redefine it to do some additionnal process at this step.
    It can return a string which will be added to the generated content.
    By default, it returns
    the value of the property <code>$_closeTag</code> (you can set it
    if you don't want to redefine the method).</dd>

    <dt><code>closeNow()</code></dt>
    <dd>Returns a boolean indicating if the block should be close
    immediately after the opening (so in the case of a block
    which is defined only on one line). By default,
    it returns the value of <code>$_closeNow</code> property.</dd>

    <dt><code>getRenderedLine()</code></dt>
    <dd>This method is responsible to generate the content of
    the current parsed line. It should return the resulting
    string. If the content of the line can have some
    inline wiki tags, you should call <code>$this->engine->inlineParser->parse($string);</code>,
    where <code>$string</code> is the part of the line (or the entire, it depends
    of your syntax), which should be parsed.</dd>
</dl>

<h4>Declaring the class</h4>

<p>Just add its name into the list of the <code>$bloctags</code> property of the
configuration class.</p>

<p>To know more about how to create such of classes, don't hesitate to
read the source of the existing rules.</p>

<ul>
    <li><a href="documentation_rules.php">Syntax of some rules</a> provided by WikiRenderer.</li>
    <li><a href="documentation.php">Documentation</a>.</li>
</ul>

<?php

require('footer.inc.php');
?>








