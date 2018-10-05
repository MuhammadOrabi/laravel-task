<?php

if (! function_exists('upercaseFirstLetter')) {
    function uperFirstLetter($string) {
        $expr = '/(?<=\s|^)[a-z]/i';
        preg_match_all($expr, $string, $matches);
        $result = implode('', $matches[0]);
        return strtoupper($result);
    }
}