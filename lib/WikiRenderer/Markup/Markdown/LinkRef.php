<?php
/**
 * Markdown (CommonMark) syntax.
 *
 * @author Laurent Jouanneau
 * @copyright 2018 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */
namespace WikiRenderer\Markup\Markdown;

/**
 */
class LinkRef extends \WikiRenderer\Block
{
    public $type = 'para';

    protected $regexp = "/^( {0,3})\\[((?:[^\\]]|\\\\])+)\\]\\:(.*)$/u";

    protected $linkLabel = '';

    protected $linkRefContent = '';

    protected $linkTitle = '';

    public function isStarting($string)
    {
        if (!preg_match($this->regexp, $string, $this->_detectMatch)) {
            return false;
        }
        $this->linkLabel = str_replace("\\]", "]", $this->_detectMatch[2]);
        $this->linkRefContent = $this->_detectMatch[3];
        return true;
    }

    public function open()
    {
        $this->engine->getConfig()->emptyLineCloseParagraph = false;
    }

    public function isAccepting($line)
    {
        if ($line == '') {
            return false;
        }
        if (preg_match($this->regexp, $line)) {
            return false;
        }
        $this->linkRefContent .= "\n".$line;
        return true;
    }

    public function validateLine()
    {
    }

    /**
     * @return array  information about the link
     *          0: the link destination
     *          1: the title
     *          2: content to generate into a paragraph
     */
    protected function parseRefContent($refContent) {
        $content = trim($refContent);
        if ($content == '') {
            return array('', '', '['.$this->linkLabel.']:'.$this->linkRefContent);
        }
        if ($content[0] == '<') {
            if (!preg_match("/^<([^>]+)>(\s*)((?:.|\s)*)/mu", $content, $m)) {
                return array('', '', $content);
            }
            $destination = $m[1];
            $descSeparator = $m[2];
            $content = $m[3];
        }
        else {
            if (!preg_match("/^([^\s]+)(\s*)((?:.|\s)*)/mu", $content, $m)) {
                return array($content, '', '');
            }
            $destination = $m[1];
            $descSeparator = $m[2];
            $content = $m[3];
        }
        // keep \n
        $descSeparator = str_replace(array(" ", "\t", "\r"), "", $descSeparator);
        $destination = str_replace("\\", "%5C", preg_replace("/\\\\(\W)/","$1", $destination));

        if (trim($content) == '') {
            return array($destination, '', '');
        }

        $enclosing = $content[0];
        // Verify that title starts with a ' or "
        if ($enclosing == '"' || $enclosing == "'") {
            if (preg_match("/^".$enclosing."((?:[^".$enclosing."]|\\".$enclosing.")*)".$enclosing."((?:.|\s)*)/mu", $content, $m)) {
                if (trim($m[2]) == '') {
                    $title = str_replace("\\".$enclosing, $enclosing, $m[1]);
                    return array($destination, $title, '');
                }
            }
        }

        if ($descSeparator != '') {
            // if there was a line separator, it's ok to keep destination
            return array($destination, '', $content);
        }
        return array('', '', '['.$this->linkLabel.']:'.$this->linkRefContent);
    }


    public function close($reason) {
        
        list($link, $title, $paragraph) = $this->parseRefContent($this->linkRefContent);
        
        if ($link != '') {
            $linkRefs = $this->documentGenerator->getMetaData('linkRefs');
            if ($linkRefs == null) {
                $linkRefs = new \ArrayObject();
            }
            if (class_exists('\Transliterator',false)) {
                $tl = \Transliterator::create("Lower()");
                $label = $tl->transliterate($this->linkLabel);
            }
            else {
                $label = \strtolower($this->linkLabel);
            }
            if (!isset($linkRefs[$label])) {
                $linkRefs[$label] = array($link, $title);
                $this->documentGenerator->setMetaData('linkRefs', $linkRefs);
            }
        }
               
        if ($paragraph == '') {
            $this->generator = new \WikiRenderer\Generator\SingleLineBlock($this->documentGenerator->getConfig());
        }
        else {
            $this->generator = $this->documentGenerator->getBlockGenerator('para');
            $lines = $this->documentGenerator->getInlineGenerator('words');
            $lines->addRawContent($paragraph);
            $this->generator->addLine($lines);
        }
        return $this->generator;
    }
}

