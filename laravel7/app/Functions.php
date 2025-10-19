<?php

namespace App;

use Illuminate\Support\Str as SupportString;

use function mb_strtolower as toLowerCase;  // UTF-8
use function mb_strlen as lengthString; // UTF-8
use function is_string as isString;
use function is_integer as isInteger;
use function is_null as isNull;
use function json_encode as jsonEncode;
use function json_decode as jsonDecode;
use function is_numeric as isNumeric;

class Functions {
    
    public static function toSnakeCase($value) {
        
        // SnakeCase

        if (!isString($value)) return null;
        return SupportString::snake($value);
    
    }

    public static function toLowerCase($value) {
        
        // LowerCase
        
        if (!isString($value)) return null;
        return toLowerCase($value);
    
    }

    public static function uuid() {
    
        // UUID v4
        
        return (string) SupportString::uuid();
    }

    public static function toColumnName(string $value): string {

        // CamelCase to SnakeCase

        if (!isString($value)) return null;
        return SupportString::snake($value);

    }

    public static function jsonEncode($value, $flags = JSON_UNESCAPED_UNICODE){

        return jsonEncode($value, $flags);

    }

    public static function jsonDecode($value, $flags = JSON_UNESCAPED_UNICODE){

        return jsonDecode($value, true, 512, $flags);

    }

    public static function isNull($value){

        return isNull($value);

    }

    public static function isString($value){

        return isString($value);

    }

    public static function isInteger($value){

        return isInteger($value);

    }

    public static function lengthString($value, $encoding = 'UTF-8') {
        
        if (!isString($value)) return 0;
        return lengthString($value, $encoding);
    
    }

    public static function toInteger($value) {
        if (isNumeric($value))
            return (int) $value;
        else 
            return null;
    }

    public static function toCamelCaseArray($array){
        $result = [];
        foreach ($array as $key => $value) {
            $result[SupportString::camel($key )] = $value;
        }
        return $result;
    }

}