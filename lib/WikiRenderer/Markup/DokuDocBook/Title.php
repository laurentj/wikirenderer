<?php

/**
 * dokuwiki syntax to docbook 5.0.
 *
 * @author Laurent Jouanneau
 * @copyright 2008 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer\Markup\DokuDocBook;

/**
 * traite les signes de types titre.
 */
class Title extends \WikiRenderer\Block
{
    public $type = 'title';
    protected $regexp = "/^\s*(\={1,6})([^=]*)(\={1,6})\s*$/";
    protected $_closeNow = true;

    public function validateDetectedLine()
    {
        $level = strlen($this->_detectMatch[1]);
        $conf = $this->engine->getConfig();
        $output = '';
        if (count($conf->sectionLevel)) {
            $last = end($conf->sectionLevel);
            if ($last < $level) {
                $first = true;
                while ($last = end($conf->sectionLevel) && $last <= $level) {
                    if ($this->engine->getPreviousBloc()) {
                        if ($first && $this->engine->getPreviousBloc() instanceof self) {
                            $output .= '<para> </para>';
                        }
                    }
                    $output .= '</section>';
                    $first = false;
                    array_pop($conf->sectionLevel);
                }
            } elseif ($last > $level) {
            } else {
                array_pop($conf->sectionLevel);
                if ($this->engine->getPreviousBloc()) {
                    if ($this->engine->getPreviousBloc() instanceof self) {
                        $output .= '<para> </para>';
                    }
                }
                $output .= '</section>';
            }
        }
        $conf->sectionLevel[] = $level;
        $title = trim($this->_detectMatch[2]);
        $id = $conf->getSectionId($title);
        if ($id) {
            $this->text[] = $output.'<section xml:id="'.$id.'"><title>'.$this->_renderInlineTag($title).'</title>';
        } else {
            $this->text[] = $output.'<section><title>'.$this->_renderInlineTag($title).'</title>';
        }
    }
}
