<?php

namespace Chargily\ChargilyPay\Elements;

use Chargily\ChargilyPay\Core\Abstracts\ElementsAbstract;
use Chargily\ChargilyPay\Core\Interfaces\ElementsInterface;

/**
 * @method \Chargily\ChargilyPay\Elements\WalletElement getBalance()
 * @method \Chargily\ChargilyPay\Elements\WalletElement getReadyForPayout()
 * @method \Chargily\ChargilyPay\Elements\WalletElement getOnHold()
 * @method \Chargily\ChargilyPay\Elements\WalletElement getCurrency()
 */
class WalletElement extends ElementsAbstract implements ElementsInterface
{
}
