<?php

/**
 * @author Laurent Jouanneau
 *
 * @copyright 2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer\Generator;

/**
 * Block that owns a single line of generated content
 */
class SingleLineBlock implements BlockGeneratorInterface {

    protected $content = null;

    public function __construct(\WikiRenderer\Generator\InlineGeneratorInterface $content = null) {
        $this->content = $content;
    }

    public function setId($id) {
        // do nothing
    }

    public function setLineAsString($content) {
        $this->content = $content;
    }

    public function isEmpty() {
        return ($this->content != '');
    }

    public function generate() {
        if (!$this->content) {
            return '';
        }
        if (is_string($this->content)) {
            return $this->content;
        }
        return $this->content->generate();
    }
}