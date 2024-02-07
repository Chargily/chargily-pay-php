## Webhook

### Validate And Get Data

```php
/**
 * If webhook dosnt have valid signature will return null
* @var Chargily\ChargilyPay\Elements\WebhookElement|null
*/
$webhook = $chargily_pay->webhook()->get();

/**
 * if event type checkout.*
 * @var Chargily\ChargilyPay\Elements\CheckoutElement
 */
$checkout = $webhook->getData();

```
