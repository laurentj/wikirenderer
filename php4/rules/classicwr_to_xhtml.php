<?php
/**
 * classic wikirenderer syntax to xhtml
 *
 * @package WikiRenderer
 * @subpackage classicwr_to_xhtml
 * @author Laurent Jouanneau <jouanneau@netcourrier.com>
 * @copyright 2003-2006 Laurent Jouanneau
 * @version 3.0alpha
 * http://wikirenderer.berlios.de
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
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

class ConfigClassicwrToXhtml {
  /**
    * @var array   liste des tags inline
   */
   var $inlinetags= array( 'cwrxhtml_strong','cwrxhtml_em','cwrxhtml_code','cwrxhtml_q',
    'cwrxhtml_cite','cwrxhtml_acronym','cwrxhtml_link', 'cwrxhtml_image', 'cwrxhtml_anchor');

   var $textLineContainer = 'WikiHtmlTextLine';

   /**
   * liste des balises de type bloc reconnus par WikiRenderer.
   */
   var $bloctags = array('cwrxhtml_title', 'cwrxhtml_list', 'cwrxhtml_pre','cwrxhtml_hr',
                         'cwrxhtml_blockquote','cwrxhtml_definition','cwrxhtml_table', 'cwrxhtml_p');


   var $simpletags = array('%%%'=>'<br />', ':-)'=>'<img src="laugh.png" alt=":-)" />');

   var $checkWikiWordFunction = null;

}

// ===================================== déclarations des tags inlines

class cwrxhtml_strong extends WikiTagXhtml {
    var $name='strong';
    var $beginTag='__';
    var $endTag='__';
}

class cwrxhtml_em extends WikiTagXhtml {
    var $name='em';
    var $beginTag='\'\'';
    var $endTag='\'\'';
}

class cwrxhtml_code extends WikiTagXhtml {
    var $name='code';
    var $beginTag='@@';
    var $endTag='@@';
}

class cwrxhtml_q extends WikiTagXhtml {
    var $name='q';
    var $beginTag='^^';
    var $endTag='^^';
    var $attribute=array('$$','lang','cite');
    var $separators=array('|');
}

class cwrxhtml_cite extends WikiTagXhtml {
    var $name='cite';
    var $beginTag='{{';
    var $endTag='}}';
    var $attribute=array('$$','title');
    var $separators=array('|');
}

class cwrxhtml_acronym extends WikiTagXhtml {
    var $name='acronym';
    var $beginTag='??';
    var $endTag='??';
    var $attribute=array('$$','title');
    var $separators=array('|');
}

class cwrxhtml_anchor extends WikiTagXhtml {
    var $name='anchor';
    var $beginTag='~~';
    var $endTag='~~';
    var $attribute=array('name');
    var $separators=array('|');
    function getContent(){
        return '<a name="'.htmlspecialchars($this->wikiContentArr[0]).'"></a>';
    }
}


class cwrxhtml_link extends WikiTagXhtml {
    var $name='a';
    var $beginTag='[';
    var $endTag=']';
    var $attribute=array('$$','href','hreflang','title');
    var $separators=array('|');
    function getContent(){
        $cntattr=count($this->attribute);
        $cnt=($this->separatorCount + 1 > $cntattr?$cntattr:$this->separatorCount+1);
        if($cnt == 1 ){
            $contents = $this->wikiContentArr[0];
            $href=$contents;
            if(strpos($href,'javascript:')!==false) // for security reason
                $href='#';
            if(strlen($contents) > 40)
                $contents=substr($contents,0,40).'(..)';
            return '<a href="'.htmlspecialchars($href).'">'.htmlspecialchars($contents).'</a>';
        }else{
            if(strpos($this->wikiContentArr[1],'javascript:')!==false) // for security reason
                $this->wikiContentArr[1]='#';
            return parent::getContent();
        }
    }
}



class cwrxhtml_image extends WikiTagXhtml {
    var $name='image';
    var $beginTag='((';
    var $endTag='))';
    var $attribute=array('src','alt','align','longdesc');
    var $separators=array('|');

    function getContent(){
        $contents = $this->wikiContentArr;
        $cnt=count($contents);
        $attribut='';
        if($cnt > 4) $cnt=4;
        switch($cnt){
            case 4:
                $attribut.=' longdesc="'.$contents[3].'"';
            case 3:
                if($contents[2]=='l' ||$contents[2]=='L' || $contents[2]=='g' || $contents[2]=='G')
                    $attribut.=' style="float:left;"';
                elseif($contents[2]=='r' ||$contents[2]=='R' || $contents[2]=='d' ||$contents[2]=='D')
                    $attribut.=' style="float:right;"';
            case 2:
                $attribut.=' alt="'.$contents[1].'"';
            case 1:
            default:
                $attribut.=' src="'.$contents[0].'"';
                if($cnt == 1) $attribut.=' alt=""';
        }
        return '<img'.$attribut.'/>';
    }
}



// ===================================== déclaration des différents bloc wiki

/**
 * traite les signes de types liste
 */
class cwrxhtml_list extends WikiRendererBloc {

   var $_previousTag;
   var $_firstItem;
   var $_firstTagLen;
   var $type='list';
   var $regexp="/^([\*#-]+)(.*)/";

   function open(){
      $this->_previousTag = $this->_detectMatch[1];
      $this->_firstTagLen = strlen($this->_previousTag);
      $this->_firstItem=true;

      if(substr($this->_previousTag,-1,1) == '#')
         return "<ol>\n";
      else
         return "<ul>\n";
   }
   function close(){
      $t=$this->_previousTag;
      $str='';

      for($i=strlen($t); $i >= $this->_firstTagLen; $i--){
          $str.=($t{$i-1}== '#'?"</li></ol>\n":"</li></ul>\n");
      }
      return $str;
   }

   function getRenderedLine(){
      $t=$this->_previousTag;
      $d=strlen($t) - strlen($this->_detectMatch[1]);
      $str='';

      if( $d > 0 ){ // on remonte d'un ou plusieurs cran dans la hierarchie...
         $l=strlen($this->_detectMatch[1]);
         for($i=strlen($t); $i>$l; $i--){
            $str.=($t{$i-1}== '#'?"</li></ol>\n":"</li></ul>\n");
         }
         $str.="</li>\n<li>";
         $this->_previousTag=substr($this->_previousTag,0,-$d); // pour être sur...

      }elseif( $d < 0 ){ // un niveau de plus
         $c=substr($this->_detectMatch[1],-1,1);
         $this->_previousTag.=$c;
         $str=($c == '#'?"<ol><li>":"<ul><li>");

      }else{
         $str=($this->_firstItem ? '<li>':"</li>\n<li>");
      }
      $this->_firstItem=false;
      return $str.$this->_renderInlineTag($this->_detectMatch[2]);

   }


}


/**
 * traite les signes de types table
 */
class cwrxhtml_table extends WikiRendererBloc {
   var $type='table';
   var $regexp="/^\| ?(.*)/";
   var $_openTag='<table border="1">';
   var $_closeTag='</table>';

   var $_colcount=0;

   function open(){
      $this->_colcount=0;
      return $this->_openTag;
   }


   function getRenderedLine(){

      $result=explode(' | ',trim($this->_detectMatch[1]));
      $str='';
      $t='';

      if((count($result) != $this->_colcount) && ($this->_colcount!=0))
         $t='</table><table border="1">';
      $this->_colcount=count($result);

      for($i=0; $i < $this->_colcount; $i++){
         $str.='<td>'. $this->_renderInlineTag($result[$i]).'</td>';
      }
      $str=$t.'<tr>'.$str.'</tr>';

      return $str;
   }

}

/**
 * traite les signes de types hr
 */
class cwrxhtml_hr extends WikiRendererBloc {

   var $type='hr';
   var $regexp='/^={4,} *$/';
   var $_closeNow=true;

   function getRenderedLine(){
      return '<hr />';
   }

}

/**
 * traite les signes de types titre
 */
class cwrxhtml_title extends WikiRendererBloc {
   var $type='title';
   var $regexp="/^(\!{1,3})(.*)/";
   var $_closeNow=true;

   var $_minlevel=3;
   /**
    * indique le sens dans lequel il faut interpreter le nombre de signe de titre
    * true -> ! = titre , !! = sous titre, !!! = sous-sous-titre
    * false-> !!! = titre , !! = sous titre, ! = sous-sous-titre
    */
   var $_order=false;

   function getRenderedLine(){
      if($this->_order)
         $hx= $this->_minlevel + strlen($this->_detectMatch[1])-1;
      else
         $hx= $this->_minlevel + 3-strlen($this->_detectMatch[1]);
      return '<h'.$hx.'>'.$this->_renderInlineTag($this->_detectMatch[2]).'</h'.$hx.'>';
   }
}

/**
 * traite les signes de type paragraphe
 */
class cwrxhtml_p extends WikiRendererBloc {
   var $type='p';
   var $_openTag='<p>';
   var $_closeTag='</p>';
   //var $regexp='/^([^\*#\-!\|\s\>;].*)$/';

   function detect($string){
      if($string=='') return false;
      if(preg_match('/^={4,} *$/',$string)) return false;
      $c=$string{0};
      if(strpos("*#-!| \t>;" ,$c) === false){
        $this->_detectMatch=array($string,$string);
        return true;
      }else{
        return false;
      }
      //return preg_match($this->regexp, $string, $this->_detectMatch);
   }
}

/**
 * traite les signes de types pre (pour afficher du code..)
 */
class cwrxhtml_pre extends WikiRendererBloc {

   var $type='pre';
   var $regexp="/^\s(.*)/";
   var $_openTag='<pre>';
   var $_closeTag='</pre>';

   function getRenderedLine(){
      return htmlspecialchars($this->_detectMatch[1]);
   }

}


/**
 * traite les signes de type blockquote
 */
class cwrxhtml_blockquote extends WikiRendererBloc {
   var $type='bq';
   var $regexp="/^(\>+)(.*)/";

   function open(){
      $this->_previousTag = $this->_detectMatch[1];
      $this->_firstTagLen = strlen($this->_previousTag);
      $this->_firstLine = true;
      return str_repeat('<blockquote>',$this->_firstTagLen).'<p>';
   }

   function close(){
      return '</p>'.str_repeat('</blockquote>',strlen($this->_previousTag));
   }


   function getRenderedLine(){

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
         else
            $str='<br />';
      }
      return $str.$this->_renderInlineTag($this->_detectMatch[2]);
   }
}

/**
 * traite les signes de type définitions
 */
class cwrxhtml_definition extends WikiRendererBloc {

   var $type='dfn';
   var $regexp="/^;(.*) : (.*)/i";
   var $_openTag='<dl>';
   var $_closeTag='</dl>';

   function getRenderedLine(){
      $dt=$this->_renderInlineTag($this->_detectMatch[1]);
      $dd=$this->_renderInlineTag($this->_detectMatch[2]);
      return "<dt>$dt</dt>\n<dd>$dd</dd>\n";
   }
}

?>