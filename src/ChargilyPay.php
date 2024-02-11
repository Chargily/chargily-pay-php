<?php

namespace Chargily\ChargilyPay;

use Chargily\ChargilyPay\Api\Balance;
use Chargily\ChargilyPay\Api\Checkouts;
use Chargily\ChargilyPay\Api\Customers;
use Chargily\ChargilyPay\Api\PaymentLinks;
use Chargily\ChargilyPay\Api\Prices;
use Chargily\ChargilyPay\Api\Products;
use Chargily\ChargilyPay\Api\Webhook;
use Chargily\ChargilyPay\Auth\Credentials;

final class ChargilyPay
{
    /**
     * Credentials
     */
    protected Credentials $credetials;

    /**
     * constructor
     */
    public function __construct(Credentials $credentials)
    {
        $this->credetials = $credentials;
    }

    /**
     * Balance API Object
     */
    public function balance(): Balance
    {
        return new Balance($this->credetials);
    }

    /**
     * Checkouts API Object
     */
    public function checkouts(): Checkouts
    {
        return new Checkouts($this->credetials);
    }

    /**
     * Customers API Object
     */
    public function customers(): Customers
    {
        return new Customers($this->credetials);
    }

    /**
     * Payment Links API Object
     */
    public function payment_links(): PaymentLinks
    {
        return new PaymentLinks($this->credetials);
    }

    /**
     * Prices API Object
     */
    public function prices(): Prices
    {
        return new Prices($this->credetials);
    }

    /**
     * Products API Object
     */
    public function products(): Products
    {
        return new Products($this->credetials);
    }

    /**
     * Webhook Object
     */
    public function webhook(): Webhook
    {
        return new Webhook($this->credetials);
    }
}
