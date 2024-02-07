<?php

namespace Chargily\ChargilyPay\Elements;

use Chargily\ChargilyPay\Core\Abstracts\ElementsAbstract;
use Chargily\ChargilyPay\Core\Interfaces\ElementsInterface;

/**
 * @method \Chargily\ChargilyPay\Elements\CheckoutElement getId()
 * @method \Chargily\ChargilyPay\Elements\CheckoutElement getName()
 * @method \Chargily\ChargilyPay\Elements\CheckoutElement getEmail()
 * @method \Chargily\ChargilyPay\Elements\CheckoutElement getPhone()
 * @method \Chargily\ChargilyPay\Elements\CheckoutElement getAddress()
 * @method \Chargily\ChargilyPay\Elements\CheckoutElement getMetadata()
 * @method \Chargily\ChargilyPay\Elements\CheckoutElement getCreatedAt()
 * @method \Chargily\ChargilyPay\Elements\CheckoutElement getUpdatedAt()
 * @method \Chargily\ChargilyPay\Elements\CheckoutElement checkouts()
 */
class CustomerElement extends ElementsAbstract implements ElementsInterface
{
}
