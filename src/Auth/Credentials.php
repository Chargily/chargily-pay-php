<?php

namespace Chargily\ChargilyPay\Auth;

use Chargily\ChargilyPay\Exceptions\ValidationException;
use Chargily\ChargilyPay\Validation\Auth\CredentialsValidation;

final class Credentials
{
    /**
     * Mode test or live
     *
     * @var string
     */
    public string $mode;
    /**
     * Check test mode
     *
     * @var boolean
     */
    public bool $test_mode;
    /**
     * Check live mode
     *
     * @var boolean
     */
    public bool $live_mode;
    /**
     * Merchant Public Key
     *
     * @var string
     */
    public string $public;
    /**
     * Merchant Secret Key
     *
     * @var string
     */
    public string $secret;

    public function __construct(array $configs)
    {
        $status = $this->validation($configs);

        $this->mode = $configs["mode"];
        $this->test_mode = $this->mode === "test";
        $this->live_mode = $this->mode === "live";
        $this->public = $configs["public"];
        $this->secret = $configs["secret"];
    }
    /**
     * The token used with the authorization header
     *
     * @return string
     */
    public function getAuthorizationToken(): string
    {
        return $this->secret;
    }
    /**
     * Validate credentials
     *
     * @param array $attributes
     * @return boolean
     */
    public function validation(array $attributes): bool
    {

        $validation = new CredentialsValidation($attributes);

        if (!$validation->passed()) {
            ValidationException::message("Authentication Credentials", $validation->errors(), 422);
        }

        return $validation->passed();
    }
}
