<?php

$cached = '';
function includeJs($url, $cached = NULL){
    if(!isset($cached)){
        $tp = microtime();
        $tp = str_replace(' ', '', $tp);
        $tp = str_replace('.', '', $tp);
        $url = $url . '?c=' . $tp . '&' . $tp;
    }
    echo "<script type=\"text/javascript\" src=\"$url\"></script>\n";
}

function includeCss($url){
    echo "<link href=\"$url\" rel=\"stylesheet\">\n";
}

foreach ($_POST as $k => $v) {
	$k = 'post' . ucfirst($k);
	global $$k;
	$$k = $v;
}
//header("Content-Type: text/html; charset=UTF-8",true);

?>