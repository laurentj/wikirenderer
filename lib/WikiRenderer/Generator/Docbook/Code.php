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

class Code extends AbstractInlineGenerator {

    protected $supportedAttributes = array('id', 'type');

    protected $dbTagName = 'code';

    protected static $typeToTag = array(
        'applicationname'=>'application',
        'attribute'=>'parameter',
        'classname'=>'classname',
        'constant'=>'constant',
        'command'=>'command',
        'element'=>'tag',
        'envar'=>'envvar',
        'filename'=>'filename',
        'function'=>'function',
        'interfacename'=>'',
        'literal'=>'literal',
        'methodname'=>'function',
        'property'=>'property',
        'parameter'=>'parameter',
        'option'=>'option',
        'returnvalue'=>'returnvalue',
        'varname'=>'varname',
        'errorcode'=>'errorcode',
        'errorname'=>'errorname',
        'errortype'=>'errortype',
    );

    public function generate() {
        $text = '';
        foreach($this->content as $content) {
            $text .= $content->generate();
        }
        $tag = 'code';

        $attr = '';
        foreach ($this->attributes as $name => $value) {
            if ($name == 'type') {
                if (isset(self::$typeToTag[$name])) {
                    $tag = self::$typeToTag[$name];
                }
            }
            else {
                $attr .= ' '.$name.'="'.htmlspecialchars($value).'"';
            }
        }

        return '<'.$tag.$attr.'>'.$text.'</'.$tag.'>';
    }
}