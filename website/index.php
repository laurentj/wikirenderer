<?php

$lang = '';

if(isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])){
    
    $languages = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']);
    foreach($languages as $bl){
        if(preg_match("/^([a-zA-Z]{2})(?:[-_]([a-zA-Z]{2}))?(;q=[0-9]\\.[0-9])?$/",$bl,$match)){
            $l = strtolower($match[1]);
            if ($l == 'fr'){
                $lang = 'fr';
                break;
            }
            if ($l == 'en'){
                $lang = 'en';
                break;
            }
        }
    }
}

if ($lang == '')
    $lang = 'en';

include ($lang.'/index.php');


?>