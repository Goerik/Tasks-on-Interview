<?php

$_fp = fopen("php://stdin", "r");
fscanf($_fp, "%d", $N);

$v = array();
$left = array();
$right = array();

$leftS = "";
$rigthS = "";

for($i = 0; $i < $N; $i++) {
    fscanf($_fp, "%d", $d);
    $v[$i] = $d;
}


for ($i = 0; $i < $N; $i++) {
    if (key_exists($v[$i], $left)) {
        $leftS  = $leftS  . "1";
    } else {
        $leftS  = $leftS  . "0";
        $left[$v[$i]] = 1;
    }
}

for ($i = $N - 1; $i >= 0; $i--) {
    if (key_exists($v[$i], $right)) {
        $rigthS  = $rigthS  . "1";
    } else {
        $rigthS  = $rigthS  . "0";
        $right[$v[$i]] = 1;
    }
}

echo $leftS . "\n";
echo strrev($rigthS) . "\n";