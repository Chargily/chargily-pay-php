<?php

namespace Chargily\ChargilyPay\Core\Interfaces;

use Chargily\ChargilyPay\Auth\Credentials;

interface ApiClassesInterface
{
    /**
     * constructor
     */
    public function __construct(Credentials $credentials);
}
