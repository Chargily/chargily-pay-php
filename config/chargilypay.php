<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Package Name
    |--------------------------------------------------------------------------
    |
    | The name of the package. This is mostly for internal use and organization
    | and can be changed to any name preferred by the developer. It does not
    | affect the package's functionality.
    |
    */

    'name' => 'ChargilyPay',

    /*
    |--------------------------------------------------------------------------
    | Mode
    |--------------------------------------------------------------------------
    |
    | Defines the environment mode in which the ChargilyPay API operates.
    | Options: 'test' or 'live'.
    |
    | - 'test': Uses sandbox/test environment for API requests.
    | - 'live': Uses the live production environment.
    |
    | Set this value in your .env file as CHARGILYPAY_MODE to quickly
    | switch between test and live environments.
    |
    */

    'mode' => env('CHARGILYPAY_MODE', 'test'),

    /*
    |--------------------------------------------------------------------------
    | Public Key
    |--------------------------------------------------------------------------
    |
    | The public API key provided by ChargilyPay. This key is required for
    | authenticating API requests.
    |
    | You should never hard-code sensitive information directly into this file.
    | Instead, set the key in your .env file as CHARGILYPAY_PUBLIC_KEY.
    |
    */

    'public_key' => env('CHARGILYPAY_PUBLIC_KEY', 'test_pk_*************************'),

    /*
    |--------------------------------------------------------------------------
    | Secret Key
    |--------------------------------------------------------------------------
    |
    | The secret API key provided by ChargilyPay. This key is required for
    | secure server-to-server communication.
    |
    | Just like the public key, this key should also be set in your .env file
    | as CHARGILYPAY_SECRET_KEY. Avoid hard-coding it in your configuration.
    |
    */

    'secret_key' => env('CHARGILYPAY_SECRET_KEY', 'test_sk_*************************'),
    
];
