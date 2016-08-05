<?php
/**
 * Markdown (CommonMark) syntax.
 *
 * @author Laurent Jouanneau
 * @copyright 2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */
namespace WikiRenderer\Markup\Markdown;

/**
 * Parser for a text separator.
 */
class Hr extends \WikiRenderer\Block
{
    public $type = 'hr';
    protected $regexp = '/^( {0,3})((\\-\\s*){3,}|(_\\s*){3,}|(\\*\\s*){3,})$/';
    protected $_closeNow = true;

    public function validateLine()
    {
    }
}
