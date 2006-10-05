<?php
/**
 * classic wikirenderer syntax to plain text
 *
 * @package WikiRenderer
 * @subpackage classicwr_to_xhtml
 * @author Laurent Jouanneau <jouanneau@netcourrier.com>
 * @copyright 2003-2006 Laurent Jouanneau
 * @link http://wikirenderer.berlios.de
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

class ConfigClassicwrToText  extends WikiRendererConfig {
  /**
    * @var array   liste des tags inline
   */
   var $inlinetags= array( 'cwrtext_strong','cwrtext_em','cwrtext_code','cwrtext_q',
    'cwrtext_cite','cwrtext_acronym','cwrtext_link', 'cwrtext_image', 'cwrtext_anchor');

   var $textLineContainer = 'WikiTextLine';

   /**
   * liste des balises de type bloc reconnus par WikiRenderer.
   */
   var $bloctags = array('cwrtext_title', 'cwrtext_list', 'cwrtext_pre','cwrtext_hr',
                         'cwrtext_blockquote','cwrtext_definition','cwrtext_table', 'cwrtext_p');


   var $simpletags = array('%%%'=>"\n");

}

// ===================================== déclarations des tags inlines

class cwrtext_strong extends WikiTag {
    var $beginTag='__';
    var $endTag='__';
}

class cwrtext_em extends WikiTag {
    var $beginTag='\'\'';
    var $endTag='\'\'';
}

class cwrtext_code extends WikiTag {
    var $beginTag='@@';
    var $endTag='@@';
    function getContent(){ return '['.$this->contents[0].']';}
}

class cwrtext_q extends WikiTag {
    var $beginTag='^^';
    var $endTag='^^';
    var $attribute=array('$$','lang','cite');
    var $separators=array('|');
    function getContent(){
        if($this->separatorCount > 1)
            return '"'.$this->contents[0].'" ('.$this->contents[2].')';
        else
            return '"'.$this->contents[0].'"';
    }
}

class cwrtext_cite extends WikiTag {
    var $beginTag='{{';
    var $endTag='}}';
    var $attribute=array('$$','title');
    var $separators=array('|');
    function getContent(){
        if($this->separatorCount > 1)
            return '"'.$this->contents[0].'" ('.$this->contents[2].')';
        else
            return '"'.$this->contents[0].'"';
    }
}

class cwrtext_acronym extends WikiTag {
    var $name='acronym';
    var $beginTag='??';
    var $endTag='??';
    var $attribute=array('$$','title');
    var $separators=array('|');
    function getContent(){
        if($this->separatorCount > 0)
            return $this->contents[0].' ('.$this->contents[2].')';
        else
            return $this->contents[0];
    }
}

class cwrtext_anchor extends WikiTag {
    var $beginTag='~~';
    var $endTag='~~';
    var $attribute=array('name');
    var $separators=array('|');
    function getContent(){ return ''; }
}


class cwrtext_link extends WikiTag {
    var $beginTag='[';
    var $endTag=']';
    var $attribute=array('$$','href','hreflang','title');
    var $separators=array('|');
    function getContent(){
        $cntattr=count($this->attribute);
        $cnt=($this->separatorCount + 1 > $cntattr?$cntattr:$this->separatorCount+1);
        if($cnt == 1 ){
            return $this->wikiContentArr[0];
        }else{
            return $this->wikiContentArr[0].' ('.$this->wikiContentArr[1].')';
        }
    }
}



class cwrtext_image extends WikiTag {
    var $name='image';
    var $beginTag='((';
    var $endTag='))';
    var $attribute=array('src','alt','align','longdesc');
    var $separators=array('|');

    function getContent(){ return ''; }
}



// ===================================== déclaration des différents bloc wiki

/**
 * traite les signes de types liste
 */
class cwrtext_list extends WikiRendererBloc {
   var $type='list';
   var $regexp="/^([\*#-]+)(.*)/";
   function getRenderedLine(){
      return $this->_detectMatch[1].$this->_renderInlineTag($this->_detectMatch[2]);
   }
}


/**
 * traite les signes de types table
 */
class cwrtext_table extends WikiRendererBloc {
   var $type='table';
   var $regexp="/^\| ?(.*)/";
   var $_openTag="--------------------------------------------";
   var $_closeTag="--------------------------------------------\n";

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
         $t="--------------------------------------------\n";
      $this->_colcount=count($result);

      for($i=0; $i < $this->_colcount; $i++){
         $str.= $this->_renderInlineTag($result[$i])."\t| ";
      }
      $str=$t."| ".$str;

      return $str;
   }

}

/**
 * traite les signes de types hr
 */
class cwrtext_hr extends WikiRendererBloc {

   var $type='hr';
   var $regexp='/^={4,} *$/';
   var $_closeNow=true;

   function getRenderedLine(){
      return "=======================================================\n";
   }

}

/**
 * traite les signes de types titre
 */
class cwrtext_title extends WikiRendererBloc {
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

   function cwrtext_title(&$wr){
      parent::WikiRendererBloc($wr);
   }

   function getRenderedLine(){
      if($this->_order){
         $repeat= 4- strlen($this->_detectMatch[1]);
         if($repeat <1) $repeat=1;
      }else
         $repeat= strlen($this->_detectMatch[1]);
      return str_repeat("\n",$repeat)."\t".$this->_renderInlineTag($this->_detectMatch[2])."\n";
   }
}

/**
 * traite les signes de type paragraphe
 */
class cwrtext_p extends WikiRendererBloc {
   var $type='p';

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
   }
}

/**
 * traite les signes de types pre (pour afficher du code..)
 */
class cwrtext_pre extends WikiRendererBloc {

   var $type='pre';
   var $regexp="/^(\s)(.*)/";

   function getRenderedLine(){
      return $this->_detectMatch[1].$this->_renderInlineTag($this->_detectMatch[2]);
   }

}


/**
 * traite les signes de type blockquote
 */
class cwrtext_blockquote extends WikiRendererBloc {
   var $type='bq';
   var $regexp="/^(\>+)(.*)/";

   function getRenderedLine(){
      return $this->_detectMatch[1].$this->_renderInlineTag($this->_detectMatch[2]);
   }
}

/**
 * traite les signes de type définitions
 */
class cwrtext_definition extends WikiRendererBloc {

   var $type='dfn';
   var $regexp="/^;(.*) : (.*)/i";

   function getRenderedLine(){
      $dt=$this->_renderInlineTag($this->_detectMatch[1]);
      $dd=$this->_renderInlineTag($this->_detectMatch[2]);
      return "$dt :\n\t$dd";
   }
}

?>