<?php

/**
 * word converter for inlined URLS
 *
 * @author Laurent Jouanneau
 * @copyright 2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */

namespace WikiRenderer\Markup\Trac;

class TicketConverter extends URLConverter {

    protected $regexp = '/^#[0-9]+$/';

}
