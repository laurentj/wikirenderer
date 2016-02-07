<?php

/**
 * Trac syntax
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
 * Parser for definitions block
 */
class Definition extends \WikiRenderer\Block
{
    public $type = 'definition';

    protected $isOpen = false;
    protected $indent = 0;

    protected $currentTerm = null;
    protected $currentDefinition = array();
    protected $detectedTerm = null;
    protected $detectedDef = null;

    public function close()
    {
        $this->generateDef();
        return parent::close();
    }

    protected function generateDef() {
        if ($this->currentTerm && count($this->currentDefinition)) {
            if (count($this->currentDefinition) > 1) {
                $definition = new \WikiRenderer\Generator\InlineBagGenerator(' ', $this->currentDefinition);
            }
            else {
                $definition = $this->currentDefinition[0];
            }
            $this->generator->addDefinition($this->currentTerm, $definition);
        }
    }

    public function validateDetectedLine()
    {
        if ($this->detectedTerm) {
            $this->generateDef();
            $this->currentTerm = $this->_renderInlineTag($this->detectedTerm);
            $this->currentDefinition = array();
        }
        else {
            $this->currentDefinition[] = $this->_renderInlineTag($this->detectedDef);
        }
    }

    public function detect($string, $inBlock = false)
    {
        if ($inBlock) {
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
        } else {
            if (preg_match('/^(\s*)([^:]+)::(.*)/i', $string, $m)) {
                $this->detectedTerm = $m[2];
                $this->detectedDef = null;
                $this->indent = strlen($m[1]);
                return true;
            } else {
                return false;
            }
        }
    }
}
