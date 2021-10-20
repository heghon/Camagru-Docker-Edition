<?php

// This class allows to use a function concerning strings.
class Str {

    // This function returns a random string of length characters.
    
    static function random($length) {
        $alpha = "0123456789azertyuiopqsdfghjklmwxcvbnAERTYUIOPQSDFGHJKLMWXCVBN";
        return substr(str_shuffle(str_repeat($alpha, $length)), 0, $length);
    }

}