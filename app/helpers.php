<?php

if (! function_exists('upercaseFirstLetter')) {
    /**
     * Select the first letter in a sentense and return
     * the first two letters in uppercase
     * 
     * @param String $string
     * @return String
     */
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