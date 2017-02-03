<?php

/**
 * @author Laurent Jouanneau
 * @copyright 2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */
namespace WikiRenderer\Generator\Text;

class FootnoteLink extends AbstractInlineGenerator implements \WikiRenderer\Generator\InlineFootnotelinkInterface
{
    protected $supportedAttributes = array('number');

    /**
     * @var \WikiRenderer\Generator\BlockFootnoteInterface
     */
    protected $footnotes;

    function __construct(\WikiRenderer\Generator\BlockFootnoteInterface $footnotes) {
        $this->footnotes = $footnotes;
    }

    public function generateFootnote() {
        $html = '';
        foreach ($this->content as $content) {
            $html .= $content->generate();
        }
        return $html;
    }

    public function generate()
    {
        if (isset($this->attributes['number'])) {
            $number = $this->attributes['number'];
        }
        else {
            $number = $this->footnotes->addFootnote($this);
        }
        return "[$number]";
    }
}
