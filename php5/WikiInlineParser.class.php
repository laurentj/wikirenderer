<?php
/**
 * Wikirenderer is a wiki text parser. It can transform a wiki text into xhtml or other formats
 * @package WikiRenderer
 * @author Laurent Jouanneau <jouanneau@netcourrier.com>
 * @copyright 2003-2008 Laurent Jouanneau
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

/**
 * The parser used to find all inline tag in a single line of text
 * @package WikiRenderer
 * @abstract
 */
class WikiInlineParser {

    public $error=false;

    protected $listTag=array();
    protected $simpletags=array();

    protected $resultline='';
    protected $str=array();
    protected $splitPattern='';
    protected $_separator;
    protected $config;

    protected $textLineContainers=array();

    /**
    * constructor
    * @param WikiRendererConfig $config  a config object
    */
    function __construct($config ){
        $separators = array();
        $this->escapeChar = $config->escapeChar;
        $this->config = $config;

        foreach($config->inlinetags as $class){
            $t = new $class($config);
            $this->listTag[$t->beginTag]=$t;

            $this->splitPattern .= '|('.preg_quote($t->beginTag, '/').')';
            if($t->beginTag!= $t->endTag)
                $this->splitPattern .= '|('.preg_quote($t->endTag, '/').')';
            $separators = array_merge($separators, $t->separators);
        }
        foreach($config->simpletags as $tag=>$html){
            $this->splitPattern.='|('.preg_quote($tag, '/').')';
        }

        foreach($config->availabledTextLineContainers as $class){
            $t = new $class($config);
            $this->textLineContainers[$class] = $t;
            $separators = array_merge($separators, $t->separators);
        }

        $separators= array_unique($separators);
        foreach($separators as $sep){
            $this->splitPattern.='|('.preg_quote($sep, '/').')';
        }
        if($this->escapeChar != '')
            $this->splitPattern .='|('.preg_quote($this->escapeChar, '/').')';
        $this->splitPattern = '/'.substr($this->splitPattern,1).'/';

        $this->simpletags= $config->simpletags;
    }

    /**
    * main function which parse a line of wiki content
    * @param   string   $line   a string containing wiki content, but without line feeds
    * @return  string   the line transformed to the target content 
    */
    public function parse($line){
        $this->error=false;

        $firsttag = clone $this->textLineContainers[$this->config->defaultTextLineContainer];

        $this->str = preg_split($this->splitPattern,$line, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
        $this->end = count($this->str);

        if($this->end > 1){
            $pos=-1;
            $this->_parse($firsttag, $pos);
            return $firsttag->getContent();
        }else{
            $firsttag->addContent($line);
            return  $firsttag->getContent();
        }
    }


    /**
    * core of the parser
    * @return integer new position
    */
    protected function _parse($tag, $posstart){

      $checkNextTag=true;
      $brutContent = '';
      // we analyse each part of the string, 
      for($i=$posstart+1; $i < $this->end; $i++){
            $t=&$this->str[$i];
            $brutContent.=$t;
            // is it the escape char ?
            if($this->escapeChar !='' && $t === $this->escapeChar){
               if($checkNextTag){
                  $t=''; // yes -> let's ignore the tag
                  $checkNextTag=false;
               }else{
                  // if we are here, this is because the previous part was the escape char
                  $tag->addContent($this->escapeChar);
                  $checkNextTag=true;
               }

            // is this a separator ?
            }elseif($t === $tag->getCurrentSeparator()){
                $tag->addSeparator();

            }elseif($checkNextTag){
                // is there a ended tag
                if($tag->endTag == $t && !$tag->isTextLineTag){
                    return $i;

                }elseif(!$tag->isOtherTagAllowed()) {
                    $tag->addContent($t);

                // is there a tag which begin something ?
                }elseif( isset($this->listTag[$t]) ){
                    $newtag = clone $this->listTag[$t];
                    $i=$this->_parse($newtag,$i);
                    if($i !== false){
                        $tag->addContent($newtag->getWikiContent(), $newtag->getContent());
                    }else{
                        $i=$this->end;
                        $tag->addContent($newtag->getWikiContent(), $newtag->getBogusContent());
                    }

                // is there a simple tag ?
                }elseif( isset($this->simpletags[$t])){
                    $tag->addContent($t, $this->simpletags[$t]);
                }else{
                    $tag->addContent($t);
                }
            }else{
                if(isset($this->listTag[$t]) || isset($this->simpletags[$t]) || $tag->endTag == $t)
                    $tag->addContent($t);
                else
                    $tag->addContent($this->escapeChar.$t);
                $checkNextTag=true;
            }
      }
      if(!$tag->isTextLineTag ){
         //we didn't find the eneded tag, error
         $this->error=true;
         return false;
      }else
        return $this->end;
   }

}

