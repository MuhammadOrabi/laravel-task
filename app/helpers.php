<?php

if (! function_exists('upercaseFirstLetter')) {
    function uperFirstLetter($string) {
        $expr = '/(?<=\s|^)[a-z]/i';
        if (preg_match_all($expr, $string, $matches) > 1) {
            $result = $matches[0][0] . $matches[0][1]; 
        } else {
            $result = $string[0] . $string[1];
        }
        return strtoupper($result);
    }
}