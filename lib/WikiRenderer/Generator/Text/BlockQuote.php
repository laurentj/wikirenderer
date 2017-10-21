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
        $text = '';

        $currentPara = null;
        foreach ($this->lines as $generator) {
            if ($generator instanceof \WikiRenderer\Generator\BlockGeneratorInterface) {
                $generator->indentation = $this->indentation.'>';
                if ($currentPara) {
                    $text .= $currentPara->generate()."\n";
                    $currentPara = null;
                }
                $text .= $generator->generate();
                if (substr($text, -1) != "\n") {
                    $text .= "\n";
                }
            } elseif ($currentPara) {
                $currentPara->addLine($generator);
            } else {
                $currentPara = new Paragraph($this->config);
                $currentPara->indentation = $this->indentation.'> ';
                $currentPara->addLine($generator);
            }
        }
        if ($currentPara) {
            $text .= $currentPara->generate();
        }

        return $text;
    }

    public $indentation = '';
}
