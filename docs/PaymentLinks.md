## Payment Links

### List of All

```php
/**
* @var Chargily\ChargilyPay\Elements\PaginationElement|null
*/
$items = $chargily_pay->payment_links()->all();

```

### Retrieve

```php
/**
* @var Chargily\ChargilyPay\Elements\PaymentLinkElement|null
*/
$link = $chargily_pay->payment_links()->get("payment_link_id");

```

### Create

```php
/**
* @var Chargily\ChargilyPay\Elements\PaymentLinkElement|null
*/
$link = $chargily_pay->payment_links()->create([
    "name" => "Payment Link for Facebook page.",
    "active" => true,
    "after_completion_message" => "The product will arrive in 03 days.",
    "locale" => "en",
    "pass_fees_to_customer" => false,
    "metadata" => [],
    "items" => [
        [
            "price" => "price_id",
            "quantity" => 1,
        ],
    ],
]);

```

### Retrieve Prices

```php
/**
* @var Chargily\ChargilyPay\Elements\PaginationElement|null
*/
$prices = $chargily_pay->payment_links()->prices("payment_link_id");

```
