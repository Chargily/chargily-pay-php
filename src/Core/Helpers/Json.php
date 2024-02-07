<?php

namespace Chargily\ChargilyPay\Core\Helpers;

class Json
{
    /**
     * Validate json string
     *
     * @param string $string
     * @return boolean
     */
    public static function validate(string $string, int $depth = 512, int $flags = 0): bool
    {
        if (function_exists("json_validate")) {
            return json_validate($string, $depth, $flags);
        }
        json_decode($string, null, $depth, $flags);
        return json_last_error() === JSON_ERROR_NONE;
    }
}
