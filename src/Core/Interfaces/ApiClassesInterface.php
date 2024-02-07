<?php

namespace Chargily\ChargilyPay\Core\Interfaces;

use Chargily\ChargilyPay\Auth\Credentials;

interface ApiClassesInterface
{
    /**
     * constructor
     *
     * @param Credentials $credentials
     */
    public  function __construct(Credentials $credentials);
}
