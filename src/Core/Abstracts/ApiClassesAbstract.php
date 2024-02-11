<?php

namespace Chargily\ChargilyPay\Core\Abstracts;

use Chargily\ChargilyPay\Auth\Credentials;

abstract class ApiClassesAbstract
{
    /**
     * Credentials
     */
    protected Credentials $credentials;

    /**
     * constructor
     */
    public function __construct(Credentials $credentials)
    {
        $this->credentials = $credentials;
    }
}
