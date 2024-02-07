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
     *
     * @var Credentials
     */
    protected Credentials $credetials;
    /**
     * constructor
     *
     * @param Credentials $credentials
     */
    public  function __construct(Credentials $credentials)
    {
        $this->credetials = $credentials;
    }
    /**
     * Balance API Object
     *
     * @return Balance
     */
    public function balance(): Balance
    {
        return new Balance($this->credetials);
    }
    /**
     * Checkouts API Object
     *
     * @return Checkouts
     */
    public function checkouts(): Checkouts
    {
        return new Checkouts($this->credetials);
    }
    /**
     * Customers API Object
     *
     * @return Customers
     */
    public function customers(): Customers
    {
        return new Customers($this->credetials);
    }
    /**
     * Payment Links API Object
     *
     * @return PaymentLinks
     */
    public function payment_links(): PaymentLinks
    {
        return new PaymentLinks($this->credetials);
    }
    /**
     * Prices API Object
     *
     * @return Prices
     */
    public function prices(): Prices
    {
        return new Prices($this->credetials);
    }
    /**
     * Products API Object
     *
     * @return Products
     */
    public function products(): Products
    {
        return new Products($this->credetials);
    }
    /**
     * Webhook Object
     *
     * @return Webhook
     */
    public function webhook(): Webhook
    {
        return new Webhook($this->credetials);
    }
}
