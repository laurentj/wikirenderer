<?php
/**
 * trac syntax to xhtml
 *
 * @package WikiRenderer
 * @subpackage rules
 * @author Laurent Jouanneau
 * @copyright 2006-2008 Laurent Jouanneau
 * @link http://wikirenderer.berlios.de
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public 2.1
 * License as published by the Free Software Foundation.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 *
 */

class trac_to_xhtml  extends WikiRendererConfig  {

    public $inlinetags= array( 'tracxhtml_strongem', 'tracxhtml_strong','tracxhtml_emphasis','tracxhtml_underlined',
        'tracxhtml_monospaced', 'tracxhtml_monospaced2',
        'tracxhtml_subscript', 'tracxhtml_superscript', 'tracxhtml_macro', 'tracxhtml_link',
        /*'tracxhtml_footnote', 'tracxhtml_image',
        'tracxhtml_nowiki_inline',*/);

    public $defaultTextLineContainer = 'WikiHtmlTextLine';

    public $availabledTextLineContainers = array('WikiHtmlTextLine', 'tracxhtml_table_row');

    /**
    * liste des balises de type bloc reconnus par WikiRenderer.
    */
    public $bloctags = array('tracxhtml_title', 'tracxhtml_list', 'tracxhtml_blockquote','tracxhtml_table', 'tracxhtml_pre',
         'tracxhtml_syntaxhighlight', 'tracxhtml_file', 'tracxhtml_nowiki', 'tracxhtml_html', 'tracxhtml_php', 'tracxhtml_para',
         'tracxhtml_macro'
    );


   public $simpletags = array("\\\\"=>"");

   public $escapeChar = '';

   public $sectionLevel= array();

   public $footnotes = array();
   public $footnotesId='';
   public $footnotesTemplate = '<div class="footnotes"><h4>Notes</h4>%s</div>';

    public $startHeaderNumber = 1; // top level header will be <h1> if you set to 1, <h2> if it is 2 etc..

    /**
    * called before the parsing
    */
    public function onStart($texte){
        $this->sectionLevel = array();
        $this->footnotesId = rand(0,30000);
        $this->footnotes = array();
        return $texte;
    }

   /**
    * called after the parsing
    */
    public function onParse($finalTexte){
        $finalTexte.= str_repeat('</div>', count($this->sectionLevel));
        if(count($this->footnotes)){
            $footnotes = implode("\n",$this->footnotes);
            $finalTexte .= str_replace('%s', $footnotes, $this->footnotesTemplate);
        }
        return $finalTexte;
    }
}



// ===================================== inline tags

class tracxhtml_strongem extends WikiTagXhtml {
    protected $name='strong';
    public $beginTag="'''";
    public $endTag="'''";
    protected $additionnalAttributes=array();
    public function getContent(){ 
         return '<strong><em>'.$this->contents[0].'</em></strong>';
    }
}

class tracxhtml_strong extends WikiTagXhtml {
    protected $name='strong';
    public $beginTag="'''";
    public $endTag="'''";
    protected $additionnalAttributes=array();
}

class tracxhtml_emphasis extends WikiTagXhtml {
    protected $name='em';
    public $beginTag="''";
    public $endTag="''";
}

class tracxhtml_underlined extends WikiTagXhtml {
    protected $name='u';
    public $beginTag='__';
    public $endTag='__';
}

class tracxhtml_monospaced extends WikiTagXhtml {
    protected $name='code';
    public $beginTag='{{{';
    public $endTag='}}}';
}

class tracxhtml_monospaced2 extends WikiTagXhtml {
    protected $name='code';
    public $beginTag='`';
    public $endTag='`';
}

class tracxhtml_subscript extends WikiTagXhtml {
    protected $name='sub';
    public $beginTag=',,';
    public $endTag=',,';
}

class tracxhtml_superscript extends WikiTagXhtml {
    protected $name='sup';
    public $beginTag='^';
    public $endTag='^';
}

class tracxhtml_macro extends WikiTagXhtml {
    protected $name='sup';
    public $beginTag='[[';
    public $endTag=']]';
    public function getContent(){
        if (strtoupper ($this->contents[0]) == 'BR')
            return '<br />';
        else
            return '';
    }
}


/*
class tracxhtml_del extends WikiTagXhtml {
    protected $name='del';
    public $beginTag='<del>';
    public $endTag='</del>';
    public function getContent(){ return '';}
}
*/
/*
class tracxhtml_link extends WikiTagXhtml {
    protected $name='a';
    public $beginTag='[';
    public $endTag=']';
    protected $attribute=array('href','$$');
    public $separators=array('|');

    public function getContent(){
        $cntattr=count($this->attribute);
        $cnt=($this->separatorCount + 1 > $cntattr?$cntattr:$this->separatorCount+1);
        if($cnt == 1 ){
            $contents = $this->wikiContentArr[0];
            $href=$contents;
            if(strpos($href,'javascript:')!==false) // for security reason
                $href='#';
            if(strlen($contents) > 40)
                $contents=substr($contents,0,40).'(..)';
            return '<a href="'.htmlspecialchars(trim($href)).'">'.htmlspecialchars($contents).'</a>';
        }else{
            if(strpos($this->wikiContentArr[0],'javascript:')!==false) // for security reason
                $this->wikiContentArr[0]='#';
            return parent::getContent();
        }
    }
}

class tracxhtml_footnote extends WikiTagXhtml {
    protected $name='footnote';
    public $beginTag='((';
    public $endTag='))';

    public function getContent(){
        $number = count($this->config->footnotes) + 1;
        $id = 'footnote-'.$this->config->footnotesId.'-'.$number;
        $this->config->footnotes[] = "<p>[<a href=\"#rev-$id\" name=\"$id\" id=\"$id\">$number</a>] ".$this->contents[0].'</p>';

        return "<span class=\"footnote-ref\">[<a href=\"#$id\" name=\"rev-$id\" id=\"rev-$id\">$number</a>]</span>";
   }
}


class tracxhtml_nowiki_inline extends WikiTagXhtml {
    protected $name='nowiki';
    public $beginTag='<nowiki>';
    public $endTag='</nowiki>';
    public function getContent(){
        return '<div>'.htmlspecialchars($this->wikiContentArr[0]).'</div>';
    }
}


class tracxhtml_image extends WikiTagXhtml {
    protected $name='image';
    public $beginTag='{{';
    public $endTag='}}';
    protected $attribute=array('fileref','title');
    public $separators=array('|');

    public function getContent(){
        $contents = $this->wikiContentArr;

        if(count($contents) == 1) {
            $href = $contents[0];
            $title = '';
        } else {
            $href = $contents[0];
            $title = $contents[1];
        }

        $align='';
        $width='';
        $height='';

        $m= array('','','','','','','','');
        if (preg_match("/^(\s*)([^\s\?]+)(\?(\d+)(x(\d+))?)?(\s*)$/", $href, $m)) {
            if($m[1] != '' && $m[7] != ''){
                $align='center';
            } elseif($m[1] != ''){
                $align='right';
            } elseif($m[7] != ''){
                $align='left';
            }
            if($m[3]) {
                $width=$height=$m[4];
                if($m[5])
                   $height=$m[6];
            }
            $href= $m[2];
        }

        $tag = '<img src="'.$href.'"';
        if($width != '')
            $tag.=' width="'.$width.'"';
        if($height != '')
            $tag.=' height="'.$height.'"';
        if($align != '')
            $tag.=' align="'.$align.'"';

        if($title != '') 
            $tag.=' title="'.htmlspecialchars($title).'"';

        return $tag.' />';
    }
}
*/


// ===================================== blocs

/**
 * traite les signes de types liste
 */
class tracxhtml_list extends WikiRendererBloc {

    public $type='list';
    protected $_stack=array();
    protected $_firstTagLen;
    protected $regexp="/^(\s*)(\*|1\.)(.*)/";
    protected $_firstItem = true;

    public function open(){
        $this->_stack[] = array(strlen($this->_detectMatch[1]) ,  $this->_detectMatch[2]);
        $this->_firstTagLen = strlen($this->_detectMatch[1]);
        $this->_firstItem = true;
        if($this->_detectMatch[2] == '*')
            return "<ul>\n";
        else
            return "<ol>\n";
   }

   public function close(){
        $str='';

        for($i=count($this->_stack)-1; $i >=0; $i--){
            if($this->_stack[$i][0] < $this->_firstTagLen) break;

            $str.=($this->_stack[$i][1]== '*'?"</li></ul>\n":"</li></ol>\n");
            array_pop($this->_stack);
        }
        return $str;
   }

    public function getRenderedLine(){
        $t=end($this->_stack);
        $newLen = strlen($this->_detectMatch[1]);
        $d=$t[0] - $newLen;
        $str='';

        if( $d < 0 ){ // un niveau de plus
            $this->_stack[] = array($newLen ,  $this->_detectMatch[2]);
            $str=($this->_detectMatch[2] == '*'?"<ul><li>":"<ol><li>");

        } else {
            if( $d > 0 ){ // on remonte d'un ou plusieurs cran dans la hierarchie...
                for($i=count($this->_stack)-1; $i >=0; $i--){
                    if($this->_stack[$i][0] <= $newLen){
                        break;
                    } else {
                        $str.=($this->_stack[$i][1]== '*'?"</li></ul>\n":"</li></ol>\n");
                    }
                    array_pop($this->_stack);
                }
                if(count($this->_stack) == 0) {
                    $this->_firstTagLen = $newLen;
                    $this->_firstItem = true;
                    $t = array($newLen,   $this->_detectMatch[2]);
                    $this->_stack[] = $t;
                    if($t[1] == '*')
                        $str .= "<ul>\n";
                    else
                        $str .= "<ol>\n";
                } else {
                    $t=end($this->_stack);
                }

            }

            if($t[1] != $this->_detectMatch[2]) {
                if(!$this->_firstItem)
                    $str .='</li>';

                if($t[1] == '*')
                    $str .= "<ul>\n<li>";
                else
                    $str .= "<ol>\n<li>";
                array_pop($this->_stack);
                $this->_stack[] = array($newLen ,  $this->_detectMatch[2]);
            } else {
                if($this->_firstItem)
                    $str.="<li>";
                else
                    $str.="</li>\n<li>";
            }

        }
        $this->_firstItem = false;
        return $str.$this->_renderInlineTag(trim($this->_detectMatch[3]));
    }
}


/**
 * traite les signes de types titre
 */
class tracxhtml_title extends WikiRendererBloc {
    public $type='title';
    protected $regexp="/^\s*(\={1,6})([^=]*)(\={1,6})\s*$/";
    protected $_closeNow=true;

    public function getRenderedLine(){
        $level = strlen($this->_detectMatch[1]);

        $conf = $this->engine->getConfig();

        $output='';
        if(count($conf->sectionLevel)) {
            $last = end($conf->sectionLevel);
            if($last > $level) {
                while($last = end($conf->sectionLevel) && $last >= $level) {
                    $output.= '</div>';
                    array_pop($conf->sectionLevel);
                }
            }else if($last < $level) {

            }else{
                array_pop($conf->sectionLevel);
                $output.= '</div>';
            }
        }

        $conf->sectionLevel[] = $level;
        $h = $conf->startHeaderNumber -1 + $level;
        if($h > 5) $h = 5;
        elseif($h < 1) $h = 1;
        return $output.'<div><h'.$h.'>'.$this->_renderInlineTag(trim($this->_detectMatch[2])).'</h'.$h.'>';
    }
}

/**
 * traite les signes de type paragraphe
 */
class tracxhtml_para extends WikiRendererBloc {
    public $type='para';
    protected $_openTag='<p>';
    protected $_closeTag='</p>';

    public function detect($string){
        if($string=='') return false;
        if(preg_match("/^\s?([^\*\1\=\|\^\{\>;<=~].*)/",$string, $m)) {
            $this->_detectMatch=array($m[1],$m[1]);
            return true;
        }
        return false;
    }
}



/**
 * traite les signes de type blockquote
 *//*
class tracxhtml_blockquote extends WikiRendererBloc {
   public $type='blockquote';
   protected $regexp="/^\s*(\>+)(.*)/";

   public function open(){
      $this->_previousTag = $this->_detectMatch[1];
      $this->_firstTagLen = strlen($this->_previousTag);
      $this->_firstLine = true;
      return str_repeat('<blockquote>',$this->_firstTagLen).'<p>';
   }

   public function close(){
      return '</p>'.str_repeat('</blockquote>',strlen($this->_previousTag));
   }

   public function getRenderedLine(){

      $d=strlen($this->_previousTag) - strlen($this->_detectMatch[1]);
      $str='';

      if( $d > 0 ){ // on remonte d'un cran dans la hierarchie...
         $str='</p>'.str_repeat('</blockquote>',$d).'<p>';
         $this->_previousTag=$this->_detectMatch[1];
      }elseif( $d < 0 ){ // un niveau de plus
         $this->_previousTag=$this->_detectMatch[1];
         $str='</p>'.str_repeat('<blockquote>',-$d).'<p>';
      }else{
         if($this->_firstLine)
            $this->_firstLine=false;
      }
      return $str.$this->_renderInlineTag($this->_detectMatch[2]);
   }
}
   */
/**
 *
 */
/*
class tracxhtml_table_row extends WikiTag {
    public $isTextLineTag=true;
    protected $attribute=array('$$');
    protected $checkWikiWordIn=array('$$');

    public $separators=array('|','^');

    protected $columns = array('');

    protected function _doEscape($string){
        return htmlspecialchars($string);
    }

    
    // called by the inline parser, when it found a separator
    public function addSeparator($token){
        $this->wikiContent.= $this->wikiContentArr[$this->separatorCount];
        $this->separatorCount++;
        $this->currentSeparator = $token;
        $this->wikiContent.= $token;
        $this->contents[$this->separatorCount]='';
        $this->wikiContentArr[$this->separatorCount]='';
        $this->columns[$this->separatorCount]=$token;
    }

    public function isCurrentSeparator($token){
        return ($token == '|' || $token == '^');
    }

    public function isOtherTagAllowed() {
        return true;
    }

    public function getBogusContent(){
        $c=$this->beginTag;
        $m= count($this->contents)-1;
        $s= count($this->separators);
        foreach($this->contents as $k=>$v){
            $c.=$this->columns[$k].$v;
        }
        return $c;
    }

    public function getContent(){
        $c = "<tr>\n";
        $col ='';
        $colnum =0;
        $colspan = 0;

        $last = count($this->contents) -1;
        foreach( $this->contents as $k=>$content) {

            if($k == 0) continue; // we ignore first content (which is before the first separator
            if($k == $last)  break; // we ignore the last content (which is after the last separator

            if($content == '') {
                if($col == '' && $k > 0) { // if bad syntax on first col
                     $c.='<td></td>';
                } else 
                    $colspan++;
            } else {
                if($col !='')
                    $c.= $this->addCol($colnum, $col, $colspan);
                $colnum = $k;
                $col = $content;
            }
        }
        $c.= $this->addCol($colnum, $col, $colspan);
        return $c."\n</tr>\n";
    }

    protected function addCol($num, $content, $colspan) {
        if($this->columns[$num] == '^')
            $t = 'th';
        else
            $t = 'td';

        $align='';
        $l = 0;
        $r = 0;
        if (preg_match("/^(\s+)/", $content, $m)) {
            $l = strlen($m[1]);
        }
        if (preg_match("/(\s+)$/", $content, $m)) {
            $r = strlen($m[1]);
        }
        if(trim($content) == '') {
            $l=$r=0;
        }

        if($l==0 && $r > 2) {
            $align=' align="left"';
        }else if($r==0 && $l > 2) {
            $align=' align="right"';
        }else if($l > 2 && $l==$r) {
            $align=' align="center"';
        }

        if($colspan) {
            return '<'.$t.' colspan="'.($colspan+1).'"'.$align.'>'.$content.'</'.$t.'>';
        } else {
            return '<'.$t.$align.'>'.$content.'</'.$t.'>';
        }
    }

}
*/
/**
 * traite les signes de types table
 */
/*
class tracxhtml_table extends WikiRendererBloc {
    public $type='table';
    protected $regexp="/^\s*(\||\^)(.*)/";
    protected $_openTag='<table>';
    protected $_closeTag='</table>';

    protected $_colcount=0;

    public function open(){
        $this->engine->getConfig()->defaultTextLineContainer = 'tracxhtml_table_row';
        return $this->_openTag;
    }

    public function close(){
        $this->engine->getConfig()->defaultTextLineContainer = 'WikiHtmlTextLine';
        return $this->_closeTag;
    }

    public function getRenderedLine(){
        return $this->engine->inlineParser->parse($this->_detectMatch[1].$this->_detectMatch[2]);
    }

}
*/
/*
class tracxhtml_syntaxhighlight extends WikiRendererBloc {

    public $type='syntaxhighlight';
    protected $_openTag='<pre><code>';
    protected $_closeTag='</code></pre>';
    protected $isOpen = false;
    protected $dktag='code';

   public function open(){
      $this->isOpen = true;
      return $this->_openTag;
   }

   public function close(){
      $this->isOpen=false;
      return $this->_closeTag;
   }

    public function getRenderedLine(){
        return htmlspecialchars($this->_detectMatch);
    }

    public function detect($string){
        if($this->isOpen){
            if(preg_match('/(.*)<\/'.$this->dktag.'>\s*$/',$string,$m)){
                $this->_detectMatch=$m[1];
                $this->isOpen=false;
            }else{
                $this->_detectMatch=$string;
            }
            return true;

        }else{
            if(preg_match('/^\s*<'.$this->dktag.'( \w+)?>(.*)/',$string,$m)){
                $this->_detectMatch=$m[1];
                return true;
            }else{
                return false;
            }
        }
    }
}*/

/*
class tracxhtml_file extends tracxhtml_syntaxhighlight {
    public $type='filesyntaxhighlight';
    protected $_openTag='<pre class="file-content">';
    protected $_closeTag='</pre>';
    protected $dktag='file';
}*/

/*
class tracxhtml_nowiki extends tracxhtml_syntaxhighlight {
    public $type='nowikisyntaxhighlight';
    protected $_openTag='<pre>';
    protected $_closeTag='</pre>';
    protected $dktag='nowiki';
}*/

/*
class tracxhtml_pre extends WikiRendererBloc {
    public $type='pre';
    protected $_openTag='<pre>';
    protected $_closeTag='</pre>';

    public function detect($string){
        if($string=='') return false;
        if(preg_match("/^(\s{2,}[^\*\-\=\|\^>;<=~].*)/",$string)) {
            $this->_detectMatch=array($string,$string);
            return true;
        }
        return false;
    }
}*/

/*
class tracxhtml_html extends WikiRendererBloc {

    public $type='html';
    protected $isOpen = false;
    protected $dktag='html';

    public function open(){
        $this->isOpen = true;
        return '';
    }

   public function close(){
      $this->isOpen=false;
      return '';
   }

    public function getRenderedLine(){
        return '';
    }

    public function detect($string){
        if($this->isOpen){
            if(preg_match('/(.*)<\/'.$this->dktag.'>\s*$/',$string,$m)){
                $this->isOpen=false;
            }
            return true;
        }else{
            if(preg_match('/^\s*<'.$this->dktag.'>(.*)/',$string,$m)){
                return true;
            }else{
                return false;
            }
        }
    }
}
*/
/*
class tracxhtml_php extends tracxhtml_html {
    protected $dktag='php';
}
*/

/*
class tracxhtml_macro extends WikiRendererBloc {
    public $type='macro';
    protected $regexp="/^\s*~~[^~]*~~\s*$/";
    protected $_closeNow=true;

    public function getRenderedLine(){
        return '';
    }
}
*/


/**
 * definition list
 */
class tracxhtml_definition extends WikiRendererBloc {

   public $type='dfn';
   protected $regexp="/^\s*([^:]*)::/i";
   protected $_openTag='<dl>';
   protected $_closeTag='</dl>';

   public function getRenderedLine(){
      $dt=$this->_renderInlineTag($this->_detectMatch[1]);
      //$dd=$this->_renderInlineTag($this->_detectMatch[2]);
      return "<dt>$dt</dt>\n<dd>$dd</dd>\n";
   }
}

