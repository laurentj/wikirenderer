<?php


$content = file_get_contents('https://raw.githubusercontent.com/jgm/CommonMark/master/spec.txt');


preg_match_all("/^\.\n([\s\S]*?)^\.\n([\s\S]*?)^\.$/mu", $content, $m,PREG_SET_ORDER);

foreach($m as $k => list($a, $md, $html)) {
    $content = array($md, $html);
    file_put_contents('test_'.($k+1).'.json', json_encode($content));
}

