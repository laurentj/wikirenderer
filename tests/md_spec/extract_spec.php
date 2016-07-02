<?php

// from https://raw.githubusercontent.com/jgm/CommonMark/master/spec.txt
$content = file_get_contents(__DIR__.'/spec.txt');


$parts = preg_split("/(````````````````````````````````( example)?)/m", $content, -1, PREG_SPLIT_DELIM_CAPTURE);

$k = 1;
for($i=3; $i < count($parts); $i+=5) {
    //echo $i.': '.str_replace("\n", '\n', substr($parts[$i], 0, 30))."\n";
    list($md, $html) = explode("\n.\n", $parts[$i],2);
    $md = str_replace("→", "\t", $md);
    $html = str_replace("→", "\t", $html);
    $md = substr($md, 1); // remove trailing \n
    $html = substr($html, 0, -1); // remove ending \n
    $content = array($md, $html);
    file_put_contents('test_'.($k).'.json', json_encode($content));
    $k++;
}
