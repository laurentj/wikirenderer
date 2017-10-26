<?php

/**
 * Trac syntax.
 *
 * @author Laurent Jouanneau
 * @copyright 2006-2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */
namespace WikiRenderer\Markup\Trac;

/**
 * Parser for definitions block.
 */
class Definition extends \WikiRenderer\Block
{
    public $type = 'definition';

    protected $isOpen = false;
    protected $indent = 0;

    /** @var \WikiRenderer\Generator\InlineGeneratorInterface */
    protected $currentTerm = null;

    /** @var \WikiRenderer\Generator\InlineGeneratorInterface[] */
    protected $currentDefinition = array();

    /**
     * @var \WikiRenderer\Generator\BlockDefinitionInterface
     */
    protected $generator;

    protected $detectedTerm = null;
    protected $detectedDef = null;


    public function isStarting($string)
    {
        if (preg_match('/^(\s*)([^:]+)::(.*)/i', $string, $m)) {
            $this->detectedTerm = $m[2];
            $this->detectedDef = null;
            $this->indent = strlen($m[1]);
            return true;
        } else {
            return false;
        }
    }

    public function close($reason)
    {
        $this->generateDef();

        return parent::close($reason);
    }

    protected function generateDef()
    {
        if ($this->currentTerm && count($this->currentDefinition)) {
            if (count($this->currentDefinition) > 1) {
                $definition = new \WikiRenderer\Generator\InlineBagGenerator($this->documentGenerator->getConfig());
                $definition->init(' ', $this->currentDefinition);
            } else {
                $definition = $this->currentDefinition[0];
            }
            $this->generator->addDefinition($this->currentTerm, $definition);
        }
    }

    public function validateLine()
    {
        if ($this->detectedTerm) {
            $this->generateDef();
            $this->currentTerm = $this->parseInlineContent($this->detectedTerm);
            $this->currentDefinition = array();
        } else {
            $this->currentDefinition[] = $this->parseInlineContent($this->detectedDef);
        }
    }

    public function isAccepting($string)
    {
        if (preg_match('/^(\s*)([^:]+)(::)?(.*)/i', $string, $m)) {
            $this->indent = strlen($m[1]);
            if (isset($m[3]) && $m[3] == '::') {
                // this is a term
                $this->detectedTerm = $m[2];
                $this->detectedDef = null;
            } else {
                if (strlen($m[1]) < $this->indent) {
                    return false;
                }
                // this is a definition
                $this->detectedTerm = null;
                $this->detectedDef = $m[2].$m[4];
            }
            return true;
        }

        return false;
    }
}
