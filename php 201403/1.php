<?php

function superPower( $Z) {
    $flag = 0;
    for ($i = 2; $i < 30; $i++) {
        $v = round(pow($Z, 1/$i));
        if ($Z == pow($v, $i)) {
            $flag = 1;
            break;
        } 
    }
    return $flag;
}
