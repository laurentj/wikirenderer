<?php

// from https://raw.githubusercontent.com/jgm/CommonMark/master/spec.txt
$content = file_get_contents(__DIR__.'/spec.txt');

$separator = "````````````````````````````````";
$parts = preg_split("/(".$separator."( example)?)/m", $content, -1, PREG_SPLIT_DELIM_CAPTURE);

$k = 1;
for($i=0; $i < count($parts); $i++) {
    if ($parts[$i] != $separator." example") {
        continue;
    }
    echo ($i+2).': '.str_replace("\n", '\n', substr($parts[$i+2], 0, 30))."\n";
    list($md, $html) = explode("\n.\n", $parts[$i+2],2);
    $md = str_replace("→", "\t", $md);
    $html = str_replace("→", "\t", $html);
    $md = substr($md, 1); // remove trailing \n
    $html = substr($html, 0, -1); // remove ending \n
    $content = array($md, $html);
    file_put_contents('test_'.($k).'.json', json_encode($content));
    $k++;
    $i += 4;
}
