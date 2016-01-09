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
 * interface to implements a class that will generate an inline element
 * in the output format (html element for instance)
 */
interface InlineComplexGeneratorInterface extends InlineGeneratorInterface {

    /**
     * append the given string to the content of the element
     *
     * @internal the given string will be transformed as a generator
     * @param string $string
     */
    public function addRawContent($string);

    /**
     * set the content of the element
     *
     * the given string will replace previous content added with
     * addRawContent() and addContent()
     * 
     * @internal the given string will be transformed as a generator
     * @param string $string
     */
    public function setRawContent($string);

    /**
     * the content generated by the given generator will be append to
     * the content of the element.
     * 
     * @param InlineGeneratorInterface $content
     */
    public function addContent(InlineGeneratorInterface $content);

    /**
     * the content generated by the given generator will be added at
     * the first position in the list
     * 
     * @param InlineGeneratorInterface $content
     */
    public function addContentAtStart(InlineGeneratorInterface $content);

    /**
     * the content generated by the given generator will be 
     * the content of the element.
     * 
     * the given generator will replace previous content added with
     * addRawContent() and addContent()

     * @param InlineGeneratorInterface $content
     */
    public function setContent(InlineGeneratorInterface $content);

    /**
     * return the list of all generators that will produced the
     * content of the element
     * 
     * @return InlineGeneratorInterface[]
     */
    public function getChildGenerators();

    /**
     * set an attribute value.
     *
     * list of possible attributes depends of the implementation
     *
     * @param string $name
     * @param string $value
     */
    public function setAttribute($name, $value);

    /**
     * return the value of an attribute
     *
     * @return string|null  null if the attribute does not exists ore has no
     *  value
     */
    public function getAttribute($name);
}
