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

class BlockQuote implements \WikiRenderer\Generator\BlockBlockQuoteInterface
{
    protected $lines = array();

    protected $id = '';

    /**
     * @var null|\WikiRenderer\Generator\Config
     */
    protected $config = null;

    public function __construct(\WikiRenderer\Generator\Config $config) {
        $this->config = $config;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function addContent(\WikiRenderer\Generator\GeneratorInterface $content)
    {
        $this->lines[] = $content;
    }

    public function isEmpty()
    {
        return count($this->lines) == 0;
    }

    public function generate()
    {
        if ($this->id) {
            $text = '<blockquote xml:id="'.htmlspecialchars($this->id, ENT_XML1).'">';
        } else {
            $text = '<blockquote>';
        }

        $currentPara = null;
        foreach ($this->lines as $generator) {
            if ($generator instanceof \WikiRenderer\Generator\BlockGeneratorInterface) {
                if ($currentPara) {
                    $text .= $currentPara->generate()."\n";
                    $currentPara = null;
                }
                $text .= $generator->generate()."\n";
            } elseif ($currentPara) {
                $currentPara->addLine($generator);
            } else {
                $currentPara = new Paragraph($this->config);
                $currentPara->addLine($generator);
            }
        }
        if ($currentPara) {
            $text .= $currentPara->generate();
        }
        $text .= '</blockquote>';

        return $text;
    }
}
