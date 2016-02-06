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

namespace WikiRenderer\Generator\Docbook;

class Quote extends AbstractInlineGenerator {

    protected $dbTagName = 'quote';

    protected $supportedAttributes = array('id', 'lang', 'cite');

    public function generate() {
        $text = '';
        foreach($this->content as $content) {
            $text .= $content->generate();
        }

        $attr = '';
        $id = $this->getAttribute('id');
        if ($id) {
            $attr .= ' xml:id="'.htmlspecialchars($id, ENT_XML1).'"';
        }
        $lang = $this->getAttribute('lang');
        if ($lang) {
            $text = '<foreignphrase xml:lang="'.htmlspecialchars($lang, ENT_XML1).'">'.$text.'</foreignphrase>';
        }

        return '<'.$this->dbTagName.$attr.'>'.$text.'</'.$this->dbTagName.'>';
    }
}