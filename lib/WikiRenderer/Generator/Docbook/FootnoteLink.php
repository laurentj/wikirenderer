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
        return '';
    }

    public function generate()
    {
        if (isset($this->attributes['number'])) {
            list($id , $revid ) = $this->footnotes->getLinkId($this->attributes['number']);
            return '<footnoteref linkend="'.$id.'"/>';
        }
        $number = $this->footnotes->addFootnote($this);
        list($id , $revid ) = $this->footnotes->getLinkId($number);
        $txt = '';
        foreach ($this->content as $content) {
            $txt .= $content->generate();
        }

        return '<footnote xml:id="'.$id.'"><para>'.$txt.'</para></footnote>';
    }
}
