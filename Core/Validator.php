<?php
namespace Core;
class Validator {


    public static function string($value, $min = 1, $max = INF){

        $value = trim($value);

        return strlen($value) >= $min && strlen($value <= $max);
    }

    public static function email($value, $min = 1, $max = INF){

        return filter_var($value);
    }



}