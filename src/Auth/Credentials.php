<?php

namespace Chargily\ChargilyPay\Auth;

use Chargily\ChargilyPay\Exceptions\ValidationException;
use Chargily\ChargilyPay\Validation\Auth\CredentialsValidation;

final class Credentials
{
    /**
     * Mode test or live
     */
    public string $mode;

    /**
     * Check test mode
     */
    public bool $test_mode;

    /**
     * Check live mode
     */
    public bool $live_mode;

    /**
     * Merchant Public Key
     */
    public string $public;

    /**
     * Merchant Secret Key
     */
    public string $secret;

    public function __construct(array $configs)
    {
        // $status = $this->validation($configs);  this variable is decalred but not used

        $this->mode = $configs['mode'];
        $this->test_mode = $this->mode === 'test';
        $this->live_mode = $this->mode === 'live';
        $this->public = $configs['public'];
        $this->secret = $configs['secret'];
    }

    /**
     * The token used with the authorization header
     */
    public function getAuthorizationToken(): string
    {
        return $this->secret;
    }

    /**
     * Validate credentials
     */
    public function validation(array $attributes): bool
    {

        $validation = new CredentialsValidation($attributes);

        if (! $validation->passed()) {
            ValidationException::message('Authentication Credentials', $validation->errors(), 422);
        }
        return true;
    }
}
