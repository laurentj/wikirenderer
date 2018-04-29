<?php

/**
 * DokuWiki syntax.
 *
 * @author Laurent Jouanneau
 * @copyright 2008-2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */
namespace WikiRenderer\Markup\JWiki;
use \WikiRenderer\Generator\InlineGeneratorInterface;

/**
 * Parse code inline tag.
 */
class Code extends \WikiRenderer\InlineTag
{
    protected $name = 'code';
    protected $generatorName = 'code';
    protected $beginTag = '@@';
    protected $endTag = '@@';

    protected $hasStarted = false;

    protected $code_types = array(
        'A' => 'attribute',
        'C' => 'classname',
        'T' => 'constant',
        'c' => 'command',
        'E' => 'element',
        'e' => 'envar',
        'F' => 'filename',
        'f' => 'function',
        'I' => 'interfacename',
        'L' => 'literal',
        'M' => 'methodname',
        'P' => 'property',
        'R' => 'returnvalue',
        'V' => 'varname',
    );

    public function addContentString($wikiContent)
    {
        $this->wikiContentArr[$this->separatorCount] .= $wikiContent;
        if (!$this->hasStarted) {
            if ($wikiContent[1] == '@') {
                $type = $wikiContent[0];
                $wikiContent = substr($wikiContent, 2);
                if ($type == 'K') {
                    $this->generator = $this->documentGenerator->getInlineGenerator('key');
                } elseif ($type == 'V') {
                    $this->generator = $this->documentGenerator->getInlineGenerator('variable');
                } elseif (isset($this->code_types[$type])) {
                    $this->generator->setAttribute('type', $this->code_types[$type]);
                } else {
                    // unknown type, let's cancel
                    $wikiContent = $type.'@'.$wikiContent;
                }
            }
            $this->hasStarted = true;
        }

        $parsedContent = $this->convertWords($wikiContent);
        if (is_string($parsedContent)) {
            $this->generator->addRawContent($parsedContent);
        } else {
            $this->generator->addContent($parsedContent);
        }
    }

    public function addContentGenerator($wikiContent, InlineGeneratorInterface $childGenerator)
    {
        $this->wikiContentArr[$this->separatorCount] .= $wikiContent;
        $this->hasStarted = true;
        $this->generator->addContent($childGenerator);
    }

    public function getContent()
    {
        return $this->generator;
    }

    public function isOtherTagAllowed()
    {
        return false;
    }
}
