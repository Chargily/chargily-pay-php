<?php

namespace Chargily\ChargilyPay\Exceptions;

use Exception;

final class ValidationException extends Exception
{
    public static function message(string $message, $array, $code)
    {
        $message = "Validation failed for ({$message}): ";

        foreach ($array as $key => $value) {
            $msg = $value;
            if (is_array($value)) {
                $msg = json_encode($value);
            }
            $message .= " [({$key}) : {$msg}] ; ";
        }

        throw new self($message, $code);

        return;
    }
}
