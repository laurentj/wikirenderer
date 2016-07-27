<?php

/**
 * String utils functions
 *
 * @author Laurent Jouanneau
 *
 * @copyright 2016 Laurent Jouanneau
 *
 * @link http://wikirenderer.jelix.org
 *
 * @licence MIT see LICENCE file
 */
namespace WikiRenderer;



class StringUtils {

    static function tabExpand($str, $tabStop = 4) {
        while (strpos($str, "\t") !== false) {
            $str = preg_replace_callback(
                        '/^([^\t]*)(\t+)/',
                        function ($matches) use ($tabStop) {
                            $l = strlen($matches[2]) * $tabStop - strlen($matches[1])
                                % $tabStop;
                            return $matches[1].str_repeat(' ', $l);
                        },
                        $str);
        }
        return $str;
    }
}


