<?php
/**
 * wikirenderer3 syntax to plain text
 *
 * @package WikiRenderer
 * @subpackage rules
 * @author Laurent Jouanneau <jouanneau@netcourrier.com>
 * @copyright 2003-2006 Laurent Jouanneau
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

class wr3_to_text  extends WikiRendererConfig {
  /**
    * @var array   liste des tags inline
   */
   var $inlinetags= array( 'wr3text_strong','wr3text_em','wr3text_code','wr3text_q',
    'wr3text_cite','wr3text_acronym','wr3text_link', 'wr3text_image', 'wr3text_anchor',
    'wr3text_footnote');

   var $textLineContainer = 'WikiTextLine';

   /**
   * liste des balises de type bloc reconnus par WikiRenderer.
   */
   var $bloctags = array('wr3text_title', 'wr3text_list', 'wr3text_pre','wr3text_hr',
                         'wr3text_blockquote','wr3text_definition','wr3text_table', 'wr3text_p');


   var $simpletags = array('%%%'=>"\n");

}

// ===================================== déclarations des tags inlines

class wr3text_strong extends WikiTag {
    var $beginTag='__';
    var $endTag='__';
}

class wr3text_em extends WikiTag {
    var $beginTag='\'\'';
    var $endTag='\'\'';
}

class wr3text_code extends WikiTag {
    var $beginTag='@@';
    var $endTag='@@';
    function getContent(){ return '['.$this->contents[0].']';}
}

class wr3text_q extends WikiTag {
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

class wr3text_cite extends WikiTag {
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

class wr3text_acronym extends WikiTag {
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

class wr3text_anchor extends WikiTag {
    var $beginTag='~~';
    var $endTag='~~';
    var $attribute=array('name');
    var $separators=array('|');
    function getContent(){ return ''; }
}


class wr3text_link extends WikiTag {
    var $beginTag='[[';
    var $endTag=']]';
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



class wr3text_image extends WikiTag {
    var $beginTag='((';
    var $endTag='))';
    var $attribute=array('src','alt','align','longdesc');
    var $separators=array('|');

    function getContent(){ return ''; }
}


class wr3text_footnote extends WikiTag {
    var $beginTag='$$';
    var $endTag='$$';

    public function getContent(){
       return ' ('.$this->contents[0].')';
   }
}
// ===================================== déclaration des différents bloc wiki

/**
 * traite les signes de types liste
 */
class wr3text_list extends WikiRendererBloc {
   var $type='list';
   var $regexp="/^\s*([\*#-]+)(.*)/";
   function getRenderedLine(){
      return $this->_detectMatch[1].$this->_renderInlineTag($this->_detectMatch[2]);
   }
}


/**
 * traite les signes de types table
 */
class wr3text_table extends WikiRendererBloc {
   var $type='table';
   var $regexp="/^\s*\| ?(.*)/";
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
class wr3text_hr extends WikiRendererBloc {

   var $type='hr';
   var $regexp='/^\s*={4,} *$/';
   var $_closeNow=true;

   function getRenderedLine(){
      return "=======================================================\n";
   }

}

/**
 * traite les signes de types titre
 */
class wr3text_title extends WikiRendererBloc {
   var $type='title';
   var $regexp="/^\s*(\!{1,3})(.*)/";
   var $_closeNow=true;

   var $_minlevel=3;
   /**
    * indique le sens dans lequel il faut interpreter le nombre de signe de titre
    * true -> ! = titre , !! = sous titre, !!! = sous-sous-titre
    * false-> !!! = titre , !! = sous titre, ! = sous-sous-titre
    */
   var $_order=false;

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
class wr3text_p extends WikiRendererBloc {
   var $type='p';

   function detect($string){
      if($string=='') return false;
      if(preg_match("/^\s*[\*#\-\!\| \t>;<=].*/",$string)) return false;
      $this->_detectMatch=array($string,$string);
      return true;
   }
}

/**
 * traite les signes de types pre (pour afficher du code..)
 */
class wr3text_pre extends WikiRendererBloc {

   var $type='pre';

    function getRenderedLine(){
        return '   '.$this->_detectMatch;
    }

    function detect($string){
        if($this->isOpen){
            if(preg_match("/(.*)<\/code>\s*$/",$string,$m)){
                $this->_detectMatch=$m[1];
                $this->isOpen=false;
            }else{
                $this->_detectMatch=$string;
            }
            return true;

        }else{
            if(preg_match("/^\s*<code>(.*)/",$string,$m)){
                $this->isOpen = true;
                $this->_detectMatch=$m[1];
                return true;
            }else{
                return false;
            }
        }
    }

}


/**
 * traite les signes de type blockquote
 */
class wr3text_blockquote extends WikiRendererBloc {
   var $type='bq';
   var $regexp="/^\s*(\>+)(.*)/";

   function getRenderedLine(){
      return $this->_detectMatch[1].$this->_renderInlineTag($this->_detectMatch[2]);
   }
}

/**
 * traite les signes de type définitions
 */
class wr3text_definition extends WikiRendererBloc {

   var $type='dfn';
   var $regexp="/^\s*;(.*) : (.*)/i";

   function getRenderedLine(){
      $dt=$this->_renderInlineTag($this->_detectMatch[1]);
      $dd=$this->_renderInlineTag($this->_detectMatch[2]);
      return "$dt :\n\t$dd";
   }
}

?>