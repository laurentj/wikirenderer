<?php

/**
 * @author Laurent Jouanneau
 * @copyright 2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */
namespace WikiRenderer\Generator\Docbook;

class Section implements \WikiRenderer\Generator\BlockGeneratorInterface,
                         \WikiRenderer\Generator\BlocksContainerInterface
{
    use \WikiRenderer\Generator\BlocksContainerTrait;

    protected $dbTagName = 'section';

    protected $id = '';

    public function setId($id)
    {
        $this->id = $id;
    }

    public function generate()
    {
        if (!count($this->blocksList)) {
            return '';
        }

        if (count($this->blocksList) == 1 &&
            $this->blocksList[0] instanceof Section) {
            return $this->blocksList[0]->generate();
        }

        if ($this->id) {
            $text = '<'.$this->dbTagName.' xml:id="'.htmlspecialchars($this->id, ENT_XML1).'">';
        } else {
            $text = '<'.$this->dbTagName.'>';
        }

        $count = 0;
        $text .= "\n".implode("\n", array_map(function ($generator) use(&$count){
            if ($generator instanceof \WikiRenderer\Generator\SingleLineBlock) {
                $l = $generator->generate();
                if (trim($l) == '') {
                    return '';
                }
                else {
                    $count ++;
                    return '<para>'.$l.'</para>';
                }
            }
            else if ($generator instanceof Section) {
                $content = $generator->generate();
                if ($content) {
                    $count ++;
                    return $content;
                }
                return '';
            }
            $count ++;
            return $generator->generate();
        }, $this->blocksList));

        if ($count == 0) {
            return '';
        }
        if ($count < 2 ) {
            $text .= "<para></para>";
        }
        $text .= '</'.$this->dbTagName.'>';

        return $text;
    }
}
