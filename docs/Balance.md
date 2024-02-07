## Balance

### Retrieve Balance

```php
/**
* @var Chargily\ChargilyPay\Core\Helpers\Collection|null
*/
$balance = $chargily_pay->balance()->get();

/**
* @var \Chargily\ChargilyPay\Elements\WalletElement|null
*/
$dzd_wallet = $balance->first(fn ($wallet) => $wallet->getCurrency() === "dzd");
/**
* @var \Chargily\ChargilyPay\Elements\WalletElement|null
*/
$eur_wallet = $balance->first(fn ($wallet) => $wallet->getCurrency() === "eur");
/**
* @var \Chargily\ChargilyPay\Elements\WalletElement|null
*/
$usd_wallet = $balance->first(fn ($wallet) => $wallet->getCurrency() === "usd");

/////////
///////// Available Methods
/////////
/**
 * @method \Chargily\ChargilyPay\Elements\WalletElement getBalance()
 * @method \Chargily\ChargilyPay\Elements\WalletElement getReadyForPayout()
 * @method \Chargily\ChargilyPay\Elements\WalletElement getOnHold()
 * @method \Chargily\ChargilyPay\Elements\WalletElement getCurrency()
 *
 */
/////////
///////// Example
/////////
$dzd_wallet->getBalance();
//The balance you can withdraw
$dzd_wallet->getReadyForPayout();
//The balance on hold
$dzd_wallet->getOnHold();
//The currency
$dzd_wallet->getCurrency();

```
