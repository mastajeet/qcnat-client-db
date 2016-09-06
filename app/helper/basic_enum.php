<?php

/**
 * Created by PhpStorm.
 * User: jtbai
 * Date: 2016-09-05
 * Time: 10:01 PM
 */
abstract class BasicEnum {
    private static $constCacheArray = NULL;

    public static function get_constants() {
        if (self::$constCacheArray == NULL) {
            self::$constCacheArray = [];
        }
        $calledClass = get_called_class();
        if (!array_key_exists($calledClass, self::$constCacheArray)) {
            $reflect = new ReflectionClass($calledClass);
            self::$constCacheArray[$calledClass] = $reflect->getConstants();
        }
        return self::$constCacheArray[$calledClass];
    }


    public static function is_valid_name($name, $strict = false) {
        $constants = self::get_constants();

        if ($strict) {
            return array_key_exists($name, $constants);
        }

        $keys = array_map('strtolower', array_keys($constants));
        return in_array(strtolower($name), $keys);
    }

    public static function is_valid_value($value, $strict = true) {
        $values = array_values(self::get_constants());
        return in_array($value, $values, $strict);
    }
}