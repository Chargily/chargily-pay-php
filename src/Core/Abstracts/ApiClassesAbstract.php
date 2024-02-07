<?php

namespace Chargily\ChargilyPay\Core\Abstracts;

use Chargily\ChargilyPay\Auth\Credentials;

abstract class ApiClassesAbstract
{
    /**
     * Credentials
     *
     * @var Credentials
     */
    protected Credentials $credentials;
    /**
     * constructor
     *
     * @param Credentials $credentials
     */
    public  function __construct(Credentials $credentials)
    {
        $this->credentials = $credentials;
    }
}
