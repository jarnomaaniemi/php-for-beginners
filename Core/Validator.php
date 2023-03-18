<?php

namespace Core;

/**
 * Input validator class
 */
class Validator
{
    // Pure function = not dependent of "outside world" (ex. no reference to $this)
    public static function string($value, $min = 1, $max = INF)
    {
        $value = trim($value);

        // Empty input and maximum input length
        return strlen($value) >= $min && strlen($value) <= $max;
    }

    public static function email($value) {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }
}
