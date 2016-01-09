<?php

/**
 * wikirenderer3 (wr3) syntax to docbook 5.0.
 *
 * @author Laurent Jouanneau
 * @contributor  Amaury Bouchard
 *
 * @copyright 2003-2013 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer\Markup\WR3DocBook;

/**
 * ???
 */
class Title extends \WikiRenderer\Block
{
    public $type = 'title';
    protected $regexp = "/^\s*(\!{1,3})(.*)/";
    protected $_closeNow = true;
    /**
     * Indique le sens dans lequel il faut interpreter le nombre de signe de titre.
     * true -> ! = titre , !! = sous titre, !!! = sous-sous-titre
     * false-> !!! = titre , !! = sous titre, ! = sous-sous-titre.
     */
    protected $_order = false;

    public function validateDetectedLine()
    {
        $level = strlen($this->_detectMatch[1]);
        if (!$this->_order) {
            $level = 4 - $level;
        }

        $conf = $this->engine->getConfig();

        $output = '';
        if (count($conf->sectionLevel)) {
            $last = end($conf->sectionLevel);
            if ($last > $level) {
                $first = true;
                while ($last = end($conf->sectionLevel) && $last >= $level) {
                    if ($this->engine->getPreviousBloc()) {
                        if ($first && $this->engine->getPreviousBloc() instanceof self) {
                            $output .= '<para> </para>';
                        }
                    }
                    $output .= '</section>';
                    $first = false;
                    array_pop($conf->sectionLevel);
                }
            } elseif ($last < $level) {
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

        $this->text[] = $output.'<section><title>'.$this->_renderInlineTag($this->_detectMatch[2]).'</title>';
    }
}
