<?php
/**
 * phpwiki syntax to dokuwiki syntax
 *
 * @package WikiRenderer
 * @subpackage rules
 * @author Laurent Jouanneau
 * @copyright 2009 Laurent Jouanneau
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

class phpwiki_to_dokuwiki  extends WikiRendererConfig {
  /**
    * @var array   liste des tags inline
   */
   public $inlinetags= array( 'pwdk_strong','pwdk_em',/*'pwdk_nolink',*/ 'pwdk_link',/* 'pwdk_image'*/);

   public $defaultTextLineContainer = 'WikiTextLine';

   public $availabledTextLineContainers = array('WikiTextLine');

   public $bloctags = array(/*'pwdk_title', 'pwdk_list', 'pwdk_pre','pwdk_hr',
                         'pwdk_blockquote','pwdk_definition','pwdk_table',*/ 'pwdk_p');

   public $simpletags = array('%%%'=>"\n");

}

// ===================================== déclarations des tags inlines

class pwdk_strong extends WikiTag {
    public $beginTag='__';
    public $endTag='__';
    
   /* function __construct($config){
      parent::__construct($config);
      echo "PWDK stronggggg<br>";
    }
    public function addContent($wikiContent, $parsedContent=false){
      echo "ADD CONTENT : $wikiContent  (parsedcontent=$parsedContent)<br>";
      parent::addContent($wikiContent, $parsedContent);
    }
    public function getWikiContent(){
      echo 'GETWIKICONTENT<br>';
      return parent::getWikiContent();
    }
    public function isOtherTagAllowed() {
      echo "ISOTHERTAG<br>";
      return parent::isOtherTagAllowed();
    }*/
    public function getContent(){ return '**'.$this->contents[0].'**';}
}

class pwdk_em extends WikiTag {
    public $beginTag='\'\'';
    public $endTag='\'\'';
    public function getContent(){ return '//'.$this->contents[0].'//';}
}
/*
class pwdk_code extends WikiTag {
    public $beginTag='@@';
    public $endTag='@@';
    public function getContent(){ return '@@'.$this->contents[0].'@@';}
}

class pwdk_q extends WikiTag {
    public $beginTag='^^';
    public $endTag='^^';
    protected $attribute=array('$$','lang','cite');
    public $separators=array('|');
    public function getContent(){
        if($this->separatorCount == 0)
            return '^^'.$this->contents[0].'^^';
        elseif($this->separatorCount == 1)
            return '^^'.$this->contents[0].'|'.$this->wikiContentArr[1].'^^';
        else
            return '^^'.$this->contents[0].'|'.$this->wikiContentArr[1].'|'.$this->wikiContentArr[2].'^^';
    }
}

class pwdk_cite extends WikiTag {
    public $beginTag='{{';
    public $endTag='}}';
    protected $attribute=array('$$','title');
    public $separators=array('|');

    public function getContent(){
        if($this->separatorCount == 0)
            return '{{'.$this->contents[0].'}}';
        else
            return '{{'.$this->contents[0].'|'.$this->wikiContentArr[1].'}}';
    }

}

class pwdk_acronym extends WikiTag {
    public $beginTag='??';
    public $endTag='??';
    protected $attribute=array('$$','title');
    public $separators=array('|');
    public function getContent(){
        if($this->separatorCount == 0)
            return '??'.$this->contents[0].'??';
        else
            return '??'.$this->contents[0].'|'.$this->wikiContentArr[1].'??';
    }
}

class pwdk_anchor extends WikiTag {
    public $beginTag='~~';
    public $endTag='~~';
    protected $attribute=array('name');
    public $separators=array('|');
    public function getContent(){ return '~~'.$this->wikiContentArr[0].'~~'; }
}*/


class pwdk_nolink extends WikiTag {
    public $beginTag='[[';
    public $endTag=']';
    protected $attribute=array('$$');
    public $separators=array();
    public function getContent(){
        return '['.$this->contents[0].']';
    }
}


class pwdk_link extends WikiTag {
    public $beginTag='[';
    public $endTag=']';
    protected $attribute=array('$$','href');
    public $separators=array('|');
    public function getContent(){
        if($this->separatorCount == 0)
            return '[['.$this->contents[0].']]';
        elseif($this->separatorCount == 1)
            return '[['.$this->wikiContentArr[1].'|'.$this->contents[0].']]';
    }
}



class pwdk_image extends WikiTag {
    public $beginTag='((';
    public $endTag='))';
    protected $attribute=array('src','alt','align','longdesc');
    public $separators=array('|');

    public function getContent(){
        if($this->separatorCount == 0)
            return '(('.$this->wikiContentArr[0].'))';
        elseif($this->separatorCount == 1)
            return '(('.$this->wikiContentArr[0].'|'.$this->wikiContentArr[1].'))';
        elseif($this->separatorCount == 2)
            return '(('.$this->wikiContentArr[0].'|'.$this->wikiContentArr[1].'|'.$this->wikiContentArr[2].'))';
        else
            return '(('.$this->wikiContentArr[0].'|'.$this->wikiContentArr[1].'|'.$this->wikiContentArr[2].'|'.$this->wikiContentArr[3].'))';
    }
}



// ===================================== déclaration des différents bloc wiki

class PwDkBloc extends WikiRendererBloc {
   /*public function getRenderedLine(){
      return $this->_detectMatch[1];
   }*/
}

/**
 * traite les signes de types liste
 */
class pwdk_list extends PwDkBloc {
   public $type='list';
   protected $regexp="/^([\*#-]+.*)/";
}


/**
 * traite les signes de types table
 */
class pwdk_table extends PwDkBloc {
   public $type='table';
   protected $regexp="/^(\| ?.*)/";
}

/**
 * traite les signes de types hr
 */
class pwdk_hr extends PwDkBloc {

   public $type='hr';
   protected $regexp='/^(={4,}) *$/';
   protected $_closeNow=true;
}

/**
 * traite les signes de types titre
 */
class pwdk_title extends PwDkBloc {
   public $type='title';
   protected $regexp="/^(\!{1,3}.*)/";
   protected $_closeNow=true;
}

/**
 * traite les signes de type paragraphe
 */
class pwdk_p extends PwDkBloc {
   public $type='p';

   public function detect($string){
      if($string=='') return false;
      if(preg_match('/^={4,} *$/',$string)) return false;
      $c=$string{0};
      if(strpos("*#-!| \t>;" ,$c) === false){
        $this->_detectMatch = array($string,$string);
        return true;
      }else{
        return false;
      }
   }
}

/**
 * traite les signes de types pre (pour afficher du code..)
 */
class pwdk_pre extends PwDkBloc {

   public $type='pre';
   protected $regexp="/^(\s.*)/";
   protected $_openTag="<code>";
   protected $_closeTag="</code>";
}


/**
 * traite les signes de type blockquote
 */
class pwdk_blockquote extends PwDkBloc {
   public $type='bq';
   protected $regexp="/^(\>+.*)/";
}

/**
 * traite les signes de type définitions
 */
class pwdk_definition extends PwDkBloc {

   public $type='dfn';
   protected $regexp="/^(;.* : .*)/i";
}

?>